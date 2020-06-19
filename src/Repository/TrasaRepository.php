<?php

namespace App\Repository;

use App\Entity\Trasa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use App\Repository\KursRepository;

/**
 * @method Trasa|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trasa|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trasa[]    findAll()
 * @method Trasa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrasaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trasa::class);
    }

    // /**
    //  * @return Trasa[] Returns an array of Trasa objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Trasa
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findAllFull(KursRepository $kursRepo) {
        $ret = array();
        $trasy = $this->findAll();
        $kursyTras = array();
        foreach ($trasy as $trasa) {
            $kursy = $kursRepo->findBy(array('trasa' => $trasa->getId()));
            $kursyTras[] = $kursy;
        }
        $ret['trasy'] = $trasy;
        $ret['kursy'] = $kursyTras;
        return $ret;
    }
}
