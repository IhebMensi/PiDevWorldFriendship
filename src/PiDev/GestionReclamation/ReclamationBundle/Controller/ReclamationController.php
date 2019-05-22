<?php
/**
 * Created by PhpStorm.
 * User: ihebm
 * Date: 09/02/2019
 * Time: 18:09
 */

namespace PiDev\GestionReclamation\ReclamationBundle\Controller;


use PiDev\GestionReclamation\ReclamationBundle\Entity\Feedback;
use PiDev\GestionReclamation\ReclamationBundle\Entity\Reclamation;
use PiDev\GestionReclamation\ReclamationBundle\Form\ReclamationType;
use PiDev\GestionReclamation\ReclamationBundle\Form\FeedbackType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PiDev\GestionReclamation\ReclamationBundle\Form\RechercheCategorieForm;
use Symfony\Component\HttpFoundation\Response;


class ReclamationController extends Controller
{

    public function  ajoutAction(Request $request){

        $user = $this->getUser();
        $reclam=new Reclamation();
        $reclam ->setUser($user);
$reclam ->setDatereclam(new \DateTime('now'));

        $form=$this->createForm(ReclamationType::class,$reclam);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //echo'suite au clic sur le bouton sumit';
            $em=$this->getDoctrine()->getManager();
            $em->persist($reclam);
            $em->flush();
            return $this->redirectToRoute('home1_coord');

        }
        return $this->render('@PiDevGestionReclamationReclamation/Reclamation/ajout.html.twig',
            array(
                "Form"=>$form->createView()
            ));
    }
    public function afficheAdminAction(){
        $em= $this->getDoctrine()->getManager();
        $reclams = $em->getRepository('PiDevGestionReclamationReclamationBundle:Reclamation')
            ->findAll();

        return $this->render('@PiDevGestionReclamationReclamation/Reclamation/affiche.html.twig',
            array(
                "reclams"=>$reclams
            ));
    }
    public function affichemembreAction(Request $request)
    {
        $em = $this->getDoctrine();
        $reclams = $em->getRepository('PiDevGestionReclamationReclamationBundle:Reclamation')
            ->findAll();
        $feedback = new Feedback();

        $form = $this->createForm(FeedbackType::class, $feedback);
        $form->handleRequest($request);

        $moyenne =10;
        if ($form->isSubmitted() && $form->isValid()) {
            //echo'suite au clic sur le bouton sumit';
            $em = $this->getDoctrine()->getManager();
            $em->persist($feedback);
            $em->flush();
            return $this->redirectToRoute('affichemembrereclamation');
        }
            return $this->render('@PiDevGestionReclamationReclamation/Reclamation/affiche1.html.twig',
                array(
                    "reclams" => $reclams,
                    'feedback' =>$form->createView(),
                    'moyenne'=>$moyenne

                ));
        }

    public function deleteAction(Request $request){
        $id=$request->get('idreclam');
        $em=$this->getDoctrine()->getManager();
        $reclam=$em->getRepository('PiDevGestionReclamationReclamationBundle:Reclamation')
            ->find($id);
        $em->remove($reclam);
        $em->flush();
        return $this->redirectToRoute('affichereclamation');

    }

public  function updatereclamationAction(Request $request){
        $id=$request->get('idreclam');
        $em=$this->getDoctrine()->getManager();
        $reclam=$em->getRepository('PiDevGestionReclamationReclamationBundle:Reclamation')
            ->find($id);
        $form=$this->createForm(ReclamationType::class,$reclam);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($reclam);
            $em->flush();
            return $this->redirectToRoute('affichereclamation');
        }
    return $this->render('@PiDevGestionReclamationReclamation/Reclamation/update1.html.twig',
        array(
            "Form"=>$form->createView()
        ));
}
    public function recherchereclamationAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $recs = $em->getRepository('PiDevGestionReclamationReclamationBundle:Reclamation')
            ->findAll();
        if ($request->isMethod('POST')) {

            $titrereclam = $request->get('Titrereclam');


            $recs = $em
                ->getRepository('PiDevGestionReclamationReclamationBundle:Reclamation')
                ->findBy(array(
                    'titrereclam' => $titrereclam,

                ));

        }
        return $this->render('@PiDevGestionReclamationReclamation/Reclamation/recherche.html.twig',
            array(
                "recs" => $recs
            ));
    }
    public function recherchecategoriereclamationAction(Request $request)
    {

        $rec=new Reclamation();

        $em = $this->getDoctrine()->getManager();
        $recs = $em->getRepository('PiDevGestionReclamationReclamationBundle:Reclamation')
            ->findAll();
        $Form=$this->createForm(RechercheCategorieForm::class,$rec);
        $Form->handleRequest($request);
        if($Form->isValid()){
            $nomcategorie=$rec->getCategorie()->getNomcategorie();
            // var_dump($categorie);die;
            $recs=$em->getRepository('PiDevGestionReclamationReclamationBundle:Reclamation')
                ->findCategorieParametre($nomcategorie);

        }

        return $this->render('@PiDevGestionReclamationReclamation/Reclamation/recherchecategorie.html.twig',
            array(
                "Form" => $Form->createView(),
                "recs" => $recs
            ));
    }
    public function traiterreclamationAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();


        $id=$request->get('idreclam');


        $even=$em->getRepository('PiDevGestionReclamationReclamationBundle:Reclamation')
            ->find($id);
     $eta =$even->getEtatreclam();

        $even->setEtatreclam("traiter");
  $em= $this->getDoctrine()->getManager();

                $em->persist($even);

                $em->flush();
        return $this->redirectToRoute('affichereclamation');


    }
    public function recherchedatereclamationAction(Request $request)
    {

        $rec=new Reclamation();

        $em = $this->getDoctrine()->getManager();
        $recs = $em->getRepository('PiDevGestionReclamationReclamationBundle:Reclamation')
            ->findAll();
        $Form=$this->createForm(RechercheCategorieForm::class,$rec);
        $Form->handleRequest($request);
        if($Form->isValid()){
            $datereclam=$rec->getDatereclam();
            // var_dump($categorie);die;
            $recs=$em->getRepository('PiDevGestionReclamationReclamationBundle:Reclamation')
                ->finddateParametre($datereclam);

        }

        return $this->render('@PiDevGestionReclamationReclamation/Reclamation/recherchecategorie.html.twig',
            array(
                "Form" => $Form->createView(),
                "recs" => $recs
            ));
    }


    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $entities =  $em->getRepository('PiDevGestionReclamationReclamationBundle:Reclamation')->findByNom($requestString);
        if(!$entities) {
            $result['entities']['error'] = "there is no challenge with this name";
        } else {
            $result['entities'] = $this->getRealEntities($entities);
        }
        return new Response(json_encode($result));

    }



    public function getRealEntities($entities){
        foreach ($entities as $entity){
            $realEntities[$entity->getIdreclam()] =
                [$entity->getTitrereclam(),
                    $entity->getDescriptionreclam(),
                    $entity->getEtatreclam()];
        }
        return $realEntities;
    }
}