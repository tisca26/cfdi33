<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('obtener_buscador_dto')) {
    function obtener_buscador_dto()
    {
        $CI =& get_instance();
        $dto = new stdClass();
        $CI->load->library('business/Filtros_busqueda');
        $dto->tipos_propiedades = $CI->filtros_busqueda->tipos_propiedades();
        $dto->ubicaciones = $CI->filtros_busqueda->ubicacion();
        $dto->cuartos = $CI->filtros_busqueda->cuartos();
        $dto->precios = $CI->filtros_busqueda->precio();
        return $dto;
    }
}