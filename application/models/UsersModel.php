<?php
 if (!defined('BASEPATH')) {
     exit('No direct script access allowed');
 }
class UsersModel extends CI_Model
{
    protected $tablename = 'users';

    protected $fillable = array('id', 'first_name', 'last_name', 'email',
                                 'company', 'title', 'address',
                                 'city', 'phone', );

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        $this->db->select($this->fillable);
        $query = $this->db->get($this->tablename);

        return $query->result_array() ? $query->result_array() : false;
    }

    public function insertdata($data)
    {
        $query = $this->db->insert($this->tablename, $data);

        return $query ? true : false;
    }

    public function updatedata($where, $data)
    {
        $this->db->where($where);
        $query = $this->db->update($this->tablename, $data);

        return $query ? true : false;
    }

    public function getwhere($where)
    {
        $query = $this->db->get_where($this->tablename, $where);

        return $query->result_array() ? $query->result_array() : false;
    }

    public function destroy($where)
    {
        $this->db->where($where);
        $query = $this->db->delete($this->tablename);

        return $query ? true : false;
    }

    public function login($email, $password, $google = false)
    {
        $this->db->from($this->tablename);
        $this->db->where('email', $email);
        if (!$google) {
            $this->db->where('password', md5($password));
        }

        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function is_logged_in()
    {
        $CI = &get_instance();
        $is_logged_in = $CI->session->userdata('Is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {
            redirect('login', 'refresh');
        }
    }

    public function is_logged_in_back()
    {
        $CI = &get_instance();
        $is_logged_in = $CI->session->userdata('Is_logged_in');
        if (isset($is_logged_in)) {
            redirect('/users', 'refresh');
        }
    }
}
/* End of file '/Users.php' */
/* Location: ./application/models//Users.php */
