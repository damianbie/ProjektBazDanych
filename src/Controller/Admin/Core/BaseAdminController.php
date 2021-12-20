<?php

namespace App\Controller\Admin\Core;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaseAdminController extends AbstractController
{
    public function __construct()
    {
       // $this->isGranted('');
    }
    protected function render(string $view, array $parameters = [], Response $response = null): Response
    {
        $sideBarNav['admin_dashboard'] = array('icon' => 'fa-tachometer-alt', 'name' => 'Start');

        $sideBarNav['adminOrders'] = array('icon' => 'fa-clipboard-list', 'name' => 'Zlecenia', 'childs' => array(
            'admin_orders' => array('icon' => 'fa-clipboard-list', 'name' => 'Przeglądaj'),
            'admin_order_add' => array('icon' => 'fa-clipboard-list', 'name' => 'Dodaj nowe')
        ));

        $sideBarNav['adminClients'] = array('icon' => 'fa-user-tag', 'name' => 'Klienci', 'childs' => array(
            'admin_clients' => array('icon' => 'fa-users', 'name' => 'Przeglądaj'),
            'admin_client_add' => array('icon' => 'fa-user-plus', 'name' => 'Dodaj')
        ));

        $sideBarNav['adminWorkers'] = array('icon' => 'fa-user-tag', 'name' => 'Pracownicy', 'childs' => array(
            'admin_workers' => array('icon' => 'fa-users', 'name' => 'Przeglądaj'),
            'admin_workers_add' => array('icon' => 'fa-user-plus', 'name' => 'Dodaj')
        ));

        $sideBarNav['app_information'] = array('icon' => 'fa-atom', 'name' => 'Informacje');
        $sideBarNav['app_logout'] = array('icon' => 'fa-sign-out-alt', 'name' => 'Wyloguj');

        $defaultParams['app_name'] = 'bazaDB';
        $defaultParams['sideBarNav'] = $sideBarNav;

        $parameters = array_merge($parameters, $defaultParams);
        return parent::render($view, $parameters, $response);
    }
}