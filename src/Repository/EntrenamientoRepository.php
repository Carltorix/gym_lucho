<?php

namespace App\Repository;

use App\Entity\Entrenamiento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Entrenamiento|null find($id, $lockMode = null, $lockVersion = null)
 * @method Entrenamiento|null findOneBy(array $criteria, array $orderBy = null)
 * @method Entrenamiento[]    findAll()
 * @method Entrenamiento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntrenamientoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Entrenamiento::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Entrenamiento $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Entrenamiento $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Entrenamiento[] Returns an array of Entrenamiento objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Entrenamiento
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
