<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Core\BaseAdminController;
use App\Entity\Worker;
use App\Entity\WorkPlace;
use App\Form\AddEditWorkerType;
use App\Form\NewWorkPlaceType;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class WorkersController extends BaseAdminController
{
    public function __construct(SessionInterface $sess)
    {
    }

    //Listowanie wszystkich pracownikow i staowisk, dodawanie stanowiska
    public function index(Request $request): Response
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
            'content_title'     => 'Lista pracowników i stanowisk',
            'workers'           => $workers,
            'workPlaces'        => $workPlaces,
            'newWorkPlaceForm'  => $form->createView(),
        ]);
    }

    // ---- Pracownicy
    public function workerDetalis(Worker $worker)
    {

    }
    public function workerEdit(Worker $worker, Request $request)
    {
        $worker_form = $this->createForm(AddEditWorkerType::class, $worker);
        $worker_form->handleRequest($request);
        $w = new Worker();

        if($worker_form->isSubmitted() && $worker_form->isValid())
        {
            $w = $worker_form->getData();
            $mng = $this->getDoctrine()->getManager();

            $mng->persist($w);
            $mng->flush();

            $this->addFlash('msg', sprintf("Edytowano pracownika  %s (id: %d) ", $w->getName(), $w->getID()));
            $this->addFlash('successForm', 1);

            return $this->redirectToRoute('admin_workers');
        }
        else if($worker_form->isSubmitted())
        {
            $this->addFlash('successForm', 0);
            $this->addFlash('msg', "Blad przy edytowaniu danych");
            return $this->redirectToRoute('admin_workers');
        }

        return $this->renderForm("admin/workers/detalis.html.twig", [
            'active_nav_route'  => 'admin_workers',
            'content_title'     => '',
            'worker_form'       => $worker_form
            ]);
    }
    public function addWorker(Request $request): Response
    {
        $worker = new Worker();
        $worker_form = $this->createForm(AddEditWorkerType::class, $worker);
        $worker_form->handleRequest($request);

        return $this->renderForm("admin/workers/detalis.html.twig", [
            'active_nav_route'  => 'admin_workers_add',
            'content_title'     => '',
            'worker_form'       => $worker_form
        ]);
    }
    public function deleteWorker(Worker $worker)
    {
        $name   = $worker->getName();
        $id     = $worker->getId();

        $mn =$this->getDoctrine()->getManager();
        $mn->remove($worker);
        $mn->flush();

        $this->addFlash('msg', sprintf("Usunieto pracownika %s (id: %d) ", $name, $id));
        $this->addFlash('successForm', 1);

        return $this->redirectToRoute('admin_workers');
    }
    // ---- Pracownicy


}