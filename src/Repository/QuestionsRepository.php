<?php

namespace App\Repository;

use App\Entity\Questions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Questions>
 *
 * @method Questions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Questions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Questions[]    findAll()
 * @method Questions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Questions::class);
    }

    public function save(Questions $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Questions $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getReponses($questionID){
        return $this->createQueryBuilder('db')
            ->orderBy('RAND()', Criteria::ASC)
            ->andWhere('db.id != :id')
            ->setParameter('id', $questionID)
            ->select('db.reponse')
            ->setMaxResults(3)
            ->getQuery()
            ->getSingleColumnResult()
            ;
    }

    public function getQuestion(){
        return $this->createQueryBuilder('db')
            ->where('db.nReponse < 5')
            ->orWhere('db.nReponse is null')
            ->orderBy('RAND()', Criteria::DESC)
            ->setMaxResults(1)
            ->getQuery()
            ->getSingleResult()
            ;
    }
}
