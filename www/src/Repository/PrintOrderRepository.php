<?php

namespace App\Repository;

use App\Entity\PrintOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PrintOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrintOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrintOrder[]    findAll()
 * @method PrintOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrintOrderRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PrintOrder::class);
    }

//    /**
//     * @return PrintOrder[] Returns an array of PrintOrder objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PrintOrder
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
