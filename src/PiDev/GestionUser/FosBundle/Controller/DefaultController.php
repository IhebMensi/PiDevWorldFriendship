<?php

namespace PiDev\GestionUser\FosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PiDevGestionUserFosBundle:Default:index.html.twig');
    }
}
