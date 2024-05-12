<?php

namespace Laravel\Blog\Framework\core;
class View
{
    public $template_view;

    function generate($content_view, $template_view = null, $data = null)
    {
        /*
        if(is_array($data)) {
            // преобразуем элементы массива в переменные
            extract($data);
        }
        */
        if ($template_view)
            include __DIR__.'/../../application/views/'.$template_view;
        else
            include __DIR__.'/../../application/views/'.$content_view;
    }
}