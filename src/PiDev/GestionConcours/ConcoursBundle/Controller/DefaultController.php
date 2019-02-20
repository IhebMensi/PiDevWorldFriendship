<?php

namespace PiDev\GestionConcours\ConcoursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PiDevGestionConcoursConcoursBundle:Default:index.html.twig');
    }
}
