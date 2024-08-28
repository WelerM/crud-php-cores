<?php

namespace core\classes;
use Exception;

//Related to general functions
class Functions
{

    public static function Layout($structures, $data = null, $header_data = null)
    {

    // Verifies if $structures is an array
    if (!is_array($structures)) {
        throw new Exception("Invalid layout structures");
    }

    // Extracts $data if it is an array
    if (!empty($data) && is_array($data)) {
        extract($data);
    }

    // Extracts $headerData if it is an array
    if (!empty($headerData) && is_array($headerData)) {
        extract($headerData, EXTR_PREFIX_ALL, 'header');
    }

    foreach ($structures as $structure) {
        include_once("../core/views/$structure.php");
    }
    }

    public static function redirect($route = '')
    {   
        header("Location: " . APP_BASE_URL . "?a=$route");
    }

   
}
