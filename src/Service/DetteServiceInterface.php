<?php

// src/Service/DetteServiceInterface.php
namespace App\Service;

use App\Entity\Dette;
use App\Entity\Client;

interface DetteServiceInterface
{
    public function createDette(Client $client, float $montant): Dette;
    public function listDettes(Client $client): array;
}
