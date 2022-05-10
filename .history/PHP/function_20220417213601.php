<?php 
// === function  handle
function get_data($label_field)
{
    global $$label_field;
    if (!empty($$label_field))
        return $$label_field;
}
function get_data_cookie($label_field){
    if(!empty($_COOKIE[$label_field])){
        return $_COOKIE[$label_field];
    }
}
function is_full_name($name)
{
    $pattern = "/[^0-9]/";
    if (!preg_match($pattern, $name, $matches))
        return false;
    return true;
}

function is_error($label_field)
{
    global $error;
    if (!empty($error[$label_field]))
        return $error[$label_field];
}
function showError($input) {
    global $error;
    if(!empty($error[$input])){
        echo $error[$input] ;
    }
}?>