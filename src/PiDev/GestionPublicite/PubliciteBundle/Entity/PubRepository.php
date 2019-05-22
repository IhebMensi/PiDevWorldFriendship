<?php
/**
 * Created by PhpStorm.
 * User: ihebm
 * Date: 14/02/2019
 * Time: 17:51
 */

namespace PiDev\GestionPublicite\PubliciteBundle\Entity;


use Doctrine\ORM\EntityRepository;
use PiDev\GestionCategorie\CategorieBundle\Entity\Categorie;
class PubRepository extends EntityRepository
{


    public function findContenuParametre($contenupublicte){
        $query = $this->getEntityManager()
            ->createQuery("SELECT p FROM PiDevGestionPublicitePubliciteBundle:Pub p where p.contenupublicte LIKE
 :contenupublicte AND p.datepublicite<= CURRENT_DATE () ORDER BY p.datepublicite ASC "  )
            ->setParameter('contenupublicte','%'.$contenupublicte.'%');
        return $query->getResult();

    }

    public function findCategorieParametre($nomcategorie){
        $query = $this->getEntityManager()
            ->createQuery("SELECT p FROM PiDevGestionPublicitePubliciteBundle:Pub p  where p.categorie.nomcategorie = :nomcategorie  "  )
            ->setParameter('nomcategorie','%'.$nomcategorie.'%');
        return $query->getResult();



    }


    public function findcar($pays)
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT v FROM EspritParcBundle:Voiture v where v.dateMiseCirculation > CURRENT_DATE() 
        AND JOIN v.Modele m  where m.Pays =:pays" )
            ->setParameter('pays',$pays);

        return $query->getResult();
    }




    public function findCategorieParametre1($nomcategorie)
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT p FROM PiDevGestionPublicitePubliciteBundle:Pub p  JOIN p.categorie m  where m.nomcategorie =:nomcategorie" )
            ->setParameter('nomcategorie',$nomcategorie);

        return $query->getResult();
    }
    public function findLieullParametre($pays,$region,$nomcategorie)
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT p FROM PiDevGestionPublicitePubliciteBundle:Pub p  JOIN  p.categorie m  
            where (m.nomcategorie =:nomcategorie AND  p.pays =:pays AND p.region =:region  ) 
            OR (m.nomcategorie =:nomcategorie AND  p.pays =:pays )   OR (  p.pays =:pays AND  p.region =:region ) 
               OR (m.nomcategorie =:nomcategorie AND p.region =:region) 
                    " )
            ->setParameter('pays',$pays)->setParameter('region',$region)->setParameter('nomcategorie',$nomcategorie);

        return $query->getResult();
    }
    public function findLieu1Parametre($pays,$region,$adresse)
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT p FROM PiDevGestionPublicitePubliciteBundle:Pub p   where p.pays =:pays OR p.region =:region OR p.adresse =:adresse" )
            ->setParameter('pays',$pays)->setParameter('region',$region)->setParameter('adresse',$adresse);

        return $query->getResult();
    }

    public function findetatParametre()
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT p FROM PiDevGestionPublicitePubliciteBundle:Pub p   where p.etat =:etat")
            ->setParameter('etat','oui');

        return $query->getResult();
    }
    public function findByPays1(){
        $query=$this->createQueryBuilder('m')
            ->where('m.Pays = :param')
            ->setParameter('param','Allemagne');
        return $query->getQuery()->getResult();

    }
    public function findreParametre($User,$Pub,$reaction)
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT p FROM PiDevGestionPublicitePubliciteBundle:ReactionPub p   where p.User =:User AND p.Pub =:Pub AND p.reaction =:reaction" )
            ->setParameter('User',$User)->setParameter('Pub',$Pub)->setParameter('reaction',$reaction);

        return $query->getResult();
    }

public function deletepub($idpublicite)
{
   $query=$this->getEntityManager()->
    createQuery('DELETE p FROM PiDevGestionPublicitePubliciteBundle:Pub p  WHERE p.datepublicitefin >= CURRENT_DATE() ');
    $query->setParameter('idpublicite', $idpublicite);
    $query->execute();
}
    public function findBypub($idpublicite){
        $query = $this->createQueryBuilder('m')
            ->where('m.idpublicite = :param')
            ->setParameter('param',$idpublicite);
        return $query->getQuery()->getResult();
    }
}