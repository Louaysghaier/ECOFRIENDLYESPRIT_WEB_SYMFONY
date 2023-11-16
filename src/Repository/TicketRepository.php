<?php

namespace App\Repository;

use App\Entity\Ticket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ticket>
 *
 * @method Ticket|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ticket|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ticket[]    findAll()
 * @method Ticket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ticket::class);
    }
    /**
 * Trouver les tickets disponibles en fonction des critères de réservation.
 *
 * @param array $reservationData
 * @return Ticket[]|array
 */
public function findAvailableTickets(array $reservationData): array
{
    $qb = $this->createQueryBuilder('t')
        ->andWhere('t.lieuDepart = :lieuDepart')
        ->setParameter('lieuDepart', $reservationData['lieuDepart'])
        ->andWhere('t.lieuArrive = :lieuArrive')
        ->setParameter('lieuArrive', $reservationData['lieuArrive'])
        ->andWhere('t.dateTicket = :dateTicket')
        ->setParameter('dateTicket', $reservationData['dateTicket'])
        ->getQuery();

    // Exécutez la requête et retournez les résultats
    return $qb->getResult();
}
//    /**
//     * @return Ticket[] Returns an array of Ticket objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Ticket
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
