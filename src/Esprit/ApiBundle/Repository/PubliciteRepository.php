<?php
/**
 * Created by PhpStorm.
 * User: ihebm
 * Date: 24/04/2019
 * Time: 09:56
 */

namespace Esprit\ApiBundle\Repository;


class PubliciteRepository extends \Doctrine\ORM\EntityRepository
{
    public function findpub($nompublicite)
    {
        $query=$this->getEntityManager()->createQuery("select m from EspritApiBundle:Pub m where m.nompublicite like :nompublicite")
            ->setParameter('nompublicite','%'.$nompublicite.'%');
        return $query->getResult();
    }
}