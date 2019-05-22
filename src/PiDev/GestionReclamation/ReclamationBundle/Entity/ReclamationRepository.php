<?php
/**
 * Created by PhpStorm.
 * User: ihebm
 * Date: 21/02/2019
 * Time: 10:32
 */

namespace PiDev\GestionReclamation\ReclamationBundle\Entity;

use Doctrine\ORM\EntityRepository;
use PiDev\GestionCategorie\CategorieBundle\Entity\Categorie;
class ReclamationRepository extends EntityRepository
{
    public function findCategorieParametre($nomcategorie)
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT p FROM PiDevGestionReclamationReclamationBundle:Reclamation p  JOIN p.categorie m  where m.nomcategorie =:nomcategorie ORDER BY p.datereclam DESC" )
            ->setParameter('nomcategorie',$nomcategorie);

        return $query->getResult();
    }
    public function finddateParametre($datereclam){
        $query = $this->getEntityManager()
            ->createQuery("SELECT p FROM PiDevGestionReclamationReclamationBundle:Reclamation p  ORDER BY p.datereclam DESC "  )
            ->setParameter('datereclam',$datereclam);
        return $query->getResult();

    }
    public function findByNom($p){

        $query=$this->getEntityManager()->createQuery("SELECT p from PiDevGestionReclamationReclamationBundle:Reclamation p where p.titrereclam like :x")
            ->setParameter('x','%'.$p.'%');
        return $query->getResult();

    }
}