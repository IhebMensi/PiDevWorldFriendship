<?php

namespace PiDev\GestionEvenement\EvenementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PiDevGestionEvenementEvenementBundle:Default:index.html.twig');
    }
}
