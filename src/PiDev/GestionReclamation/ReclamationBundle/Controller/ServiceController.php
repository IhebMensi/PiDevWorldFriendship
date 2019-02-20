<?php
/**
 * Created by PhpStorm.
 * User: ihebm
 * Date: 11/02/2019
 * Time: 13:27
 */

namespace PiDev\GestionReclamation\ReclamationBundle\Controller;


use PiDev\GestionReclamation\ReclamationBundle\Entity\Feedback;
use PiDev\GestionReclamation\ReclamationBundle\Entity\Service;
use PiDev\GestionReclamation\ReclamationBundle\Form\FeedbackType;
use PiDev\GestionReclamation\ReclamationBundle\Form\ServiceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ServiceController extends  Controller
{

    public function  ajoutAction(Request $request){
        $service=new Service();
        $form=$this->createForm(ServiceType::class,$service);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //echo'suite au clic sur le bouton sumit';
            $em=$this->getDoctrine()->getManager();
            $em->persist($service);
            $em->flush();
            return $this->redirectToRoute('afficheservice');

        }
        return $this->render('@PiDevGestionReclamationReclamation/Service/ajout.html.twig',
            array(
                "Form"=>$form->createView()
            ));
    }
    public function afficheAction(){
        $em= $this->getDoctrine()->getManager();
        $services = $em->getRepository('PiDevGestionReclamationReclamationBundle:Service')
            ->findAll();

        return $this->render('@PiDevGestionReclamationReclamation/Service/affiche.html.twig',
            array(
                "services"=>$services
            ));
    }
    public function deleteAction(Request $request){
        $id=$request->get('idservice');
        $em=$this->getDoctrine()->getManager();
        $service=$em->getRepository('PiDevGestionReclamationReclamationBundle:Service')
            ->find($id);
        $em->remove($service);
        $em->flush();
        return $this->redirectToRoute('afficheservice');

    }
    public function updateAction(Request $request){
        $id=$request->get('idservice');
        $em=$this->getDoctrine()->getManager();
        $service=$em->getRepository('PiDevGestionReclamationReclamationBundle:Service')
            ->find($id);
        $form=$this->createForm(ServiceType::class,$service);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em->persist($service);
            $em->flush();
            return $this->redirectToRoute('afficheservice');
        }
        return $this->render('@PiDevGestionReclamationReclamation/Service/update.html.twig',
            array(
                "Form"=>$form->createView()
            ));
    }
}