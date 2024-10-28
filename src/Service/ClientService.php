<?php
// src/Service/ClientService.php
namespace App\Service;

use Knp\Component\Pager\Pagination\PaginationInterface;
use App\Repository\ClientRepository;
use Knp\Component\Pager\PaginatorInterface;

class ClientService implements ClientServiceInterface
{
    private ClientRepository $clientRepository;
    private PaginatorInterface $paginator;

    
    public function __construct(ClientRepository $clientRepository, PaginatorInterface $paginator)
    {
        $this->clientRepository = $clientRepository;
        $this->paginator = $paginator;
    }

    public function listClients(array $filters, int $page): PaginationInterface
    {
        $queryBuilder = $this->clientRepository->createFilteredQuery($filters);
        
        return $this->paginator->paginate($queryBuilder, $page, 10);
    }
}
