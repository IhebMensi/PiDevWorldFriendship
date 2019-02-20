<?php
/**
 * Created by PhpStorm.
 * User: Houssem
 * Date: 10/02/2019
 * Time: 01:24
 */

namespace PiDev\GestionUser\FosBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Reponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

class UserController extends Controller
{
    public function ModificationAction()
    {
        return $this->render('@PiDevGestionUserFos/User/modif.html.twig');
    }
    public function AcceuilAction()
    {
        return $this->render('@PiDevGestionUserFos/User/acceuil.html.twig');
    }

    public function HomeAction()
    {
        return $this->render('@PiDevGestionUserFos/User/home.html.twig');

    }
    public function AdminAction()
    {
        return $this->render('@PiDevGestionUserFos/User/admin.html.twig');

    }



    public function Home1Action(Request $request)
    {
        $user=$this->getUser();

        return $this->render('@PiDevGestionUserFos/User/home1.html.twig');

    }


    public function RoleAction()
    {
        if($this->get('fos_user_security_check ')->isGranted('ROLE_ADMIN'))
        {
            return $this->render('@PiDevGestionUserFos/User/admin.html.twig');
        }

        if($this->get('fos_user_security_check ')->isGranted('ROLE_USER'))
        {
            return $this->render('@PiDevGestionUserFos/User/home1.html.twig');
        }


    }

    /**
     * @return void
     *
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function REDIRECTAction()
    {
        $var=$this->container->get('security.authorization_checker');
    }



}