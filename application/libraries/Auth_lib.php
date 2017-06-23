<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_lib
{
    private $CI;
    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function login($usr, $pass)
    {
        $res = false;
        //Verify common user data
        $query = $this->CI->db->where(array('username' => $usr, 'estatus' => 1))->get('usuarios');
        if ($query->num_rows() > 0) {
            $dbpassword = $query->row()->pass;
            if (password_verify($pass, $dbpassword)) {
                set_attr_session(array('logged_in' => 'OK_LOGIN'));
                set_attr_session(array('usr_nombre' => $query->row()->nombre));
                set_attr_session(array('usr_apellidos' => $query->row()->apellidos));
                $res = TRUE;
            }
        }
        return $res;
    }

    public function logout()
    {
        $this->CI->session->sess_destroy();
    }

    public function check_access()
    {
        if (!get_attr_session('logged_in')) {
            $actual_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            set_attr_session('intento_url', $actual_url);
            return redirect('admon/login/');
        }else{
            set_attr_session('intento_url', '');
            return true;
        }
    }
}