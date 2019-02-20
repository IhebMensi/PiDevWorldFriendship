<?php
/**
 * Created by PhpStorm.
 * User: Marwa
 * Date: 09/02/2019
 * Time: 11:32
 */

namespace PiDev\GestionEvenement\EvenementBundle\Controller;


use PiDev\GestionEvenement\EvenementBundle\Entity\CommentEvenement;
use PiDev\GestionEvenement\EvenementBundle\Entity\Evenement;
use PiDev\GestionEvenement\EvenementBundle\Entity\ParticipationEvenement;
use PiDev\GestionEvenement\EvenementBundle\Form\CommentForm;
use PiDev\GestionEvenement\EvenementBundle\Form\EvenementType;
use PiDev\GestionEvenement\EvenementBundle\Form\RechercheEventForm;
use PiDev\GestionPublicite\PubliciteBundle\Entity\Lieu;
use PiDev\GestionEvenement\EvenementBundle\Form\RecherchForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EvenementController extends Controller
{
    public function AjouterAction(Request $request)
    {   $user = $this->getUser();
        $Event = new Evenement();
        $Event ->setUser($user);


        $form =$this->createForm(EvenementType::class,$Event);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            // echo 'suit au clic ';
            $em = $this->getDoctrine()->getManager();
            $Event->uploadProfilePicture();
            $em->persist($Event);
            $em->flush();

        }

        return $this->render( '@PiDevGestionEvenementEvenement/Event/ajoute.html.twig',
            array(
                "Form"=>$form->createView()
            ));

    }


    public function recherchecontenuAction(Request $request)
    {  $event=new Evenement();

        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')
            ->findAll();
        $Form=$this->createForm(RechercheEventForm::class,$event);
        $Form->handleRequest($request);
        if($Form->isValid()){

            $nomevenement=$event->getNomevenement();
            $events=$em->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')
                ->findContenuParametre($nomevenement);
           // var_dump($events);die();
               }

        return $this->render('@PiDevGestionEvenementEvenement/Event/recherchenomevent.html.twig',
            array(
                "Form" => $Form->createView(),
                "events" => $events
            ));
    }

    public function ParticiperEventAction(Request $request)
    {   $datej=new \DateTime('now');
        $datej2=$datej->format('Y-m-d');
        $Events = new ParticipationEvenement();
        $em=$this->getDoctrine()->getManager();
       $user=$this->getUser();

        $id=$request->get('idevenement');


        $even=$em->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')
            ->find($id);

         $datedb =$even->getDatedebut();
        $nbrp =$even->getNbrparticipants();
        $nbrt =$even->getNbrplacestotal();
         $datedb1 =$datedb->format('Y-m-d');

        if ($datedb1 > $datej2){
        if($nbrt > $nbrp) {
            $Events ->setUser($user);
            $Events->setEven($even);


            $old_nb = $even->getNbrparticipants();
            $new_nb = $old_nb +1;
            $even->setNbrparticipants($new_nb);

            $em= $this->getDoctrine()->getManager();

            $em->persist($even);
            $em->persist($Events);
            $em->flush();
            return $this->render('@PiDevGestionEvenementEvenement/Event/aficher1.html.twig',
                array("events"=>$even));

         }
        else { return $this->render('@PiDevGestionEvenementEvenement/Event/non.html.twig');

        }}
        else { return $this->render('@PiDevGestionEvenementEvenement/Event/non.html.twig');

           }
    }


    public function AnnulerEventAction(Request $request)
    {

        $id=$request->get('idevenement');
        $em=$this->getDoctrine()->getManager();
        $pr=$em->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')
            ->find($id);

  /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $marwa=$this->getUser();
        $user=$em->getRepository("PiDevGestionUserFosBundle:User")->find($marwa);
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $event=$em->getRepository('PiDevGestionEvenementEvenementBundle:ParticipationEvenement')
            ->findBy(["even"=>$pr,"user"=>$user]);


        if($event != null) {
            //remove reaction
            $em= $this->getDoctrine()->getManager();
            $em->remove($event[0]);
            $em->flush();
            $old_nb = $pr->getNbrparticipants();
            $new_nb = $old_nb -1;
            $pr->setNbrparticipants($new_nb);

            $em= $this->getDoctrine()->getManager();

            $em->flush();
            return $this->render('@PiDevGestionEvenementEvenement/Event/aficherann.html.twig'
            );
        }
        return $this->render('@PiDevGestionEvenementEvenement/Event/non.html.twig'
            );
    }





    public function AfficherEventAction()
    {
        $em= $this->getDoctrine()->getManager();
        $event=$em->getRepository("PiDevGestionEvenementEvenementBundle:Evenement")
            ->findAll();
        return $this->render('@PiDevGestionEvenementEvenement/Event/afficher.html.twig',
            array("events"=>$event));

    }

    public function AfficherEventparticiperAction()
    {
        $marwa = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("PiDevGestionEvenementEvenementBundle:ParticipationEvenement")
            ->findByUser($marwa);


            return $this->render('@PiDevGestionEvenementEvenement/Event/affeventparticiper.html.twig',
                array("events" => $event));


    }

    public function AfficherEventrealiserAction()
    {
        $marwa = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("PiDevGestionEvenementEvenementBundle:Evenement")
            ->findByUser($marwa);


        return $this->render('@PiDevGestionEvenementEvenement/Event/affevenrealiser.html.twig',
            array("events" => $event));


    }
    public function AfficherEvent1Action($idevenement){
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')
            ->findByevent($idevenement);
            $com= $em->getRepository('PiDevGestionEvenementEvenementBundle:CommentEvenement')
                ->findByevent($idevenement);



        return $this->render('@PiDevGestionEvenementEvenement/Event/aff.html.twig',
            array("events"=>$event , "coms"=>$com)
            );
    }


    public function supprimerEventAction(Request $request){
        $id=$request->get('idevenement');
        $em=$this->getDoctrine()->getManager();
        $event=$em->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')
            ->find($id);
        $em->remove($event);
        $em->flush();
        return $this->redirectToRoute('pi_dev_gestion_evenement_AfficherEventrealiser');

    }
    public function modifierEventAction(Request $request){
        $id=$request->get('idevenement');
        $em=$this->getDoctrine()->getManager();
        $event=$em->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')
            ->find($id);
        $form=$this->createForm(EvenementType::class,$event);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute('pi_dev_gestion_evenement_AfficherEventrealiser');
        }
        return $this->render('@PiDevGestionEvenementEvenement/Event/modifier.html.twig',
            array(
                "Form"=>$form->createView()
            ));
    }


    public function AjouterCommentAction(Request $request)

    {    $Comm = new CommentEvenement();


        $em=$this->getDoctrine()->getManager();
        $user=$this->getUser();

        $id=$request->get('idevenement');
        $even=$em->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')
            ->find($id);
        $form =$this->createForm(CommentForm::class,$Comm);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em= $this->getDoctrine()->getManager();



               $Comm ->setUser($user);
                $Comm->setEvent($even);
                $em->persist($Comm);
                $em->flush();

        }
        return $this->render('@PiDevGestionEvenementEvenement/Event/afichercom.html.twig',
            array(
                "events"=>$even ,
                "Form"=>$form->createView()

            )

        );

 }

    public function suppCommentAction(Request $request){
        $id=$request->get('idComment');
        $em=$this->getDoctrine()->getManager();
        $event=$em->getRepository('PiDevGestionEvenementEvenementBundle:CommentEvenement')
            ->find($id);
        $em->remove($event);
        $em->flush();
        return $this->redirectToRoute('pi_dev_gestion_evenement_Afficher');

    }
    public function modifCommentAction(Request $request){
        $id=$request->get('idComment');
        $em=$this->getDoctrine()->getManager();
        $event=$em->getRepository('PiDevGestionEvenementEvenementBundle:CommentEvenement')
            ->find($id);
        $form=$this->createForm(CommentForm::class,$event);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute('pi_dev_gestion_evenement_Afficher');
        }
        return $this->render('@PiDevGestionEvenementEvenement/Event/modifiercom.html.twig',
            array(
                "Form"=>$form->createView()
            ));
    }


}