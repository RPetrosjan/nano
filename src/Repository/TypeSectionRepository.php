<?php

namespace App\Repository;

use App\Entity\TypeSection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeSection>
 *
 * @method TypeSection|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeSection|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeSection[]    findAll()
 * @method TypeSection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeSectionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeSection::class);
    }

    public function getSectionRandom(){
        return $this->createQueryBuilder('db')
            ->orderBy('RAND()', Criteria::ASC)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
}
