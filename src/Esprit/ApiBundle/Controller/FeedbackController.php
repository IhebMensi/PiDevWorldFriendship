<?php
/**
 * Created by PhpStorm.
 * User: ihebm
 * Date: 29/04/2019
 * Time: 13:54
 */

namespace Esprit\ApiBundle\Controller;

use Esprit\ApiBundle\Entity\Feedback;
use Esprit\ApiBundle\Entity\Reclamation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
class FeedbackController extends  Controller
{

    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $feed=new Feedback();
        $feed->setNote($request->get('note'));
        $feed->setDescriptionfeedback($request->get('descriptionfeedback'));
        $feed->setDatefeedback(new \DateTime('now'));



        $em->persist($feed);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($feed);
        return new JsonResponse($formatted);
    }


}