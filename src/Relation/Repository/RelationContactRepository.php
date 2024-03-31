<?php

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\Relation\Repository;

use App\Relation\Entity\RelationContact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RelationContact>
 *
 * @method RelationContact|null find($id, $lockMode = null, $lockVersion = null)
 * @method RelationContact|null findOneBy(array $criteria, array $orderBy = null)
 * @method RelationContact[]    findAll()
 * @method RelationContact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RelationContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RelationContact::class);
    }

    public function save(RelationContact $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RelationContact $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return RelationContact[] Returns an array of RelationContact objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Contact
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
