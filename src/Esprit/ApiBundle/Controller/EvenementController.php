<?php
/**
 * Created by PhpStorm.
 * User: Marwa
 * Date: 26/04/2019
 * Time: 15:37
 */

namespace Esprit\ApiBundle\Controller;

use Esprit\ApiBundle\Entity\Evenement;
use Esprit\ApiBundle\Entity\ParticipationEvenement;
use Esprit\ApiBundle\Entity\Task;
use PiDev\GestionEvenement\EvenementBundle\Entity\TypeEvenement;
use Esprit\ApiBundle\Form\EvenementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class EvenementController extends Controller
{


    public function allmoAction()
    {

        $tasks = $this->getDoctrine()->getManager()
            ->getRepository('EspritApiBundle:Evenement')
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }

    public function findAction($id)
    {
        $tasks = $this->getDoctrine()->getManager()
            ->getRepository('EspritApiBundle:Evenement')
            ->find($id);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }
    public function allAction()
    {

        $tasks = $this->getDoctrine()->getManager()
            ->getRepository('EspritApiBundle:Evenement')
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);

        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }


    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('PiDevGestionUserFosBundle:User')->find(1);
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
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize($Event);
            return new JsonResponse($formatted);



        }


    }

    public function rechercheAction(Request $request)
    {
        $event=new Evenement();
        $em = $this->getDoctrine()->getManager();
        $pubs = $em->getRepository('EspritApiBundle:Evenement')
            ->findAll();
        if ($request->isMethod('POST')) {

            $nomevenement = $event->getNomimage();
            $categorie = $request->get('Categorie');

            $pubs = $em
                ->getRepository('EspritApiBundle:Evenement')
                ->findnomeveParametre($nomevenement);

        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($pubs);
        return new JsonResponse($formatted);
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

}

