<?php

namespace PiDev\GestionPublicite\PubliciteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PiDevGestionPublicitePubliciteBundle:Default:index.html.twig');
    }
}
