<?php

// src/Controller/DetteController.php
namespace App\Controller;

use App\Entity\Client;
use App\Service\DetteServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DetteController extends AbstractController
{
    private DetteServiceInterface $detteService;
    private EntityManagerInterface $entityManager;


        #[Route('/dette/new/{client}', name: 'new_dette')]
    public function new(Client $client): Response
    {
        return $this->render('dette/create.html.twig', [
            'client' => $client,
        ]);
    }

    public function __construct(DetteServiceInterface $detteService, EntityManagerInterface $entityManager)
    {
        $this->detteService = $detteService;
        $this->entityManager = $entityManager;
    }

    #[Route('/dette/create', name: 'create_dette')]
    public function create(Request $request): Response
{
    // Récupère l'ID du client à partir de la requête
    $clientId = $request->request->get('client_id');
    
    if (!$clientId) {
        throw new \InvalidArgumentException('L\'ID du client est manquant.');
    }

    // Utilisation de l'EntityManager pour récupérer le client
    $client = $this->entityManager->getRepository(Client::class)->find($clientId);

    if (!$client) {
        throw $this->createNotFoundException('Client non trouvé.');
    }

    $montant = $request->request->get('montant');
    $dette = $this->detteService->createDette($client, $montant);

    return $this->redirectToRoute('dette_list', ['client' => $client->getId()]);
}
    #[Route('/dette/list/{client}', name: 'dette_list')]
    public function list(Client $client): Response
    {
        $dettes = $this->detteService->listDettes($client);

        return $this->render('dette/list.html.twig', [
            'dettes' => $dettes,
            'client' => $client,
        ]);
    }
}
