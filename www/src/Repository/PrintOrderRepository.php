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
    /**
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PrintOrder::class);
    }
}
