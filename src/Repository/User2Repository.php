<?php

namespace App\Repository;

use App\Entity\User2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User2|null find($id, $lockMode = null, $lockVersion = null)
 * @method User2|null findOneBy(array $criteria, array $orderBy = null)
 * @method User2[] findAll()
 * @method User2[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class User2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User2::class);
    }
  

    public function getAllUserEmails()
    {
        // Utilisez le repository des utilisateurs pour récupérer toutes les adresses e-mail
        $userRepository = $this->entityManager->getRepository(User::class);
        $users = $userRepository->findAll();

        // Récupérez les adresses e-mail des utilisateurs
        return array_map(function ($user) {
            return $user->getEmail();
        }, $users);
    }


}
