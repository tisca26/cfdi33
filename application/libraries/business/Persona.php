<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Persona
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('personas_model');
    }

    public function persona_por_id($id = 0)
    {
        if (valid_id($id)) {
            return $this->CI->personas_model->persona_por_id($id);
        }
        return null;
    }

    public function personas_por_usuario_id($id = 0)
    {
        if (valid_id($id)){
            return $this->CI->personas_model->persona_por_usuario_id($id);
        }
        return array();
    }

    public function personas_activas_por_usuario_id($id = 0)
    {
        if (valid_id($id)){
            return $this->CI->personas_model->persona_activas_por_usuario_id($id);
        }
        return array();
    }

}