<?php

namespace PiDev\GestionReclamation\ReclamationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PiDevGestionReclamationReclamationBundle:Default:index.html.twig');
    }
}
