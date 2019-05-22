<?php
/**
 * Created by PhpStorm.
 * User: ihebm
 * Date: 27/04/2019
 * Time: 19:27
 */

namespace Esprit\ApiBundle\Controller;


use Esprit\ApiBundle\Entity\Reclamation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ReclamationController extends Controller
{
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $rec=new Reclamation();
        $rec->setTitrereclam($request->get('titrereclam'));
        $rec->setDescriptionreclam($request->get('descriptionreclam'));
        $rec->setDatereclam(new \DateTime('now'));
      $rec->setEtatreclam($request->get('etatreclam'));


        $em->persist($rec);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($rec);
        return new JsonResponse($formatted);
    }
}