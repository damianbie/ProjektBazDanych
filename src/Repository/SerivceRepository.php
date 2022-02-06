<?php

namespace App\Repository;

use App\Entity\Serivce;
use App\Entity\Worker;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use function Doctrine\ORM\QueryBuilder;

/**
 * @method Serivce|null find($id, $lockMode = null, $lockVersion = null)
 * @method Serivce|null findOneBy(array $criteria, array $orderBy = null)
 * @method Serivce[]    findAll()
 * @method Serivce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SerivceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Serivce::class);
    }

    // /**
    //  * @return Serivce[] Returns an array of Serivce objects
    //  */
    public function getServicesWithoutWorker()
    {
        $q = $this->createQueryBuilder('s')
            ->getQuery()
            ->getResult();

        $data = [];
        foreach ($q as $s)
        {
            if($s->getMadeBy()->count() == 0)
                $data[] = $s;
        }
        return $data;
    }

    /*
    public function findOneBySomeField($value): ?Serivce
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
