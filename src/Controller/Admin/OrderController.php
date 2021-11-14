<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Core\BaseAdminController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends BaseAdminController
{

    public function index($id): Response
    {
        return $this->render('admin/order/index.html.twig', [
            'active_nav_route' => 'admin_orders',
            'content_title' => 'OrderController',
        ]);
    }

    public function add(): Response
    {
        return $this->render('admin/order/index.html.twig', [
            'active_nav_route' => 'admin_order_add',
            'content_title' => 'OrderAddController',
        ]);
    }
}