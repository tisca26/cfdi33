<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Convertidor_pem
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public function convertir_key_a_pem($rfc = '', $pass = 'Bianconeri26')
    {
        $output = array();
        $return_var = '';
        $rutaIn = RUTA_DOCS_USR . $rfc . '/' . $rfc . '.key';
        $rutaOut = RUTA_DOCS_USR . $rfc . '/' . $rfc . '.key.pem';

        $cmd = "openssl pkcs8 -inform DET -in " . $rutaIn . " -passin pass:" . $pass . " -out " . $rutaOut;
        exec($cmd, $output, $return_var);

        $response[0] = $output;
        $response[1] = $return_var; // Si es 1 hay error
        return $response;
    }

    public function convertir_cer_a_pem($rfc = '')
    {
        $output = array();
        $return_var = '';
        $rutaIn = RUTA_DOCS_USR . $rfc . '/' . $rfc . '.cer';
        $rutaOut = RUTA_DOCS_USR . $rfc . '/' . $rfc . '.cer.pem';

        $cmd = "openssl x509 -inform DER -outform PEM -in " . $rutaIn . " -pubkey -out " . $rutaOut;
        exec($cmd, $output, $return_var);

        $response[0] = $output;
        $response[1] = $return_var; // Si es 1 hay error
        return $response;
    }

}