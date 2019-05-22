<?php
/**
 * Created by PhpStorm.
 * User: Marwa
 * Date: 25/02/2019
 * Time: 10:05
 */

namespace PiDev\GestionEvenement\EvenementBundle\Controller;


use PiDev\GestionEvenement\EvenementBundle\Entity\Calendar;
use PiDev\GestionEvenement\EvenementBundle\Form\CalendarType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CalendarController extends Controller

{


    public function supprimerCalAction(Request $request)
    {
        $id = $request->get('idcal');
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('PiDevGestionEvenementEvenementBundle:Calendar')
            ->find($id);
        $em->remove($event);
        $em->flush();
        return $this->redirectToRoute('calendarpublicite2');

    }

    public function modifierCalAction(Request $request)
    {
        $id = $request->get('idcal');
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('PiDevGestionEvenementEvenementBundle:Calendar')
            ->find($id);
        $form = $this->createForm(CalendarType::class,$event);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute('calendarpublicite2');
        }
        return $this->render('@PiDevGestionEvenementEvenement/Calendar/modifier.html.twig',
            array(
                "Form" => $form->createView()
            ));
    }

    public function AjouterCalAction(Request $request)
    {
        $user = $this->getUser();
        $Event = new Calendar();
        $Event->setUser($user);


        $form = $this->createForm(CalendarType::class,$Event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // echo 'suit au clic ';
            $em = $this->getDoctrine()->getManager();

            $em->persist($Event);
            $em->flush();
            return $this->redirectToRoute('calendarpublicite2');

        }

        return $this->render('@PiDevGestionEvenementEvenement/Calendar/ajoutecal.html.twig',
            array(
                "Form" => $form->createView()
            ));

    }


    public function AFFCalAction($idcal)
    {



        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('PiDevGestionEvenementEvenementBundle:Calendar')
            ->findBycal($idcal);

        return $this->render('@PiDevGestionEvenementEvenement/Calendar/affcom.html.twig',
            array("events" => $event)
        );


    }

}