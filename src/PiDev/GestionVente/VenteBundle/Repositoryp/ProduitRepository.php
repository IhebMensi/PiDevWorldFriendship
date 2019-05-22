<?php

namespace PiDev\GestionVente\VenteBundle\Repositoryp;
use Doctrine\ORM\EntityRepository;

/**
 * ProduitRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProduitRepository extends \Doctrine\ORM\EntityRepository
{
    public function findNewDateProduit(){
        $query = $this->getEntityManager()
            ->createQuery("SELECT p FROM PiDevGestionVenteVenteBundle:Produit p ORDER BY p.datemisevente DESC "  );
        return $query->getResult();

    }
    public function findByPrix($prix)
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT i FROM PiDevGestionVenteVenteBundle:Produit i WHERE i.prix<=:prix "  )
        ->setParameter('prix',$prix);
        return $query->getResult();
    }

    public function findProduit($pays,$categorie)
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT p FROM PiDevGestionVenteVenteBundle:Produit p WHERE p.pays =:pays OR p.categorie =:categorie ")
            ->setParameter('pays', $pays)->setParameter('categorie', $categorie);

        return $query->getResult();

    }
    public function findProduitt($categorie)
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT p FROM PiDevGestionVenteVenteBundle:Produit p where p.categorie =:categorie" )
            ->setParameter('categorie',$categorie);

        return $query->getResult();
    }
    public function findProdfav($id)
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT p FROM PiDevGestionVenteVenteBundle:Produit e INNER JOIN PiDevGestionVenteVenteBundle:FavoritProduit f ON p.user=f.user")

            ->setParameter('user',$id);

        return $query->getResult();
    }


    }
