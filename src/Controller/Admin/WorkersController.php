<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Core\BaseAdminController;
use App\Entity\Worker;
use App\Entity\WorkPlace;
use App\Repository\WorkerRepository;
use Symfony\Component\HttpFoundation\Response;

class WorkersController extends BaseAdminController
{
    public function index($id): Response
    {
        $workers = $this->getDoctrine()
            ->getRepository(Worker::class)
            ->findAll();


        return $this->render('admin/workers/index.html.twig', [
            'active_nav_route' => 'admin_workers',
            'content_title' => 'Lista wszystkich pracowników',
            'workers' => $workers,
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
