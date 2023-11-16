<?php

namespace App\Repository;

use App\Entity\Sujetdiscuss;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sujetdiscuss|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sujetdiscuss|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sujetdiscuss[] findAll()
 * @method Sujetdiscuss[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SujetdiscussRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sujetdiscuss::class);
    }
}
