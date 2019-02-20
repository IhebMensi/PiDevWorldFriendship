<?php
/**
 * Created by PhpStorm.
 * User: ihebm
 * Date: 09/02/2019
 * Time: 18:09
 */

namespace PiDev\GestionReclamation\ReclamationBundle\Controller;


use PiDev\GestionReclamation\ReclamationBundle\Entity\Reclamation;
use PiDev\GestionReclamation\ReclamationBundle\Form\ReclamationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



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
            return $this->redirectToRoute('affichereclamation');

        }
        return $this->render('@PiDevGestionReclamationReclamation/Reclamation/ajout.html.twig',
            array(
                "Form"=>$form->createView()
            ));
    }
    public function afficheAction(){
        $em= $this->getDoctrine()->getManager();
        $reclams = $em->getRepository('PiDevGestionReclamationReclamationBundle:Reclamation')
            ->findAll();

        return $this->render('@PiDevGestionReclamationReclamation/Reclamation/affiche.html.twig',
            array(
                "reclams"=>$reclams
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
    public function updateAction(Request $request){
        $id=$request->get('idreclam');
        $em=$this->getDoctrine()->getManager();
        $reclam=$em->getRepository('PiDevGestionReclamationReclamationBundle:Reclamation')
            ->find($id);
        $form=$this->createForm(ReclamationType::class,$reclam);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em->persist($reclam);
            $em->flush();
            return $this->redirectToRoute('affichereclamation');
        }
        return $this->render('@PiDevGestionReclamationReclamation/Reclamation/update.html.twig',
            array(
                "Form"=>$form->createView()
            ));
    }

}