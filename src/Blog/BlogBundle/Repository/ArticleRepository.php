<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 21/08/2018
 * Time: 11:48
 */

namespace Blog\BlogBundle\Repository;


use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
{
    public function getAllArticles()
    {
        $qb = $this->createQueryBuilder('a')
            ->select('a.title, a.text')
            //->where('u.nom like :chaine')
            //->andWhere('u.disponible = 1')
            ->orderBy('a.createdAt', 'DESC');
            //->setParameter('chaine', $chaine);
        return $qb->getQuery()->getResult();


    }


}