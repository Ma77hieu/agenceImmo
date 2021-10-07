<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\SearchProperty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }

    /**
     * @return Property[]
     */
    public function findAllVisible(): array
    {
        // $val=false;
        $result=$this->createQueryBuilder('p')
        ->where("p.sold = 'false'")
        // ->setParameter('val', $val)
        ->getQuery()
        ->getResult()
        ;
        dump($result);
        return $result;
    }

    public function queryAllVisible()
    {
        // $val=false;
        $result2=$this->createQueryBuilder('p')
        ->where("p.sold = 'false'")
        // ->setParameter('val', $val)
        ->getQuery()
        ;
        dump($result2); 
        return $result2;
    }

    public function searchFromVisible(SearchProperty $search)
    {
        $query=$this->createQueryBuilder('s')
        ->where("s.sold = 'false'");
        if ($search->getMinPrice())
        {
            $value=$search->getMinPrice();
            $query=$query
            ->andWhere("s.price >= $value");
            dump($query);
        }
        if ($search->getMaxPrice())
        {
            $value=$search->getMaxPrice();
            $query=$query
            ->andWhere("s.price <= $value");
            dump($query);
        }
        dump($query);
        return $query->getQuery();
    }

    // public function querySearch($params)
    // {
    //     $entityProperties=$this->
    //     foreach ()
    //     $result2=$this->createQueryBuilder('p')
    //     ->where("p.sold = 'false'")
    //     // ->setParameter('val', $val)
    //     ->getQuery()
    //     ;
    //     dump($result2);
    //     return $result2;
    // }

    
    /**
     * @return Property[]
     */
    public function findLatest(): array
    {
        $result=$this->createQueryBuilder('p')
        // ->where("p.sold = :val")
        // ->setParameter('val', $val)
        ->where("p.sold = 'false'")
        ->orderBy('p.created_at', 'DESC')
        ->setMaxResults(5)
        ->getQuery()
        ->getResult()
        ;
        dump($result);
        return $result;
    }

    // /**
    //  * @return Property[] Returns an array of Property objects
    //  */
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
    public function findOneBySomeField($value): ?Property
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
