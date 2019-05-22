<?php
/**
 * Created by PhpStorm.
 * User: Marwa
 * Date: 23/02/2019
 * Time: 12:18
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BookingController extends Controller
{


    public function calendar()
    {
        return $this->render('@PiDevGestionPublicitePublicite/Pub/calendar.html.twig');
    }


}