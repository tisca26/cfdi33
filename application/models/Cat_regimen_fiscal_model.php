<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cat_regimen_fiscal_model extends CI_Model
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

    public function cat_regimen_fiscal_por_id($id = 0)
    {
        $obj = null;
        $q = $this->db->where('cat_regimen_fiscal_id', $id)->get('cat_regimen_fiscal');
        if ($q->num_rows() > 0){
            $obj = $q->row();
        }
        return $obj;
    }

    public function cat_regimen_fiscal_todos($order_by = 'cat_regimen_fiscal_id')
    {
        $res = array();
        $q = $this->db->order_by($order_by)->get('cat_regimen_fiscal');
        if ($q->num_rows() > 0){
            $res = $q->result();
        }
        return $res;
    }
}