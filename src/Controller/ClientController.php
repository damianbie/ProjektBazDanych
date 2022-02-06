<?php

namespace App\Controller;

use App\Entity\RepairOrder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{

    public function index()
    {
        return $this->render('client/welcome.html.twig', [

        ]);
    }

    public function show($id): Response
    {
        $mng = $this->getDoctrine()->getRepository(RepairOrder::class);
        $data = $mng->findBy(['ClientCode' => $id]);
        if(count($data) > 0)
            $data = $data[0];
        else
            return $this->redirect('/');

        return $this->render('client/index.html.twig', [
            'controller_name'   => 'TU NARAZIE JEST ŚCIERNISKO ALE BĘDZIE SAN FRAN SISCO',
            'companyName'       => 'NazwaFirmy',
            'data'              => $data,
        ]);
    }
}
