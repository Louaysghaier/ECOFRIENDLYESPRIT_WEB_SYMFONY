<?php

namespace App\Repository;

use App\Entity\HistoriqueDoc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HistoriqueDoc|null find($id, $lockMode = null, $lockVersion = null)
 * @method HistoriqueDoc|null findOneBy(array $criteria, array $orderBy = null)
 * @method HistoriqueDoc[] findAll()
 * @method HistoriqueDoc[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistoriqueDocRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HistoriqueDoc::class);
    }
}
