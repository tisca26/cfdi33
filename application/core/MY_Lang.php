<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Lang extends CI_Lang
{
    function __construct()
    {

        global $URI, $CFG;

        $config =& $CFG->config;
        $default_abbr = $config['language_abbr'];
        $lang_uri_abbr = $config['lang_uri_abbr'];
        $uri_abbr = $URI->segment(1);
        $URI->uri_string = preg_replace("|^\/?$uri_abbr|", '', $URI->uri_string);
        $lang_abbr=(isset($lang_uri_abbr[$uri_abbr]))?$uri_abbr:$default_abbr;
        if($config['language']!=$lang_uri_abbr[$lang_abbr]){
            $config['language'] = $lang_uri_abbr[$lang_abbr];
            $config['language_abbr'] = $lang_abbr;
        }
        log_message("debug","---- Loaded Language: $lang_uri_abbr[$lang_abbr] ----");
    }
}

function trans_line($line)
{
    global $LANG;
    return ($t = $LANG->line($line)) ? $t : $line;
}