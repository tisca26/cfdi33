<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Genera_estructura_cfdi33
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public function generar_estructura_cfdi33($Comprobante = array(), $CfdiRelacionados = array(),
                                              $Emisor = array(), $Receptor = array(), $Conceptos = array(),
                                              $Impuestos = array(), $Complemento = array(), $Addenda = array())
    {
        $estructura = array();
        $rfc = $Emisor['Rfc'];
        $comprobante_arr = $this->genera_estructura_comprobante($Comprobante, $rfc);
        if (!is_array($comprobante_arr)) {
            log_message('error', 'COMPROBANTE: ERROR AL GENERAR COMPROBANTE');
            return false;
        }
        $estructura['Comprobante'] = $comprobante_arr;

        if (count($CfdiRelacionados) > 0) {
            $cfdi_relacionados_arr = $this->genera_estructura_cfdi_relacionados($CfdiRelacionados);
            if (!is_array($cfdi_relacionados_arr)) {
                log_message('error', 'CFDI RELACIONADOS: ERROR AL GENERAR CFDI RELACIONADOS');
                return false;
            }
            $estructura['CfdiRelacionados'] = $cfdi_relacionados_arr;
        }


        $emisor_arr = $this->genera_estructura_emisor($Emisor);
        if (!is_array($emisor_arr)) {
            log_message('error', 'EMISOR: ERROR AL GENERAR EMISOR');
            return false;
        }
        $estructura['Emisor'] = $emisor_arr;

        $receptor_arr = $this->genera_estructura_receptor($Receptor);
        if (!is_array($receptor_arr)) {
            log_message('error', 'RECEPTOR: ERROR AL GENERAR RECEPTOR');
            return false;
        }
        $estructura['Receptor'] = $receptor_arr;

        $conceptos_arr = $this->genera_estructura_conceptos($Conceptos);
        if (!is_array($conceptos_arr)) {
            log_message('error', 'CONCEPTOS: ERROR AL GENERAR CONCEPTOS');
            return false;
        }
        $estructura['Conceptos'] = $conceptos_arr;


        if (count($Impuestos) > 0) {
            $impuestos_arr = $this->genera_estructura_impuestos($Impuestos);
            if (!is_array($impuestos_arr)) {
                log_message('error', 'IMPUESTOS: ERROR AL GENERAR IMPUESTOS');
                return false;
            }
            $estructura['Impuestos'] = $impuestos_arr;
        }

        return $estructura;
    }

    public function genera_estructura_comprobante($comprobante_arr = array(), $rfc = '')
    {
        $Comprobante = array();
        $elementos_comprobante = ['Version', 'Serie', 'Folio', 'Fecha', 'Sello', 'FormaPago',
            'NoCertificado', 'Certificado', 'CondicionesDePago', 'SubTotal', 'Descuento', 'Moneda',
            'TipoCambio', 'Total', 'TipoDeComprobante', 'MetodoPago', 'LugarExpedicion', 'Confirmacion'];
        $elementos_requeridos = ['Version', 'Fecha', 'Sello', 'NoCertificado', 'Certificado',
            'SubTotal', 'Moneda', 'Total', 'TipoDeComprobante', 'LugarExpedicion'];

        foreach ($comprobante_arr as $key => $val) {
            if (in_array($key, $elementos_comprobante, true)) {
                $Comprobante[$key] = $val;
            }
        }

        $Comprobante['Version'] = '3.3';
        $Comprobante['Fecha'] = $comprobante_arr['Fecha'];
        $Comprobante['Sello'] = 'XXX';
        $noCertificado_arr = $this->_obtener_noCertificado($rfc);
        if ($noCertificado_arr[1] == 1) {
            log_message('error', 'COMPROBANTE: ERROR AL GENERAR NO CERTIFICADO');
            return false;
        }
        $Comprobante['NoCertificado'] = $noCertificado_arr[0];
        $certificado_arr = $this->_obtener_certificado($rfc);
        if ($certificado_arr[1] == 1) {
            log_message('error', 'COMPROBANTE: ERROR AL GENERAR CERTIFICADO');
            return false;
        }
        $Comprobante['Certificado'] = $certificado_arr[0];
        foreach ($elementos_requeridos as $val) {
            if (!isset($Comprobante[$val])) {
                log_message('error', 'COMPROBANTE: ERROR AL REQUERIR ' . $val);
                return false;
            }
        }
        return $Comprobante;
    }

    public function genera_estructura_cfdi_relacionados($cfdi_relacionados = array())
    {
        $CfdiRelacionados = array();
        $elementos_cfdi_relacionados = ['TipoRelacion'];
        if (!isset($cfdi_relacionados['TipoRelacion'])) {
            log_message('error', 'CFDI RELACINADOS: ERROR AL REQUERIR TipoRelacion');
            return false;
        }
        $CfdiRelacionados['TipoRelacion'] = $cfdi_relacionados['TipoRelacion'];

        if (!isset($cfdi_relacionados['CfdiRelacionado'])) {
            log_message('error', 'CFDI RELACINADO: ERROR AL REQUERIR CfdiRelacionado');
            return false;
        }

        foreach ($cfdi_relacionados['CfdiRelacionado'] as $uuid) {
            $CfdiRelacionados['CfdiRelacionado'][] = $uuid;
        }
        return $cfdi_relacionados;
    }

    public function genera_estructura_emisor($emisor_arr = array())
    {
        $Emisor = array();
        $elementos_emisor = ['Rfc', 'Nombre', 'RegimenFiscal'];
        $elementos_requeridos = ['Rfc', 'RegimenFiscal'];
        foreach ($emisor_arr as $key => $val) {
            if (in_array($key, $elementos_emisor, true)) {
                $Emisor[$key] = $val;
            }
        }
        foreach ($elementos_requeridos as $val) {
            if (!isset($Emisor[$val])) {
                log_message('error', 'EMISOR: ERROR AL REQUERIR ' . $val);
                return false;
            }
        }
        return $Emisor;
    }

    public function genera_estructura_receptor($receptor_arr = array())
    {
        $Receptor = array();
        $elementos_receptor = ['Rfc', 'Nombre', 'ResidenciaFiscal', 'NumRegIdTrib', 'UsoCFDI'];
        $elementos_requeridos = ['Rfc', 'UsoCFDI'];
        foreach ($receptor_arr as $key => $val) {
            if (in_array($key, $elementos_receptor, true)) {
                $Receptor[$key] = $val;
            }
        }
        foreach ($elementos_requeridos as $val) {
            if (!isset($Receptor[$val])) {
                log_message('error', 'RECEPTOR: ERROR AL REQUERIR ' . $val);
                return false;
            }
        }
        return $Receptor;
    }

    public function genera_estructura_conceptos($conceptos_arr = array())
    {
        $Conceptos = array();
        $elementos_concepto = ['ClaveProdServ', 'NoIdentificacion', 'Cantidad', 'ClaveUnidad', 'Unidad', 'Descripcion', 'ValorUnitario', 'Importe', 'Descuento'];
        $elementos_requeridos = ['ClaveProdServ', 'Cantidad', 'ClaveUnidad', 'Descripcion', 'ValorUnitario', 'Importe'];
        $elementos_traslados = ['Base', 'Impuesto', 'TipoFactor', 'TasaOCuota', 'Importe'];
        $elementos_traslados_requeridos = ['Base', 'Impuesto', 'TipoFactor'];
        $elementos_retenciones = ['Base', 'Impuesto', 'TipoFactor', 'TasaOCuota', 'Importe'];
        $elementos_retenciones_requeridos = ['Base', 'Impuesto', 'TipoFactor', 'TasaOCuota', 'Importe'];
        $i = 0;
        foreach ($conceptos_arr as $concepto) {
            foreach ($concepto as $key => $val) {
                if (in_array($key, $elementos_concepto, true)) {
                    $Conceptos[$i][$key] = $val;
                }
            }
            if (isset($concepto['Impuestos'])) {
                if (isset($concepto['Impuestos']['Traslados'])) {
                    foreach ($concepto['Impuestos']['Traslados'] as $j => $traslado) {
                        foreach ($traslado as $key => $val) {
                            if (in_array($key, $elementos_traslados, true)) {
                                $Conceptos[$i]['Impuestos']['Traslados'][$j][$key] = $val;
                            }
                        }

                    }
                    foreach ($elementos_traslados_requeridos as $elem) {
                        foreach ($Conceptos[$i]['Impuestos']['Traslados'] as $traslado) {
                            if (!isset($traslado[$elem])) {
                                log_message('error', 'TRASLADOS: ERROR AL REQUERIR ' . $elem);
                                return false;
                            }
                        }
                    }
                }
                if (isset($concepto['Impuestos']['Retenciones'])) {
                    foreach ($concepto['Impuestos']['Retenciones'] as $j => $retencion) {
                        foreach ($retencion as $key => $val) {
                            if (in_array($key, $elementos_retenciones, true)) {
                                $Conceptos[$i]['Impuestos']['Retenciones'][$j][$key] = $val;
                            }
                        }

                    }
                    foreach ($elementos_retenciones_requeridos as $elem) {
                        foreach ($Conceptos[$i]['Impuestos']['Retenciones'] as $retencion) {
                            if (!isset($retencion[$elem])) {
                                log_message('error', 'RETENCIONES: ERROR AL REQUERIR ' . $elem);
                                return false;
                            }
                        }
                    }
                }
            }
            $i++;
        }

        foreach ($elementos_requeridos as $val) {
            foreach ($Conceptos as $concepto) {
                if (!isset($concepto[$val])) {
                    log_message('error', 'CONCEPTOS: ERROR AL REQUERIR ' . $val);
                    return false;
                }
            }
        }
        return $Conceptos;
    }

    public function genera_estructura_impuestos($impuestos_arr = array())
    {
        $Impuestos = array();
        $elementos_impuestos = ['TotalImpuestosRetenidos', 'TotalImpuestosTrasladados'];
        $elementos_retenciones = ['Impuesto', 'Importe'];
        $elementos_traslados = ['Impuesto', 'TipoFactor', 'TasaOCuota', 'Importe'];
        $elementos_retenciones_requeridos = ['Impuesto', 'Importe'];
        $elementos_traslados_requeridos = ['Impuesto', 'TipoFactor', 'TasaOCuota', 'Importe'];
        foreach ($impuestos_arr as $key => $val) {
            if (in_array($key, $elementos_impuestos, true)) {
                $Impuestos[$key] = $val;
            }
        }
        if (isset($impuestos_arr['Retenciones'])) {
            foreach ($impuestos_arr['Retenciones'] as $i => $retencion) {
                foreach ($retencion as $key => $val) {
                    if (in_array($key, $elementos_retenciones, true)) {
                        $Impuestos['Retenciones'][$i][$key] = $val;
                    }
                }
                foreach ($elementos_retenciones_requeridos as $elem) {
                    if (!isset($retencion[$elem])) {
                        log_message('error', 'IMPUESTOS RETENCIONES: ERROR AL REQUERIR ' . $elem);
                        return false;
                    }
                }
            }
        }
        if (isset($impuestos_arr['Traslados'])) {
            foreach ($impuestos_arr['Traslados'] as $i => $traslado) {
                foreach ($traslado as $key => $val) {
                    if (in_array($key, $elementos_traslados, true)) {
                        $Impuestos['Traslados'][$i][$key] = $val;
                    }
                }
                foreach ($elementos_traslados_requeridos as $elem) {
                    if (!isset($traslado[$elem])) {
                        log_message('error', 'IMPUESTOS TRASLADOS: ERROR AL REQUERIR ' . $elem);
                        return false;
                    }
                }
            }
        }
        return $Impuestos;
    }

    public function _obtener_noCertificado($rfc = '')
    {
        $output = array();
        $return_var = '';
        $rutaIn = RUTA_DOCS_USR . $rfc . '/' . $rfc . '.cer';

        $cmd = "openssl x509 -inform DER -in " . $rutaIn . " -noout -serial ";
        exec($cmd, $output, $return_var);

        $response[0] = $output; // informacion que necesitamos
        $response[1] = $return_var; // Si es 1 hay error

        if ($response[1] == 0) {
            $serial = str_replace('serial=', '', $response[0][0]);
            $serial = chunk_split($serial, 2, ' ');
            $serial_arr = explode(' ', $serial);
            $serial_final = '';
            foreach ($serial_arr as $str) {
                $serial_final .= substr_replace($str, '', 0, 1);
            }
            $response[0] = $serial_final;
        }
        return $response;
    }

    public function _obtener_certificado($rfc = '')
    {
        $output = array();
        $return_var = '';
        $rutaIn = RUTA_DOCS_USR . $rfc . '/' . $rfc . '.cer';

        $cmd = "openssl enc -in " . $rutaIn . " -a -A";
        exec($cmd, $output, $return_var);

        $response[0] = $output; // informacion que necesitamos
        $response[1] = $return_var; // Si es 1 hay error

        if ($response[1] == 0) {
            $response[0] = $response[0][0];
        }
        return $response;
    }

}