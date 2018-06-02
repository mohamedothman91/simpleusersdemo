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
                         'field' => 'email',
                         'label' => 'email',
                         'rules' => 'trim|required|xss_clean',
                      ), array(
                         'field' => 'password',
                         'label' => 'password',
                         'rules' => 'trim|required|xss_clean',
                      ),
                );
            $this->form_validation->set_rules($config);
            $this->form_validation->set_error_delimiters('<li>', '</li>');
            if ($this->form_validation->run() == false) {
                $data['error'] = validation_errors();
            } else {
                $login = $this->UsersModel->login($this->input->post('email'), $this->input->post('password'));
                if ($login and !empty($login)) {
                    $newdata = $login[0];
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
        setcookie('username', '', time() + (2952000 * 30), '/'); // 86400 = 1 day
               setcookie('password', '', time() + (2952000 * 30), '/'); // 86400 = 1 day
               redirect('auth', 'refresh');
    }

    public function googlelogin()
    {
        $client = new Google_Client();
        $client->setAuthConfig('client_secret_264501595144-a4mqjd0njvge8oj3ij1vlvo0ge8i6t24.apps.googleusercontent.com.json');
        $client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);

        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $client->setAccessToken($_SESSION['access_token']);
            $oAuth = new Google_Service_Oauth2($client);
            $userData = $oAuth->userinfo_v2_me->get();
            $login = $this->UsersModel->login($userData['email'], rand(), true);
            if ($login) {
                $newdata = $login[0];
                $newdata['Is_logged_in'] = 'TRUE';
                $this->session->set_userdata($newdata);
                redirect('users', 'refresh');
            } else {
                $result = array(
                                'first_name' => $userData['givenName'],
                                'last_name' => $userData['familyName'],
                                'email' => $userData['email'],
                                'password' => md5(rand()),
                                );
                $inserdb = $this->UsersModel->insertdata($result);
                $newdata = $result;
                $newdata['Is_logged_in'] = 'TRUE';
                $this->session->set_userdata($newdata);
                redirect('users', 'refresh');
            }
        } else {
            $redirect_uri = 'http://'.$_SERVER['HTTP_HOST'].'/simpleusersdemo/public/auth/oauth2callback';
            header('Location: '.filter_var($redirect_uri, FILTER_SANITIZE_URL));
        }
    }

    public function oauth2callback()
    {
        session_start();

        $client = new Google_Client();
        $client->setAuthConfig('client_secret_264501595144-a4mqjd0njvge8oj3ij1vlvo0ge8i6t24.apps.googleusercontent.com.json');
        $client->setRedirectUri('http://'.$_SERVER['HTTP_HOST'].'/simpleusersdemo/public/auth/oauth2callback');
        $client->addScope([
            'https://www.googleapis.com/auth/plus.login',
            'https://www.googleapis.com/auth/plus.me',
            'https://www.googleapis.com/auth/userinfo.email',
            'https://www.googleapis.com/auth/userinfo.profile',
        ]);

        if (!isset($_GET['code'])) {
            $auth_url = $client->createAuthUrl();
            header('Location: '.filter_var($auth_url, FILTER_SANITIZE_URL));
        } else {
            $client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $client->getAccessToken();
            $redirect_uri = base_url().'/auth/googlelogin';
            header('Location: '.filter_var($redirect_uri, FILTER_SANITIZE_URL));
        }
    }
}
