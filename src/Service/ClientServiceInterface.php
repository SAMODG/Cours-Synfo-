<?php
// src/Service/Interfaces/ClientServiceInterface.php
namespace App\Service;

use Knp\Component\Pager\Pagination\PaginationInterface;

interface ClientServiceInterface
{
    public function listClients(array $filters, int $page): PaginationInterface;
}
