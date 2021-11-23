<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Core\BaseAdminController;
use App\Entity\Worker;
use App\Entity\WorkPlace;
use App\Form\NewWorkPlaceType;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class WorkersController extends BaseAdminController
{
    private $_sess = null;
    public function __construct(SessionInterface $sess)
    {
        $this->_sess = $sess;
    }

    public function index($id, Request $request): Response
    {
        $wp = new WorkPlace();
        $form = $this->createForm(NewWorkPlaceType::class, $wp);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $wp = $form->getData();
            $mng = $this->getDoctrine()->getManager();

            $mng->persist($wp);
            $mng->flush();

            $this->addFlash('msg', sprintf("Utworzono nowe stanowisko  %s (id: %d) ", $wp->getName(), $wp->getID()));
            $this->addFlash('successForm', 1);

            return $this->redirect($request->getUri());
        }
        else if($form->isSubmitted())
        {
            $this->addFlash('successForm', 0);
            $this->addFlash('msg', "Blad podczas dodawania danych");
        }

        $workers = $this->getDoctrine()
            ->getRepository(Worker::class)
            ->findAll();

        $workPlaces = $this->getDoctrine()->getRepository(WorkPlace::class)
            ->findAll();

        return $this->render('admin/workers/index.html.twig', [
            'active_nav_route'  => 'admin_workers',
            'content_title'     => 'Lista wszystkich pracowników',
            'workers'           => $workers,
            'workPlaces'        => $workPlaces,
            'newWorkPlaceForm'  => $form->createView(),
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