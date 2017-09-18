<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes_model extends CI_Model
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

    public function clientes_por_cuenta($cuentas_id = 0, $estatus = null, $order_by = 'clientes_id')
    {
        $res = array();
        if (!is_null($estatus)) {
            $this->db->where('estatus', $estatus);
        }
        $q = $this->db->where('cuentas_id', $cuentas_id)->order_by($order_by)->get('clientes');
        if ($q->num_rows() > 0){
            $res = $q->result();
        }
        return $res;
    }
}