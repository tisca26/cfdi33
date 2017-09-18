<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('clientes_model');
    }

    public function clientes_por_cuenta($cuentas_id = 0, $estatus = null, $order_by = 'clientes_id')
    {
        if (is_null($cuentas_id)) {
            $cuentas_id = 0;
        }
        return $this->CI->clientes_model->clientes_por_cuenta($cuentas_id, $estatus, $order_by);
    }
}