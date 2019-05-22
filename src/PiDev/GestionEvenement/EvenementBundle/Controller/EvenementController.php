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
use PiDev\GestionEvenement\EvenementBundle\Entity\ReactionEvenement;
use PiDev\GestionEvenement\EvenementBundle\Entity\Signal;
use PiDev\GestionEvenement\EvenementBundle\Form\CommentForm;
use PiDev\GestionEvenement\EvenementBundle\Form\EvenementType;
use PiDev\GestionEvenement\EvenementBundle\Form\RechercheEventCategorieForm;
use PiDev\GestionEvenement\EvenementBundle\Form\RechercheEventForm;
use PiDev\GestionEvenement\EvenementBundle\Form\RechercheEventLieuForm;
use PiDev\GestionPublicite\PubliciteBundle\Entity\Lieu;
use PiDev\GestionEvenement\EvenementBundle\Form\RecherchForm;
use PiDev\GestionUser\FosBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;

class EvenementController extends Controller
{
    public function findevemobAction($id)
    {
        $tasks = $this->getDoctrine()->getManager()
            ->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')
            ->find($id);

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }
    public function allmoAction()
    {

        $tasks = $this->getDoctrine()->getManager()
            ->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }

    public function neweAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('PiDevGestionUserFosBundle:User')->find(9);
        $type = $em->getRepository('PiDevGestionEvenementEvenementBundle:TypeEvenement')->find($request->get('idT'));

        $eve = new Evenement();
        $eve->setNomevenement($request->get('nomevenement'));
        $eve->setDescriptionevenement($request->get('descriptionevenement'));
        $eve->setDatedebut(new \DateTime($request->get('datedebut')));
        $eve->setDatefin(new \DateTime($request->get('datefin')));
        $eve->setPays($request->get('pays'));
        $eve->setRegion($request->get('region'));
        $eve->setTypeevenement($type);

        $eve->setNbrplacestotal($request->get('nbrplacestotal'));
        $eve->setUser($user);


        $eve->setNomimage($request->get('nomimage'));
        $em->persist($eve);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($eve);
        return new JsonResponse($formatted);


    }
    public function Stat27Action()
    {
        {
            $em = $this->getDoctrine()->getManager();
            $produits = $em->getRepository("PiDevGestionEvenementEvenementBundle:Evenement")->findAll();
            //  $em = $this->container->get('doctrine')->getEntityManager();
            //$produits = $em->getRepository("PiDevGestionEvenementEvenementBundle:Evenement")->findAll();
            $tab = array();
            $categories = array();

            $nbF = 0;
            $nbH = 0;
            $nbE = 0;
            $nbA = 0;
            foreach ($produits as $pd) {
                if ($pd->getTypeevenement()->getIdtype() == 27) {
                    $nbF = $nbF + 1;

                    array_push($categories, 27);
                }
            }


            $serializer = new  Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize($nbF);
            return new JsonResponse($formatted);

        }
    }
    public function Stat6Action()
    {
        {
            $em = $this->getDoctrine()->getManager();
            $produits = $em->getRepository("PiDevGestionEvenementEvenementBundle:Evenement")->findAll();
            //  $em = $this->container->get('doctrine')->getEntityManager();
            //$produits = $em->getRepository("PiDevGestionEvenementEvenementBundle:Evenement")->findAll();
            $tab = array();
            $categories = array();

            $nbF = 0;
            $nbH = 0;
            $nbE = 0;
            $nbA = 0;
            foreach ($produits as $pd) {
                if ($pd->gettypeevenement()->getidtype() == 6) {
                    $nbF = $nbF + 1;

                    array_push($categories, 27);
                }
            }


            $serializer = new  Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize($nbF);
            return new JsonResponse($formatted);

        }
    }
    public function Stat13Action()
    {
        {
            $em = $this->getDoctrine()->getManager();
            $produits = $em->getRepository("PiDevGestionEvenementEvenementBundle:Evenement")->findAll();
            //  $em = $this->container->get('doctrine')->getEntityManager();
            //$produits = $em->getRepository("PiDevGestionEvenementEvenementBundle:Evenement")->findAll();
            $tab = array();
            $categories = array();

            $nbF = 0;
            $nbH = 0;
            $nbE = 0;
            $nbA = 0;
            foreach ($produits as $pd) {
                if ($pd->gettypeevenement()->getidtype() == 13) {
                    $nbF = $nbF + 1;

                    array_push($categories, 27);
                }
            }


            $serializer = new  Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize($nbF);
            return new JsonResponse($formatted);

        }
    }
    public function Stat1Action()
    {
        {
            $em = $this->getDoctrine()->getManager();
            $produits = $em->getRepository("PiDevGestionEvenementEvenementBundle:Evenement")->findAll();
            //  $em = $this->container->get('doctrine')->getEntityManager();
            //$produits = $em->getRepository("PiDevGestionEvenementEvenementBundle:Evenement")->findAll();
            $tab = array();
            $categories = array();

            $nbF = 0;
            $nbH = 0;
            $nbE = 0;
            $nbA = 0;
            foreach ($produits as $pd) {
                if ($pd->gettypeevenement()->getidtype() == 1) {
                    $nbF = $nbF + 1;

                    array_push($categories, 27);
                }
            }


            $serializer = new  Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize($nbF);
            return new JsonResponse($formatted);

        }
    }


    public function chercherEveAction($nomevenement)
    {
        $em = $this->getDoctrine()->getManager();
        $Evenement = $em->getRepository("PiDevGestionEvenementEvenementBundle:Evenement")->findContenuParametre($nomevenement);
        $serializer = new Serializer([new ObjectNormalizer()]);

        $formatted = $serializer->normalize($Evenement);
        return new JsonResponse($formatted);
    }
    public function updateEveAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $pub=$em->getRepository("PiDevGestionEvenementEvenementBundle:Evenement")->find($id);
        $pub->setNomevenement($request->get('nomevenement'));
        $pub->setDescriptionevenement($request->get('descriptionevenement'));
        $em->persist($pub);
        $em->flush();
        return new JsonResponse("success");

    }
    public function supprimerEveAction($id)
    {   $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("PiDevGestionEvenementEvenementBundle:Evenement")->find($id);
        $em->remove($event);
        $em->flush();
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($event);
        return new JsonResponse($formatted);
    }

    public function allparAction($id,$idu)
    {
        $em = $this->getDoctrine()->getManager();
        $em1 = $this->getDoctrine()->getManager();
        $em2 = $this->getDoctrine()->getManager();
        //  $tasks = $this->getDoctrine()->getManager()
        //    ->getRepository("PiDevGestionEvenementEvenementBundle:ParticipationEvenement")
        //->findAll();
        $even = $em->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')->find($id);
        $user = $em1->getRepository('PiDevGestionUserFosBundle:User')->find($idu);
        $like = $em2->getRepository("PiDevGestionEvenementEvenementBundle:ParticipationEvenement")->findBy(["even" => $even, "user" => $user]);
        if ($like != null) {
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize("oui");
            return new JsonResponse($formatted);}

        else { $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize("non");
            return new JsonResponse($formatted);}
    }
    public function ParticiperEventesAction($id,$idu)
    {
        $datej = new \DateTime('now');
        $datej2 = $datej->format('Y-m-d');
        $Events = new  ParticipationEvenement();
        $em = $this->getDoctrine()->getManager();
        $em1 = $this->getDoctrine()->getManager();
        $em2 = $this->getDoctrine()->getManager();

        //  $user = $this->getUser();

        //$id = $request->get('idevenement');


        $even = $em->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')->find($id);
        $user = $em1->getRepository('PiDevGestionUserFosBundle:User')->find($idu);
        $like = $em2->getRepository("PiDevGestionEvenementEvenementBundle:ParticipationEvenement")->findBy(["even" => $even, "user" => $user]);

        $datedb = $even->getDatedebut();
        $nbrp = $even->getNbrparticipants();
        $nbrt = $even->getNbrplacestotal();
        $datedb1 = $datedb->format('Y-m-d');
        if ($like != null){  $msg = "deja participer";
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize($msg);
            return new JsonResponse($formatted);}
        else {
            if ($datedb1 > $datej2) {
                if ($nbrt > $nbrp) {
                    $Events->setUser($user);
                    $Events->setEven($even);


                    $old_nb = $even->getNbrparticipants();
                    $new_nb = $old_nb + 1;
                    $even->setNbrparticipants($new_nb);

                    $em = $this->getDoctrine()->getManager();

                    $em->persist($even);
                    $em->persist($Events);
                    $em->flush();
                    $serializer = new Serializer([new ObjectNormalizer()]);
                    $formatted = $serializer->normalize("participer avec succes");
                    return new JsonResponse($formatted);

                } else {
                    $msg = "pas de nombre de place";
                    $serializer = new Serializer([new ObjectNormalizer()]);
                    $formatted = $serializer->normalize($msg);
                    return new JsonResponse($formatted);
                }
            } else {
                $msg = "déja commencer ";
                $serializer = new Serializer([new ObjectNormalizer()]);
                $formatted = $serializer->normalize($msg);
                return new JsonResponse($formatted);
            }

        }

    }
    public function AnnulerEventesAction($id,$idu)
    {

        //$id = $request->get('idevenement');
        $em = $this->getDoctrine()->getManager();
        $pr = $em->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')
            ->find($id);

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $marwa = $this->getUser();
        //  $user = $em->getRepository("PiDevGestionUserFosBundle:User")->find($marwa);
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $user = $em->getRepository('PiDevGestionUserFosBundle:User')->find($idu);

        $event = $em->getRepository('PiDevGestionEvenementEvenementBundle:ParticipationEvenement')
            ->findBy(["even" => $pr, "user" => $user]);


        if ($event != null) {
            //remove reaction
            $em = $this->getDoctrine()->getManager();
            $em->remove($event[0]);
            $em->flush();
            $old_nb = $pr->getNbrparticipants();
            $new_nb = $old_nb - 1;
            $pr->setNbrparticipants($new_nb);

            $em = $this->getDoctrine()->getManager();

            $em->flush();
            $msg = "Annuler avec succer ";
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize($msg);
            return new JsonResponse($formatted);

        }
        $msg = "n'est pas pariciper ";
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($msg);
        return new JsonResponse($formatted);

    }
    public function AfficherEvent5Action($id){
        $em = $this->getDoctrine()->getManager();
        // $event = $em->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')
        //   ->findByevent($id);
        $com = $em->getRepository('PiDevGestionEvenementEvenementBundle:CommentEvenement')
            ->findByevent($id);
        // $form = $this->createForm(CommentForm::class, $Comm);
        //  $form->handleRequest($request);
        //  $id = $request->get('idevenement');
        // $even = $em->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')
        //   ->find($id);


        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($com);
        return new JsonResponse($formatted);


    }
    public function likeEventesAction($id,$idu)
    {

        //  $id = $request->get('idevenement');
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("PiDevGestionEvenementEvenementBundle:Evenement")->find($id);
        // $idu = $this->getUser();

        $user = $em->getRepository("PiDevGestionUserFosBundle:User")->find($idu);
        $like = $em->getRepository("PiDevGestionEvenementEvenementBundle:ReactionEvenement")->findBy(["event" => $event, "user" => $user]);

        $k = "like";
        $k1 = "dislike";
        $li = $em->getRepository("PiDevGestionEvenementEvenementBundle:ReactionEvenement")->findreParametre($user, $event, $k);
        $li2 = $em->getRepository("PiDevGestionEvenementEvenementBundle:ReactionEvenement")->findreParametre($user, $event, $k1);
        if ($like != null) {
            //remove reaction
            //  $em->remove($like[0]);
            $em->flush();
            if ($li != null) {
                $serializer = new Serializer([new ObjectNormalizer()]);
                $formatted = $serializer->normalize("deja aimer");
                return new JsonResponse($formatted);


            }
            if ($li2 != null) {
                $em->remove($like[0]);
                $em->flush();
                $old_nb_like1 = $event->getNbrdislikes();

                $new_nb_like1 = $old_nb_like1 - 1;
                $event->setNbrdislikes($new_nb_like1);
                $em->persist($event);
                $em->flush();
                $like = new ReactionEvenement();
                $like->setUser($user);
                $like->setEvent($event);
                $like->setReaction('like');
                $em->persist($like);
                $em->flush();

                $old_nb_like = $event->getNbrlikes();

                $new_nb_like = $old_nb_like + 1;
                $event->setNbrlikes($new_nb_like);
                $em->persist($event);
                $em->flush();
                $serializer = new Serializer([new ObjectNormalizer()]);
                $formatted = $serializer->normalize("kount dislike walit like");
                return new JsonResponse($formatted);

            }

        }

        else {
            $like = new ReactionEvenement();
            $like->setUser($user);
            $like->setEvent($event);
            $like->setReaction('like');
            $em->persist($like);
            $em->flush();

            $old_nb_like = $event->getNbrlikes();

            $new_nb_like = $old_nb_like + 1;
            $event->setNbrlikes($new_nb_like);
            $em->persist($event);
            $em->flush();
            $nb = $event->getNbrlikes();

            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize("like avec succes");
            return new JsonResponse($formatted);
        }

    }


    public function logine1Action($us,$mp){
        $em = $this->getDoctrine()->getManager();
        $user = new User();
        $user = $em->getRepository("PiDevGestionUserFosBundle:User")->findBy(["username"=>$us,"password"=>$mp]);
        //$k = $user.
        // $user=$this->getDoctrine()->getManager()->getRepository('@PiDevGestionUserFosBundle:User')->findBy(["username"=>$us,"password"=>$mp]);
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($user);
        return new JsonResponse($formatted);
    }

    public function finduseridAction($id){
        $em = $this->getDoctrine()->getManager();
        $user = new User();
        $user = $em->getRepository("PiDevGestionUserFosBundle:User")->findBy(["id"=>$id]);
        //$k = $user.
        // $user=$this->getDoctrine()->getManager()->getRepository('@PiDevGestionUserFosBundle:User')->findBy(["username"=>$us,"password"=>$mp]);
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($user);
        return new JsonResponse($formatted);
    }
    public function dislikeEventesAction($id,$idu)
    {
        // $id = $request->get('idevenement');
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("PiDevGestionEvenementEvenementBundle:Evenement")->find($id);
        // $idu = $this->getUser();
        $user = $em->getRepository("PiDevGestionUserFosBundle:User")->find($idu);
        $like = $em->getRepository("PiDevGestionEvenementEvenementBundle:ReactionEvenement")->findBy(["event" => $event, "user" => $user]);

        $k = "like";
        $k1 = "dislike";
        $li = $em->getRepository("PiDevGestionEvenementEvenementBundle:ReactionEvenement")->findreParametre($user, $event, $k);
        $li2 = $em->getRepository("PiDevGestionEvenementEvenementBundle:ReactionEvenement")->findreParametre($user, $event, $k1);
        if ($like != null) {

            if ($li != null) {

                $em->remove($like[0]);
                $em->flush();
                $like = new ReactionEvenement();

                $like->setUser($user);
                $like->setEvent($event);
                $like->setReaction('Dislike');
                $em->persist($like);
                $em->flush();
                $old_nb_like1 = $event->getNbrlikes();

                $new_nb_like1 = $old_nb_like1 - 1;
                $event->setNbrlikes($new_nb_like1);
                $old_nb_like = $event->getNbrdislikes();

                $new_nb_like = $old_nb_like + 1;
                $event->setNbrdislikes($new_nb_like);
                $em->persist($event);
                $em->flush();
                $serializer = new Serializer([new ObjectNormalizer()]);
                $formatted = $serializer->normalize("kount like wlit dislike");
                return new JsonResponse($formatted);

            }
            if ($li2 != null) {
                $serializer = new Serializer([new ObjectNormalizer()]);
                $formatted = $serializer->normalize("deja dislike");
                return new JsonResponse($formatted);

            }


        }
        else {
            $like = new ReactionEvenement();

            $like->setUser($user);
            $like->setEvent($event);
            $like->setReaction('Dislike');
            $em->persist($like);
            $em->flush();

            $old_nb_like = $event->getNbrdislikes();

            $new_nb_like = $old_nb_like + 1;
            $event->setNbrdislikes($new_nb_like);
            $em->persist($event);
            $em->flush();
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize("dislike avec succes");
            return new JsonResponse($formatted);}

    }

    public function meseveAction($idu)
    {    $em = $this->getDoctrine()->getManager();
        $marwa = $em->getRepository("PiDevGestionUserFosBundle:User")->find($idu);
        // $marwa = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("PiDevGestionEvenementEvenementBundle:Evenement")
            ->findByUser($marwa);

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($event);
        return new JsonResponse($formatted);}



    public function AjouterAction(Request $request)
    {
        $user = $this->getUser();
        $Event = new Evenement();
        $Event->setUser($user);


        $form = $this->createForm(EvenementType::class, $Event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $Event->uploadProfilePicture();
            $em = $this->getDoctrine()->getManager();

            $em->persist($Event);
            $em->flush();
            return $this->redirectToRoute('pi_dev_gestion_evenement_recherchelieu');


        }

        return $this->render('@PiDevGestionEvenementEvenement/Event/ajoute.html.twig',
            array(
                "Form" => $form->createView()
            ));

    }





    public function recherchecontenuAction(Request $request)
    {
        $event = new Evenement();

        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')
            ->findAll();
        $Form = $this->createForm(RechercheEventForm::class, $event);
        $Form->handleRequest($request);
        if ($Form->isValid()) {

            $nomevenement = $event->getNomevenement();
            $events = $em->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')
                ->findnomeveParametre($nomevenement);
            // var_dump($events);die();
        }

        return $this->render('@PiDevGestionEvenementEvenement/Event/recherchenomevent.html.twig',
            array(
                "Form" => $Form->createView(),
                "events" => $events
            ));
    }

    public function recherchelieuAction(Request $request)
    {
        $event = new Evenement();

        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')
            ->findAll();
        $Form = $this->createForm(RechercheEventLieuForm::class, $event);
        $Form->handleRequest($request);
        if ($Form->isValid()) {
            $nomcategorie = $event->getCategorie()->getNomcategorie();
            $pays = $event->getPays();
            $region = $event->getRegion();


            $events = $em->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')
                ->findLieuParametre($pays, $region, $nomcategorie);
            // var_dump($events);die();
        }

        return $this->render('@PiDevGestionEvenementEvenement/Event/recherchelieuevent.html.twig',
            array(
                "Form" => $Form->createView(),
                "events" => $events
            ));
    }

    public function recherchecategorieDQLAction(Request $request)
    {

        $event = new Evenement();

        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')
            ->findAll();
        $Form = $this->createForm(RechercheEventCategorieForm::class, $event);
        $Form->handleRequest($request);
        if ($Form->isValid()) {
            $nomcategorie = $event->getCategorie()->getNomcategorie();
            // var_dump($categorie);die;
            $events = $em->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')
                ->findCategorieParametre($nomcategorie);

        }

        return $this->render('@PiDevGestionEvenementEvenement/Event/recherchecategorieevent.html.twig',
            array(
                "Form" => $Form->createView(),
                "events" => $events
            ));
    }

    public function ParticiperEventAction(Request $request)
    {
        $datej = new \DateTime('now');
        $datej2 = $datej->format('Y-m-d');
        $Events = new ParticipationEvenement();
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $id = $request->get('idevenement');


        $even = $em->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')
            ->find($id);

        $datedb = $even->getDatedebut();
        $nbrp = $even->getNbrparticipants();
        $nbrt = $even->getNbrplacestotal();
        $datedb1 = $datedb->format('Y-m-d');

        if ($datedb1 > $datej2) {
            if ($nbrt > $nbrp) {
                $Events->setUser($user);
                $Events->setEven($even);


                $old_nb = $even->getNbrparticipants();
                $new_nb = $old_nb + 1;
                $even->setNbrparticipants($new_nb);

                $em = $this->getDoctrine()->getManager();

                $em->persist($even);
                $em->persist($Events);
                $em->flush();
                return $this->render('@PiDevGestionEvenementEvenement/Event/aficher1.html.twig',
                    array("events" => $even));

            } else {
                return $this->render('@PiDevGestionEvenementEvenement/Event/non.html.twig');

            }
        } else {
            return $this->render('@PiDevGestionEvenementEvenement/Event/non.html.twig');

        }
    }

    public function AnnulerEventAction(Request $request)
    {

        $id = $request->get('idevenement');
        $em = $this->getDoctrine()->getManager();
        $pr = $em->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')
            ->find($id);

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $marwa = $this->getUser();
        $user = $em->getRepository("PiDevGestionUserFosBundle:User")->find($marwa);
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $event = $em->getRepository('PiDevGestionEvenementEvenementBundle:ParticipationEvenement')
            ->findBy(["even" => $pr, "user" => $user]);


        if ($event != null) {
            //remove reaction
            $em = $this->getDoctrine()->getManager();
            $em->remove($event[0]);
            $em->flush();
            $old_nb = $pr->getNbrparticipants();
            $new_nb = $old_nb - 1;
            $pr->setNbrparticipants($new_nb);

            $em = $this->getDoctrine()->getManager();

            $em->flush();
            return $this->render('@PiDevGestionEvenementEvenement/Event/aficherann.html.twig'
            );
        }
        return $this->render('@PiDevGestionEvenementEvenement/Event/non.html.twig'
        );
    }

    public function AfficherEventAction()
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("PiDevGestionEvenementEvenementBundle:Evenement")
            ->findAll();
        return $this->render('@PiDevGestionEvenementEvenement/Event/afficher.html.twig',
            array("events" => $event));

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

    public function AfficherEvent1Action($idevenement, Request $request)
    {

        $Comm = new CommentEvenement();


        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')
            ->findByevent($idevenement);
        $com = $em->getRepository('PiDevGestionEvenementEvenementBundle:CommentEvenement')
            ->findByevent($idevenement);
        $form = $this->createForm(CommentForm::class, $Comm);
        $form->handleRequest($request);
        $id = $request->get('idevenement');
        $even = $em->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')
            ->find($id);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();


            $Comm->setUser($user);
            $Comm->setEvent($even);
            $em->persist($Comm);
            $em->flush();

        }


        return $this->render('@PiDevGestionEvenementEvenement/Event/aff.html.twig',
            array("events" => $event, "coms" => $com, "Form" => $form->createView())
        );


    }

    public function AfficherEvent2Action($idevenement)
{
    $em = $this->getDoctrine()->getManager();
    $event = $em->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')
        ->findByevent($idevenement);
    $com = $em->getRepository('PiDevGestionEvenementEvenementBundle:CommentEvenement')
        ->findByevent($idevenement);


    return $this->render('@PiDevGestionEvenementEvenement/Event/aff2.html.twig',
        array("events" => $event, "coms" => $com)
    );
}
    public function dashAction()
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')
            ->findAll();


        return $this->render('@PiDevGestionEvenementEvenement/Event/dash.html.twig',
            array("events" => $event)
        );
    }
    public function supprimerEventAction(Request $request)
    {
        $id = $request->get('idevenement');
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')
            ->find($id);
        $em->remove($event);
        $em->flush();
        return $this->redirectToRoute('pi_dev_gestion_evenement_AfficherEventrealiser');

    }
    public function supprimerEvent2Action(Request $request)
    {
        $id = $request->get('idevenement');
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')
            ->find($id);
        $em->remove($event);
        $em->flush();
        return $this->redirectToRoute('pi_dev_gestion_evenement_Afficherdash');

    }

    public function modifierEventAction(Request $request)
    {
        $id = $request->get('idevenement');
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')
            ->find($id);
        $form = $this->createForm(EvenementType::class, $event);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute('pi_dev_gestion_evenement_AfficherEventrealiser');
        }
        return $this->render('@PiDevGestionEvenementEvenement/Event/modifier.html.twig',
            array(
                "Form" => $form->createView()
            ));
    }

    public function AjouterCommentAction(Request $request)

    {
        $Comm = new CommentEvenement();


        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $id = $request->get('idevenement');
        $even = $em->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')
            ->find($id);
        $form = $this->createForm(CommentForm::class, $Comm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();


            $Comm->setUser($user);
            $Comm->setEvent($even);
            $em->persist($Comm);
            $em->flush();

        }
        return $this->render('@PiDevGestionEvenementEvenement/Event/afichercom.html.twig',
            array(
                "events" => $even,
                "Form" => $form->createView()

            )

        );

    }

    public function suppCommentAction(Request $request)
    {
        $id = $request->get('idComment');
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('PiDevGestionEvenementEvenementBundle:CommentEvenement')
            ->find($id);
        $em->remove($event);
        $em->flush();
        return $this->redirectToRoute('pi_dev_gestion_evenement_recherchelieu');

    }

    public function modifCommentAction(Request $request)
    {
        $id = $request->get('idComment');
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('PiDevGestionEvenementEvenementBundle:CommentEvenement')
            ->find($id);
        $form = $this->createForm(CommentForm::class, $event);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute('pi_dev_gestion_evenement_recherchelieu');
        }
        return $this->render('@PiDevGestionEvenementEvenement/Event/modifiercom.html.twig',
            array(
                "Form" => $form->createView()
            ));
    }


    public function LikeAction(Request $request)
    {

        $id = $request->get('idevenement');
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("PiDevGestionEvenementEvenementBundle:Evenement")->find($id);
        $idu = $this->getUser();

        $user = $em->getRepository("PiDevGestionUserFosBundle:User")->find($idu);
        $like = $em->getRepository("PiDevGestionEvenementEvenementBundle:ReactionEvenement")->findBy(["event" => $event, "user" => $user]);

        $k = "like";
        $k1 = "dislike";
        $li = $em->getRepository("PiDevGestionEvenementEvenementBundle:ReactionEvenement")->findreParametre($user, $event, $k);
        $li2 = $em->getRepository("PiDevGestionEvenementEvenementBundle:ReactionEvenement")->findreParametre($user, $event, $k1);
        if ($like != null) {
            //remove reaction
            $em->remove($like[0]);
            $em->flush();
            if ($li != null) {
                $old_nb_like = $event->getNbrlikes();

                $new_nb_like = $old_nb_like - 1;
                $event->setNbrlikes($new_nb_like);
                $em->persist($event);
                $em->flush();

            }
            if ($li2 != null) {
                $old_nb_like = $event->getNbrdislikes();

                $new_nb_like = $old_nb_like - 1;
                $event->setNbrdislikes($new_nb_like);
                $em->persist($event);
                $em->flush();

            }

        }


        $like = new ReactionEvenement();
        $like->setUser($user);
        $like->setEvent($event);
        $like->setReaction('like');
        $em->persist($like);
        $em->flush();

        $old_nb_like = $event->getNbrlikes();

        $new_nb_like = $old_nb_like + 1;
        $event->setNbrlikes($new_nb_like);
        $em->persist($event);
        $em->flush();
        $nb = $event->getNbrlikes();

        return $this->redirectToRoute('pi_dev_gestion_evenement_recherchelieu');


    }

    public function logineAction($us,$mp){
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository("PiDevGestionUserFosBundle:User")->findBy(["username"=>$us,"password"=>$mp]);
        if ($user != null) { $msg =1;}
        else {$msg =2;}
        // $user=$this->getDoctrine()->getManager()->getRepository('@PiDevGestionUserFosBundle:User')->findBy(["username"=>$us,"password"=>$mp]);
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($msg);
        return new JsonResponse($formatted);
    }


    public function signaleveAction(Request $request)
    {

        $id = $request->get('idevenement');
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("PiDevGestionEvenementEvenementBundle:Evenement")->find($id);
        $idu = $this->getUser();

        $user = $em->getRepository("PiDevGestionUserFosBundle:User")->find($idu);
        $signal = $em->getRepository("PiDevGestionEvenementEvenementBundle:Signal")->findBy(["even" => $event, "user" => $user]);

             if ($signal != null) {
            //remove reaction
            $em->remove($signal[0]);
                 $old_nb = $event->getNbsignal();

                 $new_nb = $old_nb - 1;
                 $event->setNbsignal($new_nb);
                 $em->persist($event);
                 $em->flush();



        }


        $signal = new Signal();
        $signal->setUser($user);
        $signal->setEven($event);

        $em->persist($signal);
        $em->flush();

        $old_nb = $event->getNbsignal();

        $new_nb = $old_nb + 1;
        $event->setNbsignal($new_nb);
        $em->persist($event);
        $em->flush();
        $nb = $event->getNbrlikes();

        return $this->redirectToRoute('pi_dev_gestion_evenement_recherchelieu');


    }

    public function DislikeeAction(Request $request)
    {
        $id = $request->get('idevenement');
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("PiDevGestionEvenementEvenementBundle:Evenement")->find($id);
        $idu = $this->getUser();
        $user = $em->getRepository("PiDevGestionUserFosBundle:User")->find($idu);
        $like = $em->getRepository("PiDevGestionEvenementEvenementBundle:ReactionEvenement")->findBy(["event" => $event, "user" => $user]);

        $k = "like";
        $k1 = "dislike";
        $li = $em->getRepository("PiDevGestionEvenementEvenementBundle:ReactionEvenement")->findreParametre($user, $event, $k);
        $li2 = $em->getRepository("PiDevGestionEvenementEvenementBundle:ReactionEvenement")->findreParametre($user, $event, $k1);
        if ($like != null) {
            $em->remove($like[0]);
            $em->flush();
            if ($li != null) {
                $old_nb_like = $event->getNbrlikes();

                $new_nb_like = $old_nb_like - 1;
                $event->setNbrlikes($new_nb_like);
                $em->persist($event);
                $em->flush();

            }
            if ($li2 != null) {
                $old_nb_like = $event->getNbrdislikes();

                $new_nb_like = $old_nb_like - 1;
                $event->setNbrdislikes($new_nb_like);
                $em->persist($event);
                $em->flush();

            }


        }
        $like = new ReactionEvenement();

        $like->setUser($user);
        $like->setEvent($event);
        $like->setReaction('Dislike');
        $em->persist($like);
        $em->flush();

        $old_nb_like = $event->getNbrdislikes();

        $new_nb_like = $old_nb_like + 1;
        $event->setNbrdislikes($new_nb_like);
        $em->persist($event);
        $em->flush();
        $nb = $event->getNbrdislikes();

        return $this->redirectToRoute('pi_dev_gestion_evenement_recherchelieu');


    }

    public function TestAction()
    {
        return $this->render('@PiDevGestionEvenementEvenement/Event/test.html.twig');

    }


    public function calendarAction()

    {
        $marwa = $this->getUser();


        $em = $this->getDoctrine()->getManager();
        $pub = $em->getRepository('PiDevGestionEvenementEvenementBundle:Evenement')
            ->findByUser($marwa);
        $cal = $em->getRepository('PiDevGestionEvenementEvenementBundle:Calendar')
            ->findByUser($marwa);

        return $this->render('@PiDevGestionEvenementEvenement/Event/calendar.html.twig', array(
            "pubs" => $pub ,
            "cals" => $cal
        ));

    }

}