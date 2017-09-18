<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogos_sat
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('catalogos_sat_model');
    }

    public function cat_uso_cfdi_todos($order_by = 'cat_uso_cfdi_id')
    {
        return $this->CI->catalogos_sat_model->cat_uso_cfdi_todos($order_by);
    }

    public function cat_tipo_de_comprobante($order_by = 'cat_tipo_de_comprobante_id')
    {
        return $this->CI->catalogos_sat_model->cat_tipo_de_comprobante($order_by);
    }

    public function cat_moneda($order_by = 'cat_moneda_id')
    {
        return $this->CI->catalogos_sat_model->cat_moneda($order_by);
    }

    public function cat_forma_pago($order_by = 'cat_forma_pago_id')
    {
        return $this->CI->catalogos_sat_model->cat_forma_pago($order_by);
    }

    public function cat_metodo_pago($order_by = 'cat_metodo_pago_id')
    {
        return $this->CI->catalogos_sat_model->cat_metodo_pago($order_by);
    }
}