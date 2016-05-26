<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function parse_template($body)
{
    if (preg_match_all('/\[(.*?)\]/', $body, $template_vars))
    {
        $replace ='';
        foreach ($template_vars[1] as $var)
        {
            $replace = '';

            $body = str_replace('[' . $var . ']', $replace, $body);
        }
    }
    return $body;
}
?>