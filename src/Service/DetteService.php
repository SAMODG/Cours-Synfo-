<?php
// src/Service/DetteService.php
namespace App\Service;

use App\Entity\Dette;
use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;

class DetteService implements DetteServiceInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createDette(Client $client, float $montant): Dette
    {
        $dette = new Dette();
        $dette->setClient($client);
        $dette->setMontant($montant);
    
        $this->entityManager->persist($dette);
        $this->entityManager->flush();
    
        return $dette;
    }
    

    public function listDettes(Client $client): array
    {
        return $this->entityManager->getRepository(Dette::class)->findBy(['client' => $client]);
    }
}
