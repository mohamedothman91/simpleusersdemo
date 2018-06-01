<?php

defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @category        Controller
 *
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 *
 * @see            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Users extends REST_Controller
{
    public function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('UsersModel');
    }

    public function index_get()
    {
        // Users from a data store e.g. database
        $users = $this->UsersModel->get_all();

        $id = $this->get('id');

        // If the id parameter doesn't exist return all the users

        if ($id === null) {
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($users) {
                // Set the response and exit
                $this->response($users, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                // Set the response and exit
                $this->response([
                    'status' => false,
                    'error' => 'No users were found',
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Find and return a single record for a particular user.

        $id = (int) $id;

        // Validate the id.
        if ($id <= 0) {
            // Invalid id, set the response and exit.
            $this->response(null, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // Get the user from the array, using the id as key for retreival.
        // Usually a model is to be used for this.

        $user = null;

        if (!empty($users)) {
            foreach ($users as $key => $value) {
                if (isset($value['id']) && $value['id'] == $id) {
                    $user = $value;
                }
            }
        }

        if (!empty($user)) {
            $this->set_response($user, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->set_response([
                'status' => false,
                'error' => 'User could not be found',
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function index_post()
    {
        $config = array(
                   array(
                       'field' => 'first_name',
                       'label' => 'First Name',
                       'rules' => 'trim|required|xss_clean',
                   ), array(
                    'field' => 'last_name',
                    'label' => 'Last Name',
                    'rules' => 'trim|required|xss_clean',
                   ), array(
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'trim|required|xss_clean|valid_email|is_unique[users.email]',
                   ), array(
                       'field' => 'password',
                       'label' => 'Password',
                       'rules' => 'trim|required|xss_clean|min_length[5]',
                    ),
                    );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == false) {
            $this->response($this->form_validation->error_array(), REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
            // `id`, `first_name`, `last_name`, `email`, `password`,
            //  `company`, `title`, `address`, `city`, `phone`
            $result = array(
                      'first_name' => $this->post('first_name'),
                      'last_name' => $this->post('last_name'),
                      'email' => $this->post('email'),
                      'password' => md5($this->post('password')),
                      'company' => ($this->post('company')) ? $this->post('company') : '',
                      'title' => ($this->post('title')) ? $this->post('title') : '',
                      'city' => ($this->post('city')) ? $this->post('city') : '',
                      'phone' => ($this->post('phone')) ? $this->post('phone') : '',
                      'address' => ($this->post('address')) ? $this->post('address') : '',
                    );

            // Send Mail verification
            $inserdb = $this->UsersModel->insertdata($result);
            if ($inserdb) {
                $result['id'] = $this->db->insert_id();

                $this->set_response($result, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
            } else {
                $this->response(null, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }
        }
    }

    public function index_put()
    {
        $id = $this->put('id');

        if (!$id) {
            $this->response(null, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
            $put = $this->put();
            $password = $put['password'];
            unset($put['password']);
            foreach ($put as $key => $value) {
                $result[$key] = $value;
            }
            $where = ['id' => $put['id']];
            if (!empty($password)) {
                $result['password'] = md5($this->put('password'));
            }
            $iupdatedb = $this->UsersModel->updatedata($where, $result);
            if ($iupdatedb) {
                unset($result['password']);
                $this->set_response($result, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
            } else {
                $this->response(null, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }
        }
    }

    public function index_delete()
    {
        $id = $this->query('id');

        // Validate the id.
        if ($id <= 0) {
            // Set the response and exit
            $this->response(null, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        $delete = $this->UsersModel->destroy(['id' => $id]);

        $message = [
            'id' => $id,
            'message' => 'Deleted the resource',
        ];
        $this->set_response($message, REST_Controller::HTTP_OK); // NO_CONTENT (204) being the HTTP response code
    }
}
