<?php

namespace App\Repository;

use App\Entity\Rateddoc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Rateddoc|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rateddoc|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rateddoc[] findAll()
 * @method Rateddoc[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RateddocRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rateddoc::class);
    }
}
