<?php
/**
 * Created by PhpStorm.
 * User: ihebm
 * Date: 17/02/2019
 * Time: 10:31
 */

namespace PiDev\GestionPublicite\PubliciteBundle\Controller;


use PiDev\GestionPublicite\PubliciteBundle\Entity\Offre;
use PiDev\GestionPublicite\PubliciteBundle\Form\OffreType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OffreController extends Controller
{
    public function  ajoutoffreAction(Request $request){
        $Offre=new Offre();
        $form=$this->createForm(OffreType::class,$Offre);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //echo'suite au clic sur le bouton sumit';
            $em=$this->getDoctrine()->getManager();
            $em->persist($Offre);
            $em->flush();
            return $this->redirectToRoute('afficheoffre');

        }
        return $this->render('@PiDevGestionPublicitePublicite/Offre/ajout.html.twig',
            array(
                "Form"=>$form->createView()
            ));
    }
    public function afficheoffreAction(){
        $em= $this->getDoctrine()->getManager();
        $offres = $em->getRepository('PiDevGestionPublicitePubliciteBundle:Offre')
            ->findAll();

        return $this->render('@PiDevGestionPublicitePublicite/Offre/affiche.html.twig',
            array(
                "offres"=>$offres
            ));
    }
    public function deleteoffreAction(Request $request){
        $id=$request->get('idoffre');
        $em=$this->getDoctrine()->getManager();
        $offre=$em->getRepository('PiDevGestionPublicitePubliciteBundle:Offre')
            ->find($id);
        $em->remove($offre);
        $em->flush();
        return $this->redirectToRoute('afficheoffre');

    }
    public function updateoffreAction(Request $request){
        $id=$request->get('idoffre');
        $em=$this->getDoctrine()->getManager();
        $Offre=$em->getRepository('PiDevGestionPublicitePubliciteBundle:Offre')
            ->find($id);
        $form=$this->createForm(OffreType::class,$Offre);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em->persist($Offre);
            $em->flush();
            return $this->redirectToRoute('afficheoffre');
        }
        return $this->render('@PiDevGestionPublicitePublicite/Offre/update.html.twig',
            array(
                "Form"=>$form->createView()
            ));
    }
    public function afficheoffre1Action(){
        $em= $this->getDoctrine()->getManager();
        $offres = $em->getRepository('PiDevGestionPublicitePubliciteBundle:Offre')
            ->findAll();

        return $this->render('@PiDevGestionPublicitePublicite/Offre/affiche1.html.twig',
            array(
                "offres"=>$offres
            ));
    }
}