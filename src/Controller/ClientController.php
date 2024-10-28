<?php
// src/Controller/ClientController.php
namespace App\Controller;

use App\Service\ClientServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{



    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }
    
    private ClientServiceInterface $clientService;

    public function __construct(ClientServiceInterface $clientService)
    {
        $this->clientService = $clientService;
    }

    #[Route('/clients', name: 'client_list')]
    public function list(Request $request): Response
    {
        $filters = [
            'surname' => $request->query->get('surname'),
            'telephone' => $request->query->get('telephone')
        ];
        $page = $request->query->getInt('page', 1);

        $clients = $this->clientService->listClients($filters, $page);

        return $this->render('client/list.html.twig', [
            'clients' => $clients,
        ]);
    }
}

