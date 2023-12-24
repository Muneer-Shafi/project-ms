<?php
declare(strict_types=1);


namespace App\Subsidiary\Application\Repository;

use App\Subsidiary\Domain\Entity\Subsidiary;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Subsidiary>
 *
 * @method Subsidiary|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subsidiary|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subsidiary[]    findAll()
 * @method Subsidiary[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubsidiaryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subsidiary::class);
    }

//    /**
//     * @return Subsidiary[] Returns an array of Subsidiary objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Subsidiary
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
