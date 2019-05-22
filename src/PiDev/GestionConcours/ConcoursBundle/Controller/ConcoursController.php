<?php
/**
 * Created by PhpStorm.
 * User: dorra
 * Date: 19/02/2019
 * Time: 11:19
 */

namespace PiDev\GestionConcours\ConcoursBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PiDev\GestionConcours\ConcoursBundle\Entity\Concours;
use PiDev\GestionConcours\ConcoursBundle\Form\ConcoursType;


class ConcoursController extends Controller
{
    public function listConcoursAction(){
        $em=$this->getDoctrine()->getManager();
        $Concours= $em->getRepository('PiDevGestionConcoursConcoursBundle:Concours')->findAll();


        return $this->render('@PiDevGestionConcoursConcours/Concours/listConcours.html.twig',
            array(
                "Concours"=>$Concours
            ));

    }

    public function listConcoursBackAction(){
    $em=$this->getDoctrine()->getManager();
    $Concours= $em->getRepository('PiDevGestionConcoursConcoursBundle:Concours')->findAll();


    return $this->render('@PiDevGestionConcoursConcours/Concours/listConcoursBack.html.twig',
        array(
            "Concours"=>$Concours
        ));
    }

    public function addConcoursAction(Request $request){
        $Concours = new Concours();
        $form = $this->createForm(ConcoursType::class,$Concours);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid() ){
            $em = $this->getDoctrine()->getManager();
            $em->persist($Concours);
            $em->flush();
            return $this->redirectToRoute('listConcoursBack');
        }
        return $this->render('@PiDevGestionConcoursConcours/Concours/addConcours.html.twig',
            array(
                "Form"=> $form->createView()
            )
        );
    }
    public function rechercheencoursDQLAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $concours = $em->getRepository('PiDevGestionConcoursConcoursBundle:Concours')
            ->findDateDebut();

        return $this->render('PiDevGestionConcoursConcoursBundle:Concours:filtreConcours.html.twig',
            array(
                "concours" => $concours
            ));
    }

    public function modifConcoursAction(Request $request){
        $id=$request-> get('id');
        $em=$this->getDoctrine()->getManager();
        $Concours=$em->getRepository('PiDevGestionConcoursConcoursBundle:Concours')->find($id);
        $form = $this->createForm(ConcoursType::class,$Concours);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isSubmitted()){
            $em->persist($Concours);
            $em->flush();
            return $this->redirectToRoute('listConcoursBack');
        }
        return $this->render('@PiDevGestionConcoursConcours/Concours/modifConcours.html.twig',
            array(
                "Form"=> $form->createView()
            )
        );

    }
    public function suppConcoursAction(Request $request){
        $id=$request-> get('id');
        $em=$this->getDoctrine()->getManager();
        $Concours=$em->getRepository('PiDevGestionConcoursConcoursBundle:Concours')->find($id);
        $em->remove($Concours);
        $em->flush();
        return $this->redirectToRoute('listConcoursBack');
    }

}