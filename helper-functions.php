<?php
function plp_load_view($view, $data=array())
{

    ob_start();
    extract($data);
    include 'views/'.$view.'.php';
    $content=ob_get_clean();

    return $content;
}