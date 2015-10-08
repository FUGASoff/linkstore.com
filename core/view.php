<?php

/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 07.10.15
 * Time: 12:51
 */
class View
{
    function generate($content_view, $template_view, $data = null)
    {
        include 'application/views/'.$template_view;
    }
}