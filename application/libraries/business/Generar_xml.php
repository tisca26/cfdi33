<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Generar_xml
{
    protected $CI;
    protected $xml;
    protected $datos_test;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->datos_test = [
            'Comprobante' => [
                'Version' => '3.3',
                'Serie' => 'PRUEBA',
                'Folio' => '1',
                'Fecha' => '2017-06-12T11:43:27',
                'Sello' => 'XXX',
                'FormaPago' => '01',
                'noCertificado' => 'XXX',
                'Certificado' => 'XXX',
                'CondicionesDePago' => 'XXX',
                'SubTotal' => '200.00',
                'Descuento' => '10.00',
                'Moneda' => 'MXN',
                'TipoCambio' => '1',
                'Total' => '190',
                'TipoDeComprobante' => 'I',
                'MetodoPago' => 'PUE',
                'LugarExpedicion' => '06300'
            ],
            'Emisor' => [
                'Rfc' => 'ICO1512104F5',
                'Nombre' => 'Icognitis S.A. de C.V.',
                'RegimenFiscal' => '601'
            ],
            'Receptor' => [
                'Rfc' => 'ICO1512104F5',
                'Nombre' => 'Icognitis SA de CV',
                'ResidenciaFiscal' => 'MEX',
                'UsoCFDI' => 'P01'
            ],
            'Conceptos' => [
                '0' => [
                    'ClaveProdServ' => '80111706',
                    'Cantidad' => '1',
                    'ClaveUnidad' => 'E48',
                    'Unidad' => 'Unidad de servicio',
                    'Descripcion' => 'Servicio administrativo correspondiente al periodo XXXX',
                    'ValorUnitario' => '100.00',
                    'Importe' => '100.00',
                    'Descuento' => '5.00',
                    'Impuestos' => [
                        'Traslados' => [
                            '0' => [
                                'Base' => '200.00',
                                'Impuesto' => '001',
                                'TipoFactor' => 'Tasa',
                                'TasaOCuota' => '0.300000',
                                'Importe' => '10.00'
                            ],
                            '1' => [
                                'Base' => '300.00',
                                'Impuesto' => '002',
                                'TipoFactor' => 'Cuota',
                                'TasaOCuota' => '0.530000',
                                'Importe' => '11.00'
                            ]
                        ],
                        'Retenciones' => [
                            '0' => [
                                'Base' => '100.00',
                                'Impuesto' => '003',
                                'TipoFactor' => 'Tasa',
                                'TasaOCuota' => '0.16000000',
                                'Importe' => '20.00'
                            ],
                            '1' => [
                                'Base' => '110.00',
                                'Impuesto' => '003',
                                'TipoFactor' => 'Cuota',
                                'TasaOCuota' => '0.16000000',
                                'Importe' => '21.00'
                            ]
                        ]
                    ]
                ],
                '1' => [
                    'ClaveProdServ' => '80111706',
                    'Cantidad' => '1',
                    'ClaveUnidad' => 'E48',
                    'Unidad' => 'Unidad de servicio',
                    'Descripcion' => 'Servicio administrativo 2 correspondiente al periodo XXXX',
                    'ValorUnitario' => '100.00',
                    'Importe' => '100.00',
                    'Descuento' => '5.00'
                ],
            ],
            'Impuestos' => [
                'TotalImpuestosRetenidos' => '41.00',
                'TotalImpuestosTrasladados' => '21.00',
                'Retenciones' => [
                    '0' => [
                        'Impuesto' => '003',
                        'Importe' => '20.00'
                    ],
                    '1' => [
                        'Impuesto' => '003',
                        'Importe' => '21.00'
                    ],
                ],
                'Traslados' => [
                    '0' => [
                        'Impuesto' => '001',
                        'TipoFactor' => 'Tasa',
                        'TasaOCuota' => '0.300000',
                        'Importe' => '10.00'
                    ],
                    '1' => [
                        'Impuesto' => '002',
                        'TipoFactor' => 'Cuota',
                        'TasaOCuota' => '0.530000',
                        'Importe' => '11.00'
                    ],
                ]
            ]
        ];
    }

    private function _cargaAtt(&$nodo, $attr)
    {
        foreach ($attr as $key => $val) {
            for ($i = 0; $i < strlen($val); $i++) {
                $a = substr($val, $i, 1);
                if ($a > chr(127) && $a !== chr(219) && $a !== chr(211) && $a !== chr(209)) {
                    $val = substr_replace($val, ".", $i, 1);
                }
            }
            $val = preg_replace('/\s\s+/', ' ', $val);   // Regla 5a y 5c
            $val = trim($val);                           // Regla 5b
            if (strlen($val) > 0) {   // Regla 6
                $val = str_replace(array('"', '>', '<'), "'", $val);  // &...;
                $val = utf8_encode(str_replace("|", "/", $val)); // Regla 1
                $nodo->setAttribute($key, $val);
            }
        }
    }

    public function genera_cfdi33($datos = array())
    {
        $xml_str = ''; //XML A REGRESAR
        //$datos = $this->datos_test;
        $xml = new DOMdocument("1.0", "UTF-8");

        $comprobante = $xml->createElement("cfdi:Comprobante");
        $comprobante = $xml->appendChild($comprobante);
        $this->_cargaAtt($comprobante,
            array(
                "xmlns:cfdi" => "http://www.sat.gob.mx/cfd/3",
                "xmlns:xsi" => "http://www.w3.org/2001/XMLSchema-instance",
                "xsi:schemaLocation" => "http://www.sat.gob.mx/cfd/3  http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv33.xsd"
            )
        );// DATOS OBLIGATORIOS PARA CFDI 33

        /*
         * INICIA SECUENCA PARA GENERAR CFDI 33
         */

        // Se carga el elemento Comprobante
        $this->_cargaAtt($comprobante, $datos['Comprobante']);

        // Se carga el elemento CfdiRelacionados
        if (isset($datos['CfdiRelacionados'])){
            $cfdi_relacionados = $xml->createElement("cfdi:CfdiRelacionados");
            $cfdi_relacionados = $comprobante->appendChild($cfdi_relacionados);

            $cfdi_relacionado = $datos['CfdiRelacionados']['CfdiRelacionado'];
            unset($datos['CfdiRelacionados']['CfdiRelacionado']);

            $this->_cargaAtt($cfdi_relacionados, $datos['CfdiRelacionados']);

            foreach ($cfdi_relacionado as $uuid){
                $cfdi = $xml->createElement("cfdi:CfdiRelacionado");
                $cfdi = $cfdi_relacionados->appendChild($cfdi);
                $this->_cargaAtt($cfdi, array('UUID' => $uuid));
            }
        }

        //Se carga el elemento Emisor y sus atributos
        $emisor = $xml->createElement("cfdi:Emisor");
        $emisor = $comprobante->appendChild($emisor);
        $this->_cargaAtt($emisor, $datos['Emisor']);

        // Se carga el elemento Receptor y sus atributos
        $receptor = $xml->createElement("cfdi:Receptor");
        $receptor = $comprobante->appendChild($receptor);
        $this->_cargaAtt($receptor, $datos['Receptor']);

        // Se cargan los Conceptos
        $conceptos = $xml->createElement("cfdi:Conceptos");
        $conceptos = $comprobante->appendChild($conceptos);
        foreach ($datos['Conceptos'] as $concepto_attr) {
            $impuestos_nodo = array();
            if (isset($concepto_attr['Impuestos'])) {
                $impuestos_nodo = $concepto_attr['Impuestos'];
                unset($concepto_attr['Impuestos']);
            }
            $concepto = $xml->createElement("cfdi:Concepto");
            $concepto = $conceptos->appendChild($concepto);
            $this->_cargaAtt($concepto, $concepto_attr);

            //Se cargan los Impuestos
            if (count($impuestos_nodo) > 0) {
                $impuestos = $xml->createElement("cfdi:Impuestos");
                $impuestos = $concepto->appendChild($impuestos);
                if (isset($impuestos_nodo['Traslados'])) {
                    $traslados = $xml->createElement("cfdi:Traslados");
                    $traslados = $impuestos->appendChild($traslados);
                    foreach ($impuestos_nodo['Traslados'] as $traslado_attr) {
                        $traslado = $xml->createElement("cfdi:Traslado");
                        $traslado = $traslados->appendChild($traslado);
                        $this->_cargaAtt($traslado, $traslado_attr);
                    }
                }
                if (isset($impuestos_nodo['Retenciones'])) {
                    $retenciones = $xml->createElement("cfdi:Retenciones");
                    $retenciones = $impuestos->appendChild($retenciones);
                    foreach ($impuestos_nodo['Retenciones'] as $retencion_attr) {
                        $retencion = $xml->createElement("cfdi:Retencion");
                        $retencion = $retenciones->appendChild($retencion);
                        $this->_cargaAtt($retencion, $retencion_attr);
                    }
                }
            }
        }

        // Se cargan Impuestos

        if ((isset($datos['Impuestos']))) {
            $impuestos = $xml->createElement("cfdi:Impuestos");
            $impuestos = $comprobante->appendChild($impuestos);
            $impuestos_nodo = $datos['Impuestos'];

            if (isset($impuestos_nodo['Retenciones'])) {
                $retenciones_nodo = $impuestos_nodo['Retenciones'];
                unset($impuestos_nodo['Retenciones']);
                $retenciones = $xml->createElement("cfdi:Retenciones");
                $retenciones = $impuestos->appendChild($retenciones);
                foreach ($retenciones_nodo as $retencion_attr) {
                    $retencion = $xml->createElement("cfdi:Retencion");
                    $retencion = $retenciones->appendChild($retencion);
                    $this->_cargaAtt($retencion, $retencion_attr);
                }
            }
            if (isset($impuestos_nodo['Traslados'])) {
                $traslados_nodo = $impuestos_nodo['Traslados'];
                unset($impuestos_nodo['Traslados']);
                $traslados = $xml->createElement("cfdi:Traslados");
                $traslados = $impuestos->appendChild($traslados);
                foreach ($traslados_nodo as $traslado_attr) {
                    $traslado = $xml->createElement("cfdi:Traslado");
                    $traslado = $traslados->appendChild($traslado);
                    $this->_cargaAtt($traslado, $traslado_attr);
                }
            }
            // Se cargan los atributos del Nodo Impuesto, una vez que ya se limpio y cargaron los nodos anidados
            $this->_cargaAtt($impuestos, $impuestos_nodo);

        }


        /*
         * TERMINA SECUENCA PARA GENERAR CFDI 33
         */

        // SELLAR EL CFDI

        $cadena_original_arr = $this->_genera_cadena_original_cfdi33($xml);
        $sello = $this->_generar_sello_cfdi33($datos['Emisor']['Rfc'], $cadena_original_arr[0]);
        $this->_cargaAtt($comprobante, array('Sello' => $sello));

        $xml->formatOutput = true;
        $xml_str = $xml->saveXML();

        return $xml_str;
    }

    public function _generar_sello_cfdi33($rfc = '', $cadena_original = '')
    {
        $sello = '';
        $ruta = RUTA_DOCS_USR . "$rfc/";
        $key_pem = $ruta . "$rfc.key.pem";
        $pkeyid = openssl_get_privatekey(file_get_contents($key_pem));
        if (openssl_sign($cadena_original, $crypttext, $pkeyid, OPENSSL_ALGO_SHA256)){
            openssl_free_key($pkeyid);
            $sello = base64_encode($crypttext);      // lo codifica en formato base64
        }
        return $sello;
    }

    public function _genera_cadena_original_cfdi33($xml = '')
    {
        $xml->formatOutput = true;
        $xml_str = $xml->saveXML();
        libxml_use_internal_errors(true);
        $xml_obj = new DOMDocument("1.0", "UTF-8");
        $xml_obj->loadXML($xml_str);

        $xslt = new DOMDocument("1.0", "UTF-8");
        $xslt_archivo = RUTA_DOCS_SAT . "cadenaoriginal_3_3.xslt";      // Ruta al archivo
        $xslt->load($xslt_archivo);

        $processor = new XSLTProcessor();
        $processor->importStyleSheet($xslt);

        $cadena_original = $processor->transformToXML($xml_obj);
        $response[0] = $cadena_original;
        $response[1] = $this->_libxml_display_errors();
        log_message('debug', "Cadena1: " . $cadena_original);
        return $response;
    }

    public function _valida_cfdi33($xml = ''){
        $response[0] = true;
        libxml_use_internal_errors(true);
        $cfdi33_xsd = RUTA_DOCS_SAT . 'cfdv33.xsd';
        if (!$xml->schemaValidate($cfdi33_xsd)){
            $response[0] = false;
            $response[1] = $this->_libxml_display_errors();
        }
        return $response;
    }

    private function _libxml_display_error($error)
    {
        $return = "<br/>\n";
        switch ($error->level) {
            case LIBXML_ERR_WARNING:
                $return .= "<b>Warning $error->code</b>: ";
                break;
            case LIBXML_ERR_ERROR:
                $return .= "<b>Error $error->code</b>: ";
                break;
            case LIBXML_ERR_FATAL:
                $return .= "<b>Fatal Error $error->code</b>: ";
                break;
        }
        $return .= trim($error->message);
        if ($error->file) {
            $return .= " in <b>$error->file</b>";
        }
        $return .= " on line <b>$error->line</b>\n";

        return $return;
    }

    private function _libxml_display_errors()
    {
        $res = [];
        $errors = libxml_get_errors();
        foreach ($errors as $error) {
            $res[] = $this->_libxml_display_error($error);
        }
        libxml_clear_errors();
        return $res;
    }
}