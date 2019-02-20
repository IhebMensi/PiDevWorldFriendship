<?php
/**
 * Created by PhpStorm.
 * User: Marwa
 * Date: 15/02/2019
 * Time: 09:30
 */

namespace PiDev\GestionEvenement\EvenementBundle\Controller;


use PiDev\GestionEvenement\EvenementBundle\Entity\TypeEvenement;
use PiDev\GestionEvenement\EvenementBundle\Form\EvenementType;
use PiDev\GestionEvenement\EvenementBundle\Form\TypeEvenementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TypeEvenementController extends Controller
{

    public function AjouterTypeAction(Request $request)
    {
        $Event = new TypeEvenement();
     $form =$this->createForm(TypeEvenementType::class,$Event);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            // echo 'suit au clic ';
            $em = $this->getDoctrine()->getManager();
            $em->persist($Event);
            $em->flush();
          return  $this->redirectToRoute('pi_dev_gestion_evenement_AfficherType');
        }
        return $this->render( '@PiDevGestionEvenementEvenement/Event/ajouterType.html.twig',
            array(
                "Form"=>$form->createView()
            ));
    }

    public function AfficherTypeEventAction()
    {
        $em= $this->getDoctrine()->getManager();
        $event=$em->getRepository("PiDevGestionEvenementEvenementBundle:TypeEvenement")
            ->findAll();
        return $this->render('@PiDevGestionEvenementEvenement/Event/afficherType.html.twig',
            array("events"=>$event));
    }

    public function supprimerEventTypeAction(Request $request){
        $id=$request->get('idtype');
        $em=$this->getDoctrine()->getManager();
        $event=$em->getRepository('PiDevGestionEvenementEvenementBundle:TypeEvenement')
            ->find($id);
        $em->remove($event);
        $em->flush();
        return $this->redirectToRoute('pi_dev_gestion_evenement_AfficherType');

    }



}