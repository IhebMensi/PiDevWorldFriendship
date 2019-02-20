<?php

namespace PiDev\GestionVente\VenteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PiDevGestionVenteVenteBundle:Default:index.html.twig');
    }
}
