<?php defined('BASEPATH') OR exit('No direct script access allowed');

include "Privy.php";

class Facturacion extends Privy
{
    public function __construct()
    {
        parent::__construct();
        $this->set_read_list(array('index'));
        $this->set_insert_list(array('insertar', 'frm_insertar'));
        $this->set_update_list(array('editar', 'frm_editar'));
        $this->set_delete_list(array('borrar', 'borrado_final'));
        $this->check_access();
        $this->load->library('business/Factura');
        $this->load->library('business/Catalogos_sat');
        $this->load->library('business/Cliente');
        $this->load->library('business/Persona');
    }

    public function index()
    {
        $data['personas'] = $this->persona->personas_activas_por_usuario_id(get_attr_session('usr_id'));
        $data['clientes'] = $this->cliente->clientes_por_cuenta(get_attr_session('usr_cuenta_id'), 1);
        $data['cat_uso_cfdi'] = $this->catalogos_sat->cat_uso_cfdi_todos();
        $data['cat_tipo_de_comprobante'] = $this->catalogos_sat->cat_tipo_de_comprobante();
        $data['cat_moneda'] = $this->catalogos_sat->cat_moneda();
        $data['cat_forma_pago'] = $this->catalogos_sat->cat_forma_pago();
        $data['cat_metodo_pago'] = $this->catalogos_sat->cat_metodo_pago();
        $this->load->view('facturacion/facturacion_index', $data);
    }
}