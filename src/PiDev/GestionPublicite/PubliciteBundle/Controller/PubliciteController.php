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
            return $this->redirectToRoute('affichepublicite');

        }
        return $this->render('@PiDevGestionPublicitePublicite/Pub/ajout.html.twig',
            array(
                "offs"=>$off ,
                "Form" => $form->createView()
            ));
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

    public function profiterAction(Request $request)
    {   $datej=new \DateTime('now');
        $datej2=$datej->format('Y-m-d');
        $profit = new ProfitePub();
        $em=$this->getDoctrine()->getManager();
        $user=$this->getUser();

        $id=$request->get('idpublicite');
        $puball=$em->getRepository('PiDevGestionPublicitePubliciteBundle:Pub')
            ->findAll();

        $pub=$em->getRepository('PiDevGestionPublicitePubliciteBundle:Pub')
            ->find($id);

        $datedb = $pub->getDatepublicite();


        $datedb1 =$datedb->format('Y-m-d');

        if ($datedb1 > $datej2){

                $profit ->setUser($user);
                $profit->setPub($pub);


                $old_nb = $pub->getNbrprofit();
                $new_nb = $old_nb +1;
                $pub->setNbrprofit($new_nb);

                $em= $this->getDoctrine()->getManager();

                $em->persist($pub);
                $em->persist($profit);
                $em->flush();
                return $this->render('@PiDevGestionPublicitePublicite/Pub/affiche.html.twig',
                    array("pubs"=>$puball));

           }
        else { return $this->render('@PiDevGestionPublicitePublicite/Pub/non.html.twig');

        }
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
}