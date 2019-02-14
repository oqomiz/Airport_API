<?php

namespace App\Repository;

use App\Entity\AirTraficController;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AirTraficController|null find($id, $lockMode = null, $lockVersion = null)
 * @method AirTraficController|null findOneBy(array $criteria, array $orderBy = null)
 * @method AirTraficController[]    findAll()
 * @method AirTraficController[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AirTraficControllerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AirTraficController::class);
    }

    // /**
    //  * @return AirTraficController[] Returns an array of AirTraficController objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AirTraficController
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
