<?php
/**
 * Created by PhpStorm.
 * User: Marwa
 * Date: 23/02/2019
 * Time: 18:00
 */

namespace PiDev\GestionEvenement\EvenementBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NotificationController extends Controller
{
public function displayAction()
{
    $notifications = $this->getDoctrine()->getManager()->getRepository('PiDevGestionEvenementEvenementBundle:Notification')->findAll();
    return $this->render('@PiDevGestionEvenementEvenement/Event/Notificaiton.html.twig',array(
        'notifications'=> $notifications
    ));
}
}