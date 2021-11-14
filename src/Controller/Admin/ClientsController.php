<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Core\BaseAdminController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientsController extends BaseAdminController
{
    public function index(): Response
    {
        return $this->render('admin/clients/index.html.twig', [
            'active_nav_route' => 'admin_clients',
            'content_title' => 'ClientController',
        ]);
    }

    public function add(): Response
    {
        return $this->render('admin/clients/index.html.twig', [
            'active_nav_route' => 'admin_client_add',
            'content_title' => 'ADdClientController',
        ]);
    }
}
