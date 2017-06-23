<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Cargar_elementos_manager
{
    private $CI;

    function __construct()
    {
        $this->CI = &get_instance();
    }

    function carga_simple($dir = '', $attr = array())
    {
        $this->CI->load->view($dir, $attr);
    }

    function carga_con_lang($dir = '', $attr = array())
    {
        $this->CI->cargar_idioma->carga_lang($dir);
        $this->CI->load->view($dir, $attr);
    }
}