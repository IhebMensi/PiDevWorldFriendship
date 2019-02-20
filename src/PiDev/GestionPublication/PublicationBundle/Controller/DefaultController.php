<?php

namespace PiDev\GestionPublication\PublicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PiDevGestionPublicationPublicationBundle:Default:index.html.twig');
    }
}
