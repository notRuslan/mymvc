<?php

namespace App;

class Main
{
    public function index()
    {
        $view = new View();
        $data['name'] = 'BOSS';
        $view->render('index', $data);

    }
}