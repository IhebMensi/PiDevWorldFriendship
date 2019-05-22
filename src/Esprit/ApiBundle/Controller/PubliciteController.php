<?php
/**
 * Created by PhpStorm.
 * User: ihebm
 * Date: 09/02/2019
 * Time: 11:03
 */

namespace Esprit\ApiBundle\Controller;


use PiDev\GestionPublicite\PubliciteBundle\Entity\ProfitePub;
use PiDev\GestionPublicite\PubliciteBundle\Entity\Pub;
use PiDev\GestionPublicite\PubliciteBundle\Entity\Publicite;
use PiDev\GestionPublicite\PubliciteBundle\Entity\ReactionPub;
use PiDev\GestionPublicite\PubliciteBundle\Form\PubliciteType;
use PiDev\GestionPublicite\PubliciteBundle\Form\PubType;
use PiDev\GestionPublicite\PubliciteBundle\Form\recherche1Form;
use PiDev\GestionPublicite\PubliciteBundle\Form\rechercheContenuForm;
use PiDev\GestionPublicite\PubliciteBundle\Form\rechercheLieuForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Esprit\ApiBundle\Entity\Task;


class PubliciteController extends Controller
{

    public function profiterAction(Request $request)
    {   $datej=new \DateTime('now');
        $datej2=$datej->format('Y-m-d');
        $profit = new ProfitePub();
        $em=$this->getDoctrine()->getManager();
        $user=$this->getUser();
        $us=$em->getRepository('PiDevGestionUserFosBundle:User')
            ->find($user);
        $k = $us->getPoint();
        $id=$request->get('idpublicite');
        $puball=$em->getRepository('PiDevGestionPublicitePubliciteBundle:Pub')
            ->findAll();

        $pub=$em->getRepository('PiDevGestionPublicitePubliciteBundle:Pub')
            ->find($id);
        $k2=$pub->getPoint();
        $datedb = $pub->getDatepublicite();


        $datedb1 =$datedb->format('Y-m-d');

        if ($datedb1 > $datej2){

            $profit ->setUser($user);
            $profit->setPub($pub);


            $old_nb = $pub->getNbrprofit();
            $new_nb = $old_nb +1;
            $pub->setNbrprofit($new_nb);
            $us->setPoint($k-$k2);
            $em= $this->getDoctrine()->getManager();

            $em->persist($pub);
            $em->persist($profit);
            $em->persist($us);
            $em->flush();
            return  $this->redirectToRoute('findlieucat');

        }
        else { return $this->render('@PiDevGestionPublicitePublicite/Pub/non.html.twig');

        }
    }

    public function chercherAction($nompublicite)
    {
        $em = $this->getDoctrine()->getManager();
        $Evenement = $em->getRepository("EspritApiBundle:Pub")->findpub($nompublicite);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Evenement);
        return new JsonResponse($formatted);
    }



    public function updatePubAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $pub=$em->getRepository("EspritApiBundle:Pub")->find($id);
        $pub->setNompublicite($request->get('nompublicite'));
        $pub->setContenupublicte($request->get('contenupublicte'));
        $em->persist($pub);
        $em->flush();
        return new JsonResponse("success");

    }


    public function supprimerPubAction($id)
    {   $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("EspritApiBundle:Pub")->find($id);
        $em->remove($event);
        $em->flush();
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($event);
        return new JsonResponse($formatted);
    }


    public function findAction($id)
    {
        $tasks = $this->getDoctrine()->getManager()
            ->getRepository('EspritApiBundle:Pub')
            ->find($id);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('PiDevGestionUserFosBundle:User')->find(1);
        $pub=new \Esprit\ApiBundle\Entity\Pub();
        $pub->setNompublicite($request->get('nompublicite'));
        $pub->setContenupublicte($request->get('contenupublicte'));
        $pub->setPays($request->get('pays'));
        $pub->setRegion($request->get('region'));
        $pub->setDatepublicite(new \DateTime($request->get('datepublicite')));

        $pub->setDatepublicitefin(new \DateTime($request->get('datepublicitefin')));

        $pub->setNomimage($request->get('nomimage'));

        $pub->setPoint($request->get('point'));
        $pub->setPrixproduit($request->get('prixproduit'));
        $pub->setPourcentage($request->get('pourcentage'));
        $pub->setUser($user);



      //  $k=$p*(100-$pr)/100;

       $pub->setPrixremise($request->get('prixremise'));
        $em->persist($pub);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($pub);
        return new JsonResponse($formatted);
    }
    public function ajoutAction(Request $request)
    {   $user =$this->getUser();
         $id=$request->get('idoffre');
        $em=$this->getDoctrine()->getManager();
        $off=$em->getRepository('PiDevGestionPublicitePubliciteBundle:Offre')
           ->find($id);
        $Pub = new Pub();
          $Pub->setUser($user);
          $Pub->setOffr($off);


        $form = $this->createForm(PubType::class, $Pub);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //echo'suite au clic sur le bouton sumit';
            $em = $this->getDoctrine()->getManager();
            $Pub->uploadProfilePicture();
            $em->persist($Pub);
            $em->persist($off);
            $em->flush();
            return $this->redirectToRoute('valider');

        }
        return $this->render('@PiDevGestionPublicitePublicite/Pub/ajout.html.twig',
            array(
                "offs"=>$off ,
                "Form" => $form->createView()
            ));
    }
    public function accepterAction(Request $request)
    {
        $id = $request->get('idpublicite');
        $em = $this->getDoctrine()->getManager();
        $Pub = $em->getRepository('PiDevGestionPublicitePubliciteBundle:Pub')
            ->find($id);
        $eta =$Pub->getEtat();
       $p=$Pub->getPrixproduit();
           $pr=$Pub->getPourcentage();
               $p1=$Pub->getPrixremise();
             $k=$p*(100-$pr)/100;
        $Pub->setEtat("oui");
        $Pub->setPrixremise($k);

        $em= $this->getDoctrine()->getManager();

        $em->persist($Pub);

        $em->flush();
        return $this->redirectToRoute('findlieucat');


    }
    public function refuserAction(Request $request)
    {
        $id = $request->get('idpublicite');
        $em = $this->getDoctrine()->getManager();
        $Pub = $em->getRepository('PiDevGestionPublicitePubliciteBundle:Pub')
            ->find($id);

        $Pub->setEtat("refuser");
        $em= $this->getDoctrine()->getManager();
        $em->persist($Pub);
        $em->flush();
        return $this->redirectToRoute('affichepublicite');


    }
    public function afficheAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pub = $em->getRepository('EspritApiBundle:Pub')
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($pub);
        return new JsonResponse($formatted);
      //  return $this->render('@PiDevGestionPublicitePublicite/Pub/affiche.html.twig',
            //array(
         //       "pubs" => $pub
        //    ));
    }
    public function deleteAction(Request $request)
    {
        $id = $request->get('idpublicite');
        $em = $this->getDoctrine()->getManager();
        $Pub = $em->getRepository('PiDevGestionPublicitePubliciteBundle:Pub')
            ->find($id);
        $em->remove($Pub);
        $em->flush();
        return $this->redirectToRoute('affichepublicite');

    }
    public function updatepubliciteAction(Request $request){
        $id=$request->get('idpublicite');
        $em=$this->getDoctrine()->getManager();
        $pub=$em->getRepository('PiDevGestionPublicitePubliciteBundle:Pub')->find($id);
        $form=$this->createForm(PubType::class,$pub);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $pub->uploadProfilePicture();

            $em->persist($pub);
            $em->flush();
            return $this->redirectToRoute('affichepublicite');
        }
        return $this->render('@PiDevGestionPublicitePublicite/Pub/update1.html.twig',
            array(
                "Form"=>$form->createView()
            )
            );
    }
    public function rechercheAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $pubs = $em->getRepository('PiDevGestionPublicitePubliciteBundle:Pub')
            ->findAll();
        if ($request->isMethod('POST')) {

            $nompublicite = $request->get('Nompublicite');
            $categorie = $request->get('Categorie');

            $pubs = $em
                ->getRepository('PiDevGestionPublicitePubliciteBundle:Pub')
                ->findBy(array(
                    'nompublicite' => $nompublicite,

                ));

        }
        return $this->render('@PiDevGestionPublicitePublicite/Pub/recherche.html.twig',
            array(
                "pubs" => $pubs
            ));
    }
    public function recherchecatAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $pubs = $em->getRepository('PiDevGestionPublicitePubliciteBundle:Pub')
            ->findAll();
        $form1 = $this-> createForm(recherche1Form::class,$pubs);
        $form1->handleRequest($request);
        if($form1->isSubmitted() && $form1->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $pubs=$em->getRepository("PiDevGestionPublicitePubliciteBundle:Pub")
                ->findBy(array('categorie'=>$pubs->getCategorie()));

            return $this->render('@PiDevGestionPublicitePublicite/Pub/recherchecategorie.html.twig',
                array("pubs"=>$pubs));
        }
        return $this->render('@PiDevGestionPublicitePublicite/Pub/recherchecategorie.html.twig',
            array('form1'=>$form1->createView(),"pubs"=>$pubs));

    }
    public function recherchecontenuDQLAction(Request $request)
    {

        $pub=new Pub();

        $em = $this->getDoctrine()->getManager();
        $pubs = $em->getRepository('PiDevGestionPublicitePubliciteBundle:Pub')
            ->findAll();
        $Form=$this->createForm(rechercheContenuForm::class,$pub);
        $Form->handleRequest($request);
        if($Form->isValid()){
            $contenupublicite=$pub->getContenupublicte();
            $pubs=$em->getRepository('PiDevGestionPublicitePubliciteBundle:Pub')
                ->findCategorieParametre1($contenupublicite);

        }

        return $this->render('@PiDevGestionPublicitePublicite/Pub/recherche1.html.twig',
            array(
                "Form" => $Form->createView(),
                "pubs" => $pubs
            ));
    }
    public function recherchecategorieDQLAction(Request $request)
    {

        $pub=new Pub();

        $em = $this->getDoctrine()->getManager();
        $pubs = $em->getRepository('PiDevGestionPublicitePubliciteBundle:Pub')
            ->findAll();
        $Form=$this->createForm(recherche1Form::class,$pub);
        $Form->handleRequest($request);
        if($Form->isValid()){
            $nomcategorie=$pub->getCategorie()->getNomcategorie();
           // var_dump($categorie);die;
            $pubs=$em->getRepository('PiDevGestionPublicitePubliciteBundle:Pub')
                ->findCategorieParametre1($nomcategorie);

        }

        return $this->render('@PiDevGestionPublicitePublicite/Pub/recherche2.html.twig',
            array(
                "Form" => $Form->createView(),
                "pubs" => $pubs
            ));
    }
    public function recherchelieuDQLAction(Request $request)
    {

        $pub=new Pub();

        $em = $this->getDoctrine()->getManager();
        $pubs = $em->getRepository('PiDevGestionPublicitePubliciteBundle:Pub')
            ->findAll();
        $Form=$this->createForm(rechercheLieuForm::class,$pub);
        $Form->handleRequest($request);
        if($Form->isValid()){
         $pays=$pub->getPays();
         $region=$pub->getRegion();
         $adresse=$pub->getAdresse();
            // var_dump($categorie);die;
            $pubs=$em->getRepository('PiDevGestionPublicitePubliciteBundle:Pub')
                -> findLieu1Parametre($pays,$region,$adresse);

        }

        return $this->render('@PiDevGestionPublicitePublicite/Pub/recherchelieu.html.twig',
            array(
                "Form" => $Form->createView(),
                "pubs" => $pubs
            ));
    }
    public function recherchelieucatAction(Request $request)
    {
        $pub=new Pub();
       $etat=$pub->getEtat();
        $em = $this->getDoctrine()->getManager();
        $pubs = $em->getRepository('PiDevGestionPublicitePubliciteBundle:Pub')
            ->findetatParametre();
        $Form=$this->createForm(rechercheLieuForm::class,$pub);
        $Form->handleRequest($request);

        if($Form->isValid()){
            $pays=$pub->getPays();
            $region=$pub->getRegion();

            $nomcategorie=$pub->getCategorie()->getNomcategorie();
            // var_dump($categorie);die;
            $pubs=$em->getRepository('PiDevGestionPublicitePubliciteBundle:Pub')
                ->findLieullParametre($pays,$region,$nomcategorie);

        }

        return $this->render('@PiDevGestionPublicitePublicite/Pub/recherchelieucat.html.twig',
            array(
                "Form" => $Form->createView(),
                "pubs" => $pubs
            ));
    }

    public function getRealEntities($entities){
        foreach ($entities as $entity){
            $realEntities[$entity->getPays()] = [$entity->getNom(), $entity->getDescription(), $entity->getDate(), $entity->getImageFile(),$entity->getEmail(),$entity->getPhone(),$entity->getSpecialite()];
        }
        return $realEntities;
    }
    /*
    public function profiterAction(Request $request)
    {   $datej=new \DateTime('now');
        $datej2=$datej->format('Y-m-d');
        $profit = new ProfitePub();
        $em=$this->getDoctrine()->getManager();
        $user=$this->getUser();
        $us=$em->getRepository('PiDevGestionUserFosBundle:User')
            ->find($user);
        $k = $us->getPoint();
        $id=$request->get('idpublicite');
        $puball=$em->getRepository('PiDevGestionPublicitePubliciteBundle:Pub')
            ->findAll();

        $pub=$em->getRepository('PiDevGestionPublicitePubliciteBundle:Pub')
            ->find($id);
   $k2=$pub->getPoint();
        $datedb = $pub->getDatepublicite();


        $datedb1 =$datedb->format('Y-m-d');

        if ($datedb1 > $datej2){

                $profit ->setUser($user);
                $profit->setPub($pub);


                $old_nb = $pub->getNbrprofit();
                $new_nb = $old_nb +1;
                $pub->setNbrprofit($new_nb);
  $us->setPoint($k-$k2);
                $em= $this->getDoctrine()->getManager();

                $em->persist($pub);
                $em->persist($profit);
            $em->persist($us);
                $em->flush();
          return  $this->redirectToRoute('findlieucat');

           }
        else { return $this->render('@PiDevGestionPublicitePublicite/Pub/non.html.twig');

        }
    }
    */
    public function AfficherprofituserAction()
    {
        $iheb = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $pubs = $em->getRepository("PiDevGestionPublicitePubliciteBundle:ProfitePub")
            ->findByUser($iheb);


        return $this->render('@PiDevGestionPublicitePublicite/Pub/affpubprofit.html.twig',
            array("pubs" => $pubs));


    }
    public function Afficherpub1Action($idpublicite){
        $em = $this->getDoctrine()->getManager();
        $pubs = $em->getRepository('PiDevGestionPublicitePubliciteBundle:Pub')
            ->findBypub($idpublicite);



        return $this->render('@PiDevGestionPublicitePublicite/Pub/aff.html.twig',
            array("pubs"=>$pubs )
        );
    }
    public function deletedqlAction(Request $request,$idpublicite)
    {
        $idpublicite = $request->get('idpublicite');
        $em = $this->getDoctrine()->getManager();
        $Pub = $em->getRepository('PiDevGestionPublicitePubliciteBundle:Pub')
            ->deletepub($idpublicite);

        return $this->redirectToRoute('affichepublicite');

    }



    public function likAction($id, $idu)
    {

       // $id=$request->get('idpublicite');
        $em= $this->getDoctrine()->getManager();
        $pub=$em->getRepository("EspritApiBundle:Pub")->find($id);
        //$idu=$this->getUser();
        $user=$em->getRepository("PiDevGestionUserFosBundle:User")->find($idu);
        $like=$em->getRepository("PiDevGestionPublicitePubliciteBundle:ReactionPub")->findBy(["Pub"=>$pub,"User"=>$user]);

        $k = "like";
        $k1 = "dislike";
        $li=$em->getRepository("PiDevGestionPublicitePubliciteBundle:ReactionPub")-> findreParametre($user,$pub,$k);
        $li2=$em->getRepository("PiDevGestionPublicitePubliciteBundle:ReactionPub")-> findreParametre($user,$pub,$k1);
        if($like != null) {
            //remove reaction
                 $em->flush();

            if ( $li != null){
                $serializer = new Serializer([new ObjectNormalizer()]);
                $formatted = $serializer->normalize("deja aimer");
                return new JsonResponse($formatted);

            }
            if ( $li2 != null){
                $em->remove($like[0]);
                $em->flush();
                $old_nb_like = $pub->getNbrdislikes();

                $new_nb_like = $old_nb_like - 1;
                $pub->setNbrdislikes($new_nb_like);
                $em->persist($pub);
                $em->flush();
                $like = new ReactionPub();
                $like->setUser($user);
                $like->setPub($pub);
                $like->setReaction('like');
                $em->persist($like);
                $em->flush();

                $old_nb_like = $pub->getNbrlikes();

                $new_nb_like = $old_nb_like + 1;
                $pub->setNbrlikes($new_nb_like);
                $em->persist($pub);
                $em->flush();
                $nb = $pub->getNbrlikes();
                $serializer = new Serializer([new ObjectNormalizer()]);
                $formatted = $serializer->normalize("kount dislike walit like");
                return new JsonResponse($formatted);

            }

        }

else {
    $like = new ReactionPub();
    $like->setUser($user);
    $like->setPub($pub);
    $like->setReaction('like');
    $em->persist($like);
    $em->flush();

    $old_nb_like = $pub->getNbrlikes();

    $new_nb_like = $old_nb_like + 1;
    $pub->setNbrlikes($new_nb_like);
    $em->persist($pub);
    $em->flush();
    $nb = $pub->getNbrlikes();


    $serializer = new Serializer([new ObjectNormalizer()]);
    $formatted = $serializer->normalize("like avec succes");
    return new JsonResponse($formatted);

}

    }
    public function DislikeAction($id,$idu)
    { // $id=$request->get('idpublicite');
        $em= $this->getDoctrine()->getManager();
        $pub=$em->getRepository("PiDevGestionPublicitePubliciteBundle:Pub")->find($id);
        //$idu=$this->getUser();
        $user=$em->getRepository("PiDevGestionUserFosBundle:User")->find($idu);
        $like=$em->getRepository("PiDevGestionPublicitePubliciteBundle:ReactionPub")->findBy(["Pub"=>$pub,"User"=>$user]);

        $k = "like";
        $k1 = "dislike";
        $li=$em->getRepository("PiDevGestionPublicitePubliciteBundle:ReactionPub")-> findreParametre($user,$pub,$k);
        $li2=$em->getRepository("PiDevGestionPublicitePubliciteBundle:ReactionPub")-> findreParametre($user,$pub,$k1);
        if($like != null) {
            $em->remove($like[0]);
            $em->flush();


            if ( $li != null){
                $old_nb_like = $pub->getNbrlikes();

                $new_nb_like = $old_nb_like - 1;
                $pub->setNbrlikes($new_nb_like);
                $em->persist($pub);
                $em->flush();
                $serializer = new Serializer([new ObjectNormalizer()]);
                $formatted = $serializer->normalize("kount like wlit dislike");
                return new JsonResponse($formatted);

            }
            if ( $li2 != null){
                $old_nb_like = $pub->getNbrdislikes();

                $new_nb_like = $old_nb_like - 1;
                $pub->setNbrdislikes($new_nb_like);
                $em->persist($pub);
                $em->flush();

                $serializer = new Serializer([new ObjectNormalizer()]);
                $formatted = $serializer->normalize("deja dislike");
                return new JsonResponse($formatted);




            }


        }  $like = new ReactionPub();

            $like->setUser($user);
            $like->setPub($pub);
            $like->setReaction('Dislike');
            $em->persist($like);
            $em->flush();

            $old_nb_like = $pub->getNbrdislikes();

            $new_nb_like = $old_nb_like + 1;
            $pub->setNbrdislikes($new_nb_like);
            $em->persist($pub);
            $em->flush();
            $nb = $pub->getNbrdislikes();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize("dislike avec succes");
        return new JsonResponse($formatted);



    }
public function validerAction(){
        return $this->render('@PiDevGestionPublicitePublicite/Pub/pagevalider.html.twig');
}
}