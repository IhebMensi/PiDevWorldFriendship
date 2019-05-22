<?php


namespace Esprit\ApiBundle\Controller;


use PiDev\GestionCategorie\CategorieBundle\Entity\Categorie;
use PiDev\GestionCategorie\CategorieBundle\Entity\Interet;
use PiDev\GestionCategorie\CategorieBundle\Form\InteretType;
use PiDev\GestionCategorie\CategorieBundle\Form\RechercheForm;
use Symfony\Component\HttpFoundation\Request;

use PiDev\GestionCategorie\CategorieBundle\Repository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use PiDev\GestionCategorie\CategorieBundle\Form\CategorieType;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\JsonResponse;

class WebServiceController extends Controller
{
    public function ListApiAction()
    {
        $em=$this->getDoctrine()->getManager();
        $categories= $em->getRepository('PiDevGestionCategorieCategorieBundle:Categorie')->findAll();

        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($categories);
        return new JsonResponse($formatted);
    }

    public function ListIntAction()
    {
        $em=$this->getDoctrine()->getManager();
        $s= $em->getRepository('PiDevGestionCategorieCategorieBundle:Interet')->findAll();

        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($s);
        return new JsonResponse($formatted);

    }

    public function RechercheCatAction(Request $request){
        $nom = $request->get('nom');
        $categorie=new Categorie();
        $em = $this->getDoctrine()->getManager();

            $categorie=$em->getRepository('PiDevGestionCategorieCategorieBundle:Categorie')
                ->findBy(['nomcategorie' => 'voyage' ]);
             //->findNom($nom);


        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($categorie);
        return new JsonResponse($formatted);
    }

    public function suivreCatAction(Request $request)
    {
        $idc = $request->get('idC');
        $idu = $request->get('idU');

        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('PiDevGestionCategorieCategorieBundle:Categorie')->find($idc);
        $user = $em->getRepository('PiDevGestionUserFosBundle:User')->find($idu);

        $interet = new Interet();
        $interet->setCategorie($categorie);
        $interet->setUserid($user);
        $old_nb = $categorie->getNbrabonnees();
        $new_nb = $old_nb + 1;
        $categorie->setNbrabonnees($new_nb);
        $em->persist($interet);
        $em->flush();
        $em->persist($categorie);
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($interet);
        return new JsonResponse($formatted);
    }

    public function logineAction(Request $request)
    {
        $us = $request->get('us');
        $mp = $request->get('mp');
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository("PiDevGestionUserFosBundle:User")->findBy(["username"=>$us,"password"=>$mp]);
        if ($user != null) { $msg =1;}
        else {$msg =2;}
        // $user=$this->getDoctrine()->getManager()->getRepository('@PiDevGestionUserFosBundle:User')->findBy(["username"=>$us,"password"=>$mp]);
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($msg);
        return new JsonResponse($formatted);
    }

}
