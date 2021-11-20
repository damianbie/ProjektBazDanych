<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Core\BaseAdminController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Client;

class ClientsController extends BaseAdminController
{
    public function index(): Response
    {
        $repositorty    = $this->getDoctrine()->getRepository(Client::class);
        $companies      = $repositorty->findAllCompanies();
        $clients        = $repositorty->findAllClients();


        return $this->render('admin/clients/index.html.twig', [
            'active_nav_route'  => 'admin_clients',
            'content_title'     => 'ClientController',
            'clients'           => $clients,
            'companies'         => $companies,
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
