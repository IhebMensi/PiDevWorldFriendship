<?php

namespace PiDev\GestionVente\VenteBundle\Repository;

/**
 * FavorisProduitRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FavorisProduitRepository extends \Doctrine\ORM\EntityRepository
{
    public function findfavdelBy($user,$idp)
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT p FROM PiDevGestionVenteVenteBundle:FavorisProduit p 
             where p.user=:user and p.prod=:prod")
            ->setParameter('user',$user)->setParameter('prod',$idp);

        return $query->getResult();
    }
}
