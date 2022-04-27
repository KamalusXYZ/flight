<?php

namespace App\Controller;

use App\Repository\FlightRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    #[Route('/', name: 'app_base')]
    public function index(FlightRepository $flightRepo): Response
    {
        return $this->render('base/home.html.twig', [
            'flights' => $flightRepo->findAll(),

        ]);
    }
}

