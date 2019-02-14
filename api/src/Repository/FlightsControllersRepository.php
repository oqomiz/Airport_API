<?php

namespace App\Repository;

use App\Entity\FlightsControllers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FlightsControllers|null find($id, $lockMode = null, $lockVersion = null)
 * @method FlightsControllers|null findOneBy(array $criteria, array $orderBy = null)
 * @method FlightsControllers[]    findAll()
 * @method FlightsControllers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlightsControllersRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FlightsControllers::class);
    }

    // /**
    //  * @return FlightsControllers[] Returns an array of FlightsControllers objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FlightsControllers
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
