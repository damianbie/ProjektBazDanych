<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Core\BaseAdminController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends BaseAdminController
{
    public function index(): Response
    {
        return $this->render('admin/dashboard/index.html.twig', [
            'active_nav_route' => 'admin_dashboard',
            'content_title' => 'DashboardController',
        ]);
    }
}