<?php

namespace App;

class View
{

    public function render($filename, $data = null)
    {

        require_once __DIR__ . "/../views/layout/header.php";
        require_once __DIR__ . "/../views/{$filename}.php";
        require_once __DIR__ . "/../views/layout/footer.php";

    }
}