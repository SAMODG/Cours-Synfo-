<?php

// src/Repository/ClientRepository.php
namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    /**
     * Crée une requête avec des filtres pour la liste des clients
     *
     * @param array $filters
     * @return QueryBuilder
     */
    public function createFilteredQuery(array $filters): QueryBuilder
    {
        $qb = $this->createQueryBuilder('c');

        if (!empty($filters['surname'])) {
            $qb->andWhere('c.surname LIKE :surname')
               ->setParameter('surname', '%' . $filters['surname'] . '%');
        }

        if (!empty($filters['telephone'])) {
            $qb->andWhere('c.telephone = :telephone')
               ->setParameter('telephone', $filters['telephone']);
        }

        return $qb;
    }
}
