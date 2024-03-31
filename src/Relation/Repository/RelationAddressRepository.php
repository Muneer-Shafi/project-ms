<?php

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\Relation\Repository;

use App\Relation\Entity\RelationAddress;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RelationAddress>
 *
 * @method RelationAddress|null find($id, $lockMode = null, $lockVersion = null)
 * @method RelationAddress|null findOneBy(array $criteria, array $orderBy = null)
 * @method RelationAddress[]    findAll()
 * @method RelationAddress[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RelationAddressRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RelationAddress::class);
    }

    public function save(RelationAddress $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RelationAddress $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return RelationAddress[] Returns an array of RelationAddress objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?RelationAddress
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
