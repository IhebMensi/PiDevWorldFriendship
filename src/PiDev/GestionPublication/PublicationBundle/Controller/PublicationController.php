<?php
/**
 * Created by PhpStorm.
 * User: Marwa
 * Date: 25/02/2019
 * Time: 14:42
 */

namespace PiDev\GestionPublication\PublicationBundle\Controller;


use PiDev\GestionEvenement\EvenementBundle\Entity\ReactionEvenement;
use PiDev\GestionPublication\PublicationBundle\Entity\Publication;
use PiDev\GestionPublication\PublicationBundle\Entity\ReactionPub;
use PiDev\GestionPublication\PublicationBundle\Form\PublicationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PublicationController extends Controller
{
    public function listPublicationAction(){
        $em=$this->getDoctrine()->getManager();
        $publication= $em->getRepository('PiDevGestionPublicationPublicationBundle:Publication')->findAll();


        return $this->render('@PiDevGestionPublicationPublication/Publication/listPublication.html.twig',
            array(
                "publication"=>$publication
            ));

    }

    public function signalerPublicationAction(Request $request){

        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $pub = $em->getRepository("PiDevGestionPublicationPublicationBundle:Publication")->find($id);

        $old_nb = $pub->getNbrsignalisation();

        $new_nb = $old_nb + 1;
        $pub->setNbrsignalisation($new_nb);
        $em->persist($pub);
        $em->flush();

        if ($pub->getNbrsignalisation()>=5) {
            $em->remove($pub);
            $em->flush();
        }



        return $this->redirectToRoute('pi_dev');

    }
    public function AjouterAction(Request $request)
    {

        $user = $this->getUser();
        $datej = new \DateTime('now');
        $Pub = new Publication();
        $Pub->setUser($user);
        $em = $this->getDoctrine()->getManager();
        $pub = $em->getRepository("PiDevGestionPublicationPublicationBundle:Publication")
            ->findAll();

        $form = $this->createForm(PublicationType::class, $Pub);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $Pub->setDatepublication($datej);
            // echo 'suit au clic ';
            $em = $this->getDoctrine()->getManager();
            $Pub->uploadProfilePicture();
            $em->persist($Pub);
            $em->flush();

        }

        return $this->render('@PiDevGestionPublicationPublication/Pub/ajoute.html.twig',
            array(
                "Form" => $form->createView(),"publication"=>$pub
            ));

    }


    public function supprimerPubAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('PiDevGestionPublicationPublicationBundle:Publication')
            ->find($id);
        $em->remove($event);
        $em->flush();
        return $this->redirectToRoute('pi_dev');

    }

    public function LikeAction(Request $request)

    {

        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $pub = $em->getRepository("PiDevGestionPublicationPublicationBundle:Publication")->find($id);
        $idu = $this->getUser();

        $user = $em->getRepository("PiDevGestionUserFosBundle:User")->find($idu);
        $like = $em->getRepository("PiDevGestionPublicationPublicationBundle:ReactionPub")->findBy(["Pub" => $pub, "user" => $user]);


        if ($like != null) {
            //remove reaction
            $em->remove($like[0]);
            $em->flush();
        }


        $like = new ReactionPub();
        $like->setUser($user);
        $like->setReaction('like');
        $like->setPub($pub);
        $em->persist($like);
        $em->flush();

        $old_nb_like = $pub->getNbrlike();

        $new_nb_like = $old_nb_like + 1;
        $pub->setNbrlike($new_nb_like);
        $em->persist($pub);
        $em->flush();


        return $this->redirectToRoute('pi_dev');


    }

    public function DislikeAction(Request $request)
    {

        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $pub = $em->getRepository("PiDevGestionPublicationPublicationBundle:Publication")->find($id);
        $idu = $this->getUser();

        $user = $em->getRepository("PiDevGestionUserFosBundle:User")->find($idu);
        $like = $em->getRepository("PiDevGestionPublicationPublicationBundle:ReactionPub")->findBy(["Pub" => $pub, "user" => $user]);


        if ($like != null) {
            $em->remove($like[0]);
            $em->flush();



        }
        $like = new ReactionPub();
        $like->setUser($user);
        $like->setReaction('Dislike');
        $like->setPub($pub);
        $em->persist($like);
        $em->flush();



        $old_nb_like = $pub->getNbrdislike();

        $new_nb_like = $old_nb_like + 1;
        $pub->setNbrdislike($new_nb_like);
        $em->persist($pub);
        $em->flush();


        return $this->redirectToRoute('pi_dev');


    }


}