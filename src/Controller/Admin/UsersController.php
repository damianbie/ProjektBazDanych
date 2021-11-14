<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Core\BaseAdminController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends BaseAdminController
{
    public function index(): Response
    {
        return $this->render('admin/users/index.html.twig', [
            'active_nav_route' => 'admin_orders',
            'content_title' => 'OrderController',
        ]);
    }
}
