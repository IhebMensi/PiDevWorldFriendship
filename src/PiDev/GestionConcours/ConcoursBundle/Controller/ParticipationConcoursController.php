<?php
/**
 * Created by PhpStorm.
 * User: dorra
 * Date: 25/02/2019
 * Time: 16:38
 */

namespace PiDev\GestionConcours\ConcoursBundle\Controller;


use PiDev\GestionConcours\ConcoursBundle\Entity\ParticipationConcours;
use PiDev\GestionConcours\ConcoursBundle\Form\ParticipationConcoursType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PiDev\GestionConcours\ConcoursBundle\Entity\Concours;
use Symfony\Component\HttpFoundation\Request;

class ParticipationConcoursController extends Controller
{
    public function participerConcoursAction(Request $request){
        $id=$request-> get('id');
        $em = $this->getDoctrine()->getManager();
        $Concours=$em->getRepository('PiDevGestionConcoursConcoursBundle:Concours')->find($id);
        $participation = new ParticipationConcours();
        $participation->setConcours($Concours);
        $participation->setUserid($this->getUser());
        $form = $this->createForm(ParticipationConcoursType::class,$participation);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid() ){
            $em = $this->getDoctrine()->getManager();
            $em->persist($participation);
            $em->flush();
            return $this->redirectToRoute('listConcours');
        }
        return $this->render('@PiDevGestionConcoursConcours/Concours/participer.html.twig',
            array(
                "Form"=> $form->createView()
            )
        );
    }

}