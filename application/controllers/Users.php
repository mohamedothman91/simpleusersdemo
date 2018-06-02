<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->model('UsersModel');
        $data['users'] = $this->UsersModel->get_all();
        $this->load->template('users/index', $data, [], true);
    }

    public function get($id)
    {
        $id = intval($id);
        if ($id != 0) {
            $this->load->model('users_model');
            $data['content'] = $this->users_model->get($id);
            $this->load->template('users_view', $data);
        } else {
            redirect(site_url(), 'refresh');
        }
    }

    public function add()
    {
        if ($this->input->post()) {
            // `id`, `first_name`, `last_name`, `email`, `password`,
            //  `company`, `title`, `address`, `city`, `phone`
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
                    ), array(
                        'field' => 'passconf',
                        'label' => 'Password Confirmation',
                       'rules' => 'trim|required|xss_clean|matches[password]',
                    ),
                    );
            $this->form_validation->set_rules($config);
            $this->form_validation->set_error_delimiters('<li>', '</li>');
            if ($this->form_validation->run() == false) {
                $data['error'] = validation_errors();
            } else {
                // `id`, `first_name`, `last_name`, `email`, `password`,
                //  `company`, `title`, `address`, `city`, `phone`
                $result = array(
                      'first_name' => $this->input->post('first_name'),
                      'last_name' => $this->input->post('last_name'),
                      'email' => $this->input->post('email'),
                      'password' => md5($this->input->post('password')),
                      'company' => ($this->input->post('company')) ? $this->input->post('company') : '',
                      'title' => ($this->input->post('title')) ? $this->input->post('title') : '',
                      'city' => ($this->input->post('city')) ? $this->input->post('city') : '',
                      'phone' => ($this->input->post('phone')) ? $this->input->post('phone') : '',
                      'address' => ($this->input->post('address')) ? $this->input->post('address') : '',
                    );

                // Send Mail verification
                $inserdb = $this->UsersModel->insertdata($result);
                if ($inserdb) {
                    $data['done'] = 'Thanks Data Saved Successfully';
                } else {
                    $data['error'] = 'Error In Save Data';
                }
            }
        }
        $data['title'] = 'Add New User';
        $this->load->template('users/add', $data, [], true);
    }

    public function edit()
    {
        if ($this->uri->segment(3)) {
            $id = $this->uri->segment(3);
            $where = ['id' => $id];
            if ($this->input->post('modify')) {
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
                                'rules' => 'trim|required|xss_clean|valid_email',
                            ),
                          );
                $password = $this->input->post('password');
                if (!empty($password)) {
                    array_push(
                        $config,
                                array(
                                    'field' => 'password',
                                    'label' => 'Password',
                                    'rules' => 'trim|required|xss_clean|min_length[5]',
                                 ),
                                array(
                                            'field' => 'passconf',
                                            'label' => 'Password Confirmation',
                                            'rules' => 'trim|required|xss_clean|matches[password]',
                                        )
                                    );
                }
                $this->form_validation->set_rules($config);
                $this->form_validation->set_error_delimiters('<li>', '</li>');
                if ($this->form_validation->run() == false) {
                    $data['error'] = validation_errors();
                } else {
                    $result = array(
                        'first_name' => $this->input->post('first_name'),
                        'last_name' => $this->input->post('last_name'),
                        'email' => $this->input->post('email'),
                        'company' => ($this->input->post('company')) ? $this->input->post('company') : '',
                        'title' => ($this->input->post('title')) ? $this->input->post('title') : '',
                        'city' => ($this->input->post('city')) ? $this->input->post('city') : '',
                        'phone' => ($this->input->post('phone')) ? $this->input->post('phone') : '',
                        'address' => ($this->input->post('address')) ? $this->input->post('address') : '',
                      );

                    if (!empty($password)) {
                        $result['password'] = md5($this->input->post('password'));
                    }
                    $iupdatedb = $this->UsersModel->updatedata($where, $result);
                    if ($iupdatedb) {
                        $data['done'] = 'Thanks Data Saved Successfully';
                    } else {
                        $data['error'] = 'Error In Save Data';
                    }
                }
            }
            $data['titel'] = 'Edit User';
            $data['user'] = $this->UsersModel->getwhere($where)[0];
            $this->load->template('users/edit', $data, [], true);
        } else {
            $this->session->set_flashdata('Error', 'Please Select a user to edit');
            redirect('users', 'refresh');
        }
    }

    public function delete()
    {
        if ($this->uri->segment(3)) {
            $id = $this->uri->segment(3);
            $delete = $this->UsersModel->destroy(['id' => $id]);
            if (!$delete) {
                $this->session->set_flashdata('Error', 'Error in delete please try again');
                redirect('users', 'refresh');
            } else {
                $this->session->set_flashdata('Done', 'Thanks Delete Successfully');
                redirect('users', 'refresh');
            }
        } else {
            $this->session->set_flashdata('Error', 'Error in delete please try again');
            redirect('users', 'refresh');
        }
    }
}

/* End of file '/Users.php' */
/* Location: ./application/controllers//Users.php */
