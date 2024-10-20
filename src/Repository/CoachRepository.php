<?php

namespace App\Repository;

use App\Entity\Coach; // Import the Coach entity
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Coach>
 *
 * @method Coach|null find($id, $lockMode = null, $lockVersion = null)
 * @method Coach|null findOneBy(array $criteria, array $orderBy = null)
 * @method Coach[]    findAll()
 * @method Coach[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoachRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Coach::class);
    }

    // Example method to find coaches by a specific field
    /**
     * @return Coach[] Returns an array of Coach objects
     */
    public function findByCin($cin): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.cin = :cin')
            ->setParameter('cin', $cin)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findOneBySpecialite($specialite): ?Coach
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.specialite = :specialite')
            ->setParameter('specialite', $specialite)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
