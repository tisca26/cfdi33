<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Personas_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function ultimo_id()
    {
        return $this->db->insert_id();
    }

    public function error_consulta()
    {
        return $this->db->error();
    }

    public function personas_todas($order_by = 'personas_id')
    {
        $res = array();
        $q = $this->db->order_by($order_by)->get('v_personas');
        if ($q->num_rows() > 0) {
            $res = $q->result();
        }
        return $res;
    }

    public function personas_todas_activas($order_by = 'personas_id')
    {
        $res = array();
        $q = $this->db->order_by($order_by)->get('v_personas_activas');
        if ($q->num_rows() > 0) {
            $res = $q->result();
        }
        return $res;
    }

    public function persona_por_id($id = 0, $estatus = 1)
    {
        $obj = null;
        if (!is_null($estatus)) {
            $this->db->where('estatus', $estatus);
        }
        $q = $this->db->where('personas_id', $id)->get('v_personas');
        if ($q->num_rows() > 0) {
            $obj = $q->row();
        }
        return $obj;
    }

    public function persona_por_usuario_id($usuarios_id = 0)
    {
        $res = array();
        $q = $this->db->where('usuarios_id', $usuarios_id)->get('usuarios_personas');
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $elem) {
                $persona = $this->persona_por_id($elem->personas_id);
                if (is_object($persona)) {
                    $res[] = $persona;
                }
            }
        }
        return $res;
    }

    public function persona_activas_por_usuario_id($usuarios_id = 0)
    {
        $res = array();
        $q = $this->db->where('usuarios_id', $usuarios_id)->get('usuarios_personas');
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $elem) {
                $persona = $this->persona_por_id($elem->personas_id, 1);
                if (is_object($persona)) {
                    $res[] = $persona;
                }
            }
        }
        return $res;
    }

}