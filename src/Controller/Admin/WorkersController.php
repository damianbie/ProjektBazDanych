<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Core\BaseAdminController;
use Symfony\Component\HttpFoundation\Response;

class WorkersController extends BaseAdminController
{
    public function index($id): Response
    {
        return $this->render('admin/workers/index.html.twig', [
            'active_nav_route' => 'admin_workers',
            'content_title' => 'workers',
        ]);
    }
    public function add(): Response
    {
        return $this->render('admin/workers/index.html.twig', [
            'active_nav_route' => 'admin_workers_add',
            'content_title' => 'workers add',
        ]);
    }
}
