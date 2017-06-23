<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller
{
    public function index()
    {
        return $this->test_xml();
    }

    public function test_xml()
    {
        $this->load->library('business/generar_xml');
        $data['xml'] = $this->generar_xml->genera_cfdi33();
        $this->load->view('inicio/inicio_index', $data);
    }

    public function test_cadena_original()
    {
        $this->load->library('business/generar_xml');
        $data['xml'] = $this->generar_xml->genera_cfdi33();
        $resp_cadena = $this->generar_xml->_genera_cadena_original_cfdi33($data['xml']);
        print_r($resp_cadena[0]);
        $data['cadena_original'] = ($resp_cadena[0] == false) ? $resp_cadena[1] : $resp_cadena[0];
        $this->load->view('inicio/test_cadena_original', $data);
    }

    public function test_key_pem()
    {
        $this->load->library('business/Convertidor_pem');
        echo 'ok<br>';
        $resp = $this->convertidor_pem->convertir_key_a_pem('ICO1512104F5', 'Bianconeri26');
        echo 'Array: <br>';
        print_r($resp[0]);
        echo 'Int: <br>';
        echo $resp[1];
    }

    public function test_cer_pem()
    {
        $this->load->library('business/Convertidor_pem');
        echo 'ok<br>';
        $resp = $this->convertidor_pem->convertir_cer_a_pem('ICO1512104F5');
        echo 'Array: <br>';
        print_r($resp[0]);
        echo 'Int: <br>';
        echo $resp[1];
    }

    public function test_nocertificado()
    {
        $this->load->library('business/generar_xml');
        echo 'NoCertificado Ico: ';
        $resp = $this->generar_xml->_obtener_noCertificado('ICO1512104F5');
        echo $resp[0];
        echo '<br> Resp' . $resp[1] . '<br>';
        echo 'NoCertificado fab: ';
        $resp = $this->generar_xml->_obtener_noCertificado('FAB1308169F8');
        print_r($resp[0]);
        echo '<br>';
    }

    public function test_certificado()
    {
        $this->load->library('business/generar_xml');
        echo 'Certificado Ico: ';
        $resp = $this->generar_xml->_obtener_certificado('ICO1512104F5');
        echo $resp[0];
        echo '<br> Resp' . $resp[1] . '<br>';
        echo 'NoCertificado fab: ';
        $resp = $this->generar_xml->_obtener_certificado('FAB1308169F8');
        print_r($resp[0]);
        echo '<br>';
    }

    public function test_sello()
    {
        $this->load->library('business/generar_xml');
        echo 'Sello Ico:';
        $resp = $this->generar_xml->_generar_sello_cfdi33('ICO1512104F5', 'Hola');
        print_r( $resp );
    }

    public function timbrar()
    {
        $Comprobante = [
            'Serie' => 'PRUEBA',
            'Folio' => '1',
            'Fecha' => '2017-06-20T16:20:29',
            'Sello' => 'XXX',
            'FormaPago' => '01',
            'noCertificado' => 'XXX',
            'Certificado' => 'XXX',
            'CondicionesDePago' => 'XXX',
            'SubTotal' => '200.00',
            'Descuento' => '10.00',
            'Moneda' => 'MXN',
            'TipoCambio' => '1',
            'Total' => '297.99',
            'TipoDeComprobante' => 'I',
            'MetodoPago' => 'PUE',
            'LugarExpedicion' => '06300'
        ];
        $CfdiRelacionados = [
            'TipoRelacion' => '04',
            'CfdiRelacionado' => ['560a8451-a29c-41d4-a716-544676554400', '4A1B43E2-1183-4AD4-A3DE-C2DA787AE56A']
        ];
        $Emisor = [
            'Rfc' => 'ICO1512104F5',
            'Nombre' => 'Icognitis S.A. de C.V.',
            'RegimenFiscal' => '601'
        ];
        $Receptor = [
            'Rfc' => 'LOJM860616H3A',
            'Nombre' => 'MIGUEL ANGEL LOPEZ JIMENEZ',
            'UsoCFDI' => 'P01'
        ];
        $Conceptos = [
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
                            'Impuesto' => '003',
                            'TipoFactor' => 'Tasa',
                            'TasaOCuota' => '0.265000',
                            'Importe' => '52.99'
                        ],
                        '1' => [
                            'Base' => '300.00',
                            'Impuesto' => '003',
                            'TipoFactor' => 'Tasa',
                            'TasaOCuota' => '0.300000',
                            'Importe' => '89.99'
                        ]
                    ],
                    'Retenciones' => [
                        '0' => [
                            'Base' => '100.00',
                            'Impuesto' => '001',
                            'TipoFactor' => 'Tasa',
                            'TasaOCuota' => '0.350000',
                            'Importe' => '34.99'
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
        ];
        $Impuestos = [
            'TotalImpuestosRetenidos' => '34.99',
            'TotalImpuestosTrasladados' => '142.98',
            'Retenciones' => [
                '0' => [
                    'Impuesto' => '001',
                    'Importe' => '34.99'
                ]
            ],
            'Traslados' => [
                '0' => [
                    'Impuesto' => '003',
                    'TipoFactor' => 'Tasa',
                    'TasaOCuota' => '0.265000',
                    'Importe' => '52.99'
                ],
                '1' => [
                    'Impuesto' => '003',
                    'TipoFactor' => 'Tasa',
                    'TasaOCuota' => '0.300000',
                    'Importe' => '89.99'
                ],
            ]
        ];

        $this->load->library('business/Timbrar');
        $xml_timbrado = $this->timbrar->timbrar($Comprobante, $CfdiRelacionados, $Emisor, $Receptor, $Conceptos, $Impuestos, array(), array());

        echo '<pre>';
        print_r($xml_timbrado);
        echo '</pre>';
//        $xml = $xml_timbrado;
//        $data['xml'] = $xml;
//        $this->load->view('inicio/inicio_index', $data);
    }
}