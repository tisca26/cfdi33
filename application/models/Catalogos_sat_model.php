<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogos_sat_model extends CI_Model
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

    public function cat_uso_cfdi_todos($order_by = 'cat_uso_cfdi_id')
    {
        return $this->db->order_by($order_by)->get('cat_uso_cfdi')->result();
    }

    public function cat_tipo_de_comprobante($order_by = 'cat_tipo_de_comprobante_id')
    {
        return $this->db->order_by($order_by)->get('cat_tipo_de_comprobante')->result();
    }

    public function cat_moneda($order_by = 'cat_moneda_id')
    {
        return $this->db->order_by($order_by)->get('cat_moneda')->result();
    }

    public function cat_forma_pago($order_by = 'cat_forma_pago_id')
    {
        return $this->db->order_by($order_by)->get('cat_forma_pago')->result();
    }

    public function cat_metodo_pago($order_by = 'cat_metodo_pago_id')
    {
        return $this->db->order_by($order_by)->get('cat_metodo_pago')->result();
    }
}