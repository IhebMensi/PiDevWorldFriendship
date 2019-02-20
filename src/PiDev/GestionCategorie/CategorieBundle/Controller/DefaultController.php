<?php

namespace PiDev\GestionCategorie\CategorieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PiDevGestionCategorieCategorieBundle:Default:index.html.twig');
    }
}
