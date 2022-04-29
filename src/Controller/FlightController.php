<?php

namespace App\Controller;

use App\Entity\Flight;
use App\Form\FlightType;
use App\Repository\FlightRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/flight')]
class FlightController extends AbstractController
{
    #[Route('/', name: 'app_flight_index', methods: ['GET'])]
    public function index(FlightRepository $flightRepository): Response
    {
        return $this->render('flight/index.html.twig', [
            'flights' => $flightRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_flight_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FlightRepository $flightRepository): Response
    {
        $flight = new Flight();
        $form = $this->createForm(FlightType::class, $flight);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $letters = range('A','Z'); // range dans letters un tableau de a à z
            shuffle($letters); // Mélange l'ordre du tableau
            $first = array_shift($letters); // extrait la premiere valer sous forme de string pour la ranger dans une variable $first
            shuffle($letters); // melange à nouveau
            $second = array_shift($letters);  // extrait la premiere valeur sous forme de string pour la ranger dans une variable $second
            $letters = $first.$second; // concatene les deux pour creer la variable lettre de deux lettres àleatoires.

            $digits = (string)mt_rand(1000,9999); // genere un nombre à quatre chiffre et le change en string
            $flightNumber = $letters.$digits; // concatene les 2lettres et les 4 chiffres

            $flight->setFlightNumber($flightNumber);
            $flightRepository->add($flight);

            return $this->redirectToRoute('app_base', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('flight/new.html.twig', [
            'flight' => $flight,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_flight_show', methods: ['GET'])]
    public function show(Flight $flight): Response
    {
        return $this->render('flight/show.html.twig', [
            'flight' => $flight,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_flight_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Flight $flight, FlightRepository $flightRepository): Response
    {
        $form = $this->createForm(FlightType::class, $flight);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $flightRepository->add($flight);
            return $this->redirectToRoute('app_base', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('flight/edit.html.twig', [
            'flight' => $flight,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_flight_delete', methods: ['POST'])]
    public function delete(Request $request, Flight $flight, FlightRepository $flightRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$flight->getId(), $request->request->get('_token'))) {
            $flightRepository->remove($flight);
        }

        return $this->redirectToRoute('app_base', [], Response::HTTP_SEE_OTHER);
    }
}
