<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('lang_segment')) {
    function lang_segment()
    {
        $CI =& get_instance();
        return $CI->config->item('language_abbr');
    }
}

if (!function_exists('lang_segment_slash')) {
    function lang_segment_slash()
    {
        $CI =& get_instance();
        return $CI->config->item('language_abbr') . '/';
    }
}

if (!function_exists('base_url_slash')) {
    function base_url_slash()
    {
        return base_url() . '/';
    }
}

if (!function_exists('base_url_lang')) {
    function base_url_lang()
    {
        $CI =& get_instance();
        return base_url() . $CI->config->item('language_abbr');
    }
}

if (!function_exists('base_url_lang_slash')) {
    function base_url_lang_slash()
    {
        return base_url_lang() . '/';
    }
}

if (!function_exists('cdn_assets')) {
    function cdn_assets()
    {
        $CI =& get_instance();
        return $CI->config->item('cdn_assets');
    }
}

if (!function_exists('cdn_assets_slash')) {
    function cdn_assets_slash()
    {
        return cdn_assets() . '/';
    }
}

if (!function_exists('cambia_idioma')) {
    function cambia_idioma($lang = 'es')
    {
        $url = uri_string();
        return base_url() . $lang . $url;
    }
}
