<?php
/**
 * Created by PhpStorm.
 * User: ihebm
 * Date: 09/02/2019
 * Time: 11:03
 */

namespace PiDev\GestionPublicite\PubliciteBundle\Controller;


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

class PubliciteController extends Controller
{
    public function affichepubmoAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pub = $em->getRepository('PiDevGestionPublicitePubliciteBundle:Pub')
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($pub);
        return new JsonResponse($formatted);
        //  return $this->render('@PiDevGestionPublicitePublicite/Pub/affiche.html.twig',
        //array(
        //       "pubs" => $pub
        //    ));
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

        $pub = $em->getRepository('PiDevGestionPublicitePubliciteBundle:Pub')
            ->findAll();

        return $this->render('@PiDevGestionPublicitePublicite/Pub/affiche.html.twig',
            array(
                "pubs" => $pub
            ));
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
    public function profiter1Action($id,$idu)
    {   $datej=new \DateTime('now');
        $datej2=$datej->format('Y-m-d');


        $profit = new ProfitePub();
        $em=$this->getDoctrine()->getManager();
        $em1 = $this->getDoctrine()->getManager();
        $em2 = $this->getDoctrine()->getManager();
        //$user=$this->getUser();
        $even = $em->getRepository('PiDevGestionPublicitePubliciteBundle:Pub')->find($id);
        $user = $em1->getRepository('PiDevGestionUserFosBundle:User')->find($idu);
        $like = $em2->getRepository("PiDevGestionPublicitePubliciteBundle:ProfitePub")->findBy(["pub" => $even, "user" => $user]);
        $k = $user->getPoint();
       // $id=$request->get('idpublicite');
        $puball=$em->getRepository('PiDevGestionPublicitePubliciteBundle:Pub')
            ->findAll();

        $pub=$em->getRepository('PiDevGestionPublicitePubliciteBundle:Pub')
            ->find($id);
        $k2=$pub->getPoint();
        $datedb = $pub->getDatepublicite();


        $datedb1 =$datedb->format('Y-m-d');
//datedb1 > $datej2
        if ( $like != null){
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize("deja profité");
            return new JsonResponse($formatted);

        }
        else {
        if ($k>$k2){

            $profit ->setUser($user);
            $profit->setPub($pub);


            $old_nb = $pub->getNbrprofit();
            $new_nb = $old_nb +1;
            $pub->setNbrprofit($new_nb);
            $user->setPoint($k-$k2);
            $em= $this->getDoctrine()->getManager();

            $em->persist($pub);
            $em->persist($profit);
            $em->persist($user);
            $em->flush();
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize("profiter avec succes");
            return new JsonResponse($formatted);

        }
        else {        $msg = "déja participer ";
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize($msg);
            return new JsonResponse($formatted);

        }}
    }


    public function mespubAction($idu)
    {    $em = $this->getDoctrine()->getManager();
        $marwa = $em->getRepository("PiDevGestionUserFosBundle:User")->find($idu);
        // $marwa = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("PiDevGestionPublicitePubliciteBundle:Pub")
            ->findByUser($marwa);

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($event);
        return new JsonResponse($formatted);}


    public function likAction($id, $idu)
    {

        // $id=$request->get('idpublicite');
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
            //remove reaction
            $em->flush();

            if ( $li != null){
                $serializer = new Serializer([new ObjectNormalizer()]);
                $formatted = $serializer->normalize("deja aimée");
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
                $formatted = $serializer->normalize("de dislike vers like :)");
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
    public function DislikAction($id, $idu)
    {  //$id=$request->get('idpublicite');
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

            if ( $li != null){

                $em->remove($like[0]);
                $em->flush();
                $old_nb_like = $pub->getNbrlikes();

                $new_nb_like = $old_nb_like - 1;
                $pub->setNbrlikes($new_nb_like);
                $em->persist($pub);
                $em->flush();
                $serializer = new Serializer([new ObjectNormalizer()]);
                $formatted = $serializer->normalize("de like vers dislike :(");
                return new JsonResponse($formatted);
            }
            if ( $li2 != null){
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
    public function LikeAction(Request $request)
    {

        $id=$request->get('idpublicite');
        $em= $this->getDoctrine()->getManager();
        $pub=$em->getRepository("PiDevGestionPublicitePubliciteBundle:Pub")->find($id);
        $idu=$this->getUser();
        $user=$em->getRepository("PiDevGestionUserFosBundle:User")->find($idu);
        $like=$em->getRepository("PiDevGestionPublicitePubliciteBundle:ReactionPub")->findBy(["Pub"=>$pub,"User"=>$user]);

        $k = "like";
        $k1 = "dislike";
        $li=$em->getRepository("PiDevGestionPublicitePubliciteBundle:ReactionPub")-> findreParametre($user,$pub,$k);
        $li2=$em->getRepository("PiDevGestionPublicitePubliciteBundle:ReactionPub")-> findreParametre($user,$pub,$k1);
        if($like != null) {
            //remove reaction
            $em->remove($like[0]);
            $em->flush();
            if ( $li != null){
                $old_nb_like = $pub->getNbrlikes();

                $new_nb_like = $old_nb_like - 1;
                $pub->setNbrlikes($new_nb_like);
                $em->persist($pub);
                $em->flush();

            }
            if ( $li2 != null){
                $old_nb_like = $pub->getNbrdislikes();

                $new_nb_like = $old_nb_like - 1;
                $pub->setNbrdislikes($new_nb_like);
                $em->persist($pub);
                $em->flush();

            }

        }


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

           return $this->redirectToRoute('findlieucat');


    }
    public function DislikeAction(Request $request)
    {  $id=$request->get('idpublicite');
        $em= $this->getDoctrine()->getManager();
        $pub=$em->getRepository("PiDevGestionPublicitePubliciteBundle:Pub")->find($id);
        $idu=$this->getUser();
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

            }
            if ( $li2 != null){
                $old_nb_like = $pub->getNbrdislikes();

                $new_nb_like = $old_nb_like - 1;
                $pub->setNbrdislikes($new_nb_like);
                $em->persist($pub);
                $em->flush();

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

            return $this->redirectToRoute('findlieucat');



    }
public function validerAction(){
        return $this->render('@PiDevGestionPublicitePublicite/Pub/pagevalider.html.twig');
}
}