<?php


namespace App\controllers;


class PageController
{

    public function indexAction()
    {
        echo 'IndexAction PageController';
    }

    public function viewAction($params)
    {
        echo 'View action page controller';
        print_r($params);
    }

    public function updateAction()
    {
        echo 'Update action';
    }
}