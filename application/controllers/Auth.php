<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->UsersModel->is_logged_in_back();
        if ($this->input->post('Login') == 'Login') {
            $config = array(
                     array(
                         'field'   => 'email',
                         'label'   => 'email',
                         'rules'   => 'trim|required|xss_clean'
                      ),array(
                         'field'   => 'password',
                         'label'   => 'password',
                         'rules'   => 'trim|required|xss_clean'
                      )
                );
            $this->form_validation->set_rules($config);
            $this->form_validation->set_error_delimiters('<li>', '</li>');
            if ($this->form_validation->run() == false) {
                $data['error'] = validation_errors();
            } else {
                $login =  $this->UsersModel->login($this->input->post('email'), $this->input->post('password'));
                if ($login and !empty($login)) {
                    $newdata = $login[0] ;
                    $newdata['Is_logged_in'] = 'TRUE';
                    $this->session->set_userdata($newdata);
                    redirect('users', 'refresh');
                } else {
                    $data['error'] = 'The email is not associated with an account';
                }
            }
        }
        $data['title'] = 'Login';
        $this->load->template('auth/login', $data);
    }
    public function logout()
    {
        $this->session->sess_destroy();
        setcookie('username', '', time() + (2952000 * 30), "/"); // 86400 = 1 day
               setcookie('password', '', time() + (2952000 * 30), "/"); // 86400 = 1 day
               redirect('auth', 'refresh');
    }
}
