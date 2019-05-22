<?php
/**
 * Created by PhpStorm.
 * User: ihebm
 * Date: 11/02/2019
 * Time: 13:53
 */

namespace PiDev\GestionReclamation\ReclamationBundle\Controller;


use PiDev\GestionReclamation\ReclamationBundle\Entity\Feedback;
use PiDev\GestionReclamation\ReclamationBundle\Entity\notesite;
use PiDev\GestionReclamation\ReclamationBundle\Form\FeedbackType;
use PiDev\GestionReclamation\ReclamationBundle\Form\notesiteType;
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
        $feedbacks = $em->getRepository('PiDevGestionReclamationReclamationBundle:notesite')
            ->findAll();
        $moyen=$em->getRepository('PiDevGestionReclamationReclamationBundle:notesite')
            ->calculmoyenne();
        return $this->render('@PiDevGestionReclamationReclamation/Feedback/affiche.html.twig',
            array(
                "feedbacks"=>$feedbacks,
                "moyen"=>$moyen
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

    public function ajoute1Action(Request $request){
        if($request->isMethod('POST')){
            $note = $request->get('note');
            $user = $this->getUser();
            $Note1 =new notesite();
            $Note1->setNote($note);
            $Note1->setUser($user);

            $em=$this->getDoctrine()->getManager();
            $em->persist($Note1);
            $em->flush();

return $this->redirectToRoute('ajoute2Action');
        }
        return $this->render('@PiDevGestionReclamationReclamation/Reclamation/affiche1.html.twig');
    }


    public function ajoute2Action(Request $request){
        $em= $this->getDoctrine()->getManager();

            $moyen=$em->getRepository('PiDevGestionReclamationReclamationBundle:notesite')
                ->calculmoyenne();


            $em->flush();



        return $this->render('@PiDevGestionReclamationReclamation/Reclamation/kk.html.twig',
            array(
                "moyen"=>$moyen
            ));
    }



    public function  ajoute3Action(Request $request){
        $user = $this->getUser();
        $notesite=new notesite();
        $notesite->setUser($user);

        $form=$this->createForm(notesiteType::class,$notesite);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //echo'suite au clic sur le bouton sumit';
            $em=$this->getDoctrine()->getManager();
            $em->persist($notesite);
            $em->flush();


        }
        return $this->render('@PiDevGestionReclamationReclamation/Feedback/ajout3.html.twig',
            array(
                "Form"=>$form->createView()
            ));
    }
}