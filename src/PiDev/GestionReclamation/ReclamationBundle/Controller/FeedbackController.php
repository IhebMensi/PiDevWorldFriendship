<?php
/**
 * Created by PhpStorm.
 * User: ihebm
 * Date: 11/02/2019
 * Time: 13:53
 */

namespace PiDev\GestionReclamation\ReclamationBundle\Controller;


use PiDev\GestionReclamation\ReclamationBundle\Entity\Feedback;
use PiDev\GestionReclamation\ReclamationBundle\Form\FeedbackType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FeedbackController extends Controller
{
    public function  ajoutAction(Request $request){
        $user = $this->getUser();
        $feedback=new Feedback();
        $feedback->setUser($user);
        $feedback->setDatefeedback(new \DateTime('now'));
        $form=$this->createForm(FeedbackType::class,$feedback);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //echo'suite au clic sur le bouton sumit';
            $em=$this->getDoctrine()->getManager();
            $em->persist($feedback);
            $em->flush();
            return $this->redirectToRoute('affichefeedback');

        }
        return $this->render('@PiDevGestionReclamationReclamation/Feedback/ajout.html.twig',
            array(
                "Form"=>$form->createView()
            ));
    }
    public function afficheAction(){
        $em= $this->getDoctrine()->getManager();
        $feedbacks = $em->getRepository('PiDevGestionReclamationReclamationBundle:Feedback')
            ->findAll();

        return $this->render('@PiDevGestionReclamationReclamation/Feedback/affiche.html.twig',
            array(
                "feedbacks"=>$feedbacks
            ));
    }
    public function deleteAction(Request $request){
        $id=$request->get('idfeedback');
        $em=$this->getDoctrine()->getManager();
        $feedback=$em->getRepository('PiDevGestionReclamationReclamationBundle:Feedback')
            ->find($id);
        $em->remove($feedback);
        $em->flush();
        return $this->redirectToRoute('affichefeedback');

    }
    public function updateAction(Request $request){
        $id=$request->get('idfeedback');
        $em=$this->getDoctrine()->getManager();
        $service=$em->getRepository('PiDevGestionReclamationReclamationBundle:Feedback')
            ->find($id);
        $form=$this->createForm(FeedbackType::class,$service);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em->persist($service);
            $em->flush();
            return $this->redirectToRoute('afficheservice');
        }
        return $this->render('@PiDevGestionReclamationReclamation/Feedback/update.html.twig',
            array(
                "Form"=>$form->createView()
            ));
    }
}