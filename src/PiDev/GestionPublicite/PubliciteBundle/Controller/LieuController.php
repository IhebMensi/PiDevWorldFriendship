<?php
/**
 * Created by PhpStorm.
 * User: ihebm
 * Date: 09/02/2019
 * Time: 15:16
 */

namespace PiDev\GestionPublicite\PubliciteBundle\Controller;


use PiDev\GestionPublicite\PubliciteBundle\Entity\Lieu;
use PiDev\GestionPublicite\PubliciteBundle\Form\LieuType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LieuController extends Controller
{

    public function  ajoutAction(Request $request){
        $Lieu=new Lieu();
        $form=$this->createForm(LieuType::class,$Lieu);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //echo'suite au clic sur le bouton sumit';
            $em=$this->getDoctrine()->getManager();
            $em->persist($Lieu);
            $em->flush();
            return $this->redirectToRoute('afficheLieu');

        }
        return $this->render('@PiDevGestionPublicitePublicite/Lieu/ajout.html.twig',
            array(
                "Form"=>$form->createView()
            ));
    }
    public function afficheAction(){
        $em= $this->getDoctrine()->getManager();
        $lieux = $em->getRepository('PiDevGestionPublicitePubliciteBundle:Lieu')
            ->findAll();

        return $this->render('@PiDevGestionPublicitePublicite/Lieu/affiche.html.twig',
            array(
                "lieux"=>$lieux
            ));
    }
    public function deleteAction(Request $request){
        $id=$request->get('idlieu');
        $em=$this->getDoctrine()->getManager();
        $lieu=$em->getRepository('PiDevGestionPublicitePubliciteBundle:Lieu')
            ->find($id);
        $em->remove($lieu);
        $em->flush();
        return $this->redirectToRoute('affichelieu');

    }
    public function updatelieuAction(Request $request){
        $id=$request->get('idlieu');
        $em=$this->getDoctrine()->getManager();
        $Lieu=$em->getRepository('PiDevGestionPublicitePubliciteBundle:Lieu')
            ->find($id);
        $form=$this->createForm(LieuType::class,$Lieu);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em->persist($Lieu);
            $em->flush();
            return $this->redirectToRoute('affichelieu');
        }
        return $this->render('@PiDevGestionPublicitePublicite/Lieu/update.html.twig',
            array(
                "Form"=>$form->createView()
            ));
    }
}