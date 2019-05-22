<?php
/**
 * Created by PhpStorm.
 * User: dorra
 * Date: 26/02/2019
 * Time: 13:00
 */

namespace PiDev\GestionCategorie\CategorieBundle\Controller;


use PiDev\GestionCategorie\CategorieBundle\Entity\Interet;
use PiDev\GestionCategorie\CategorieBundle\Entity\Categorie;
use PiDev\GestionCategorie\CategorieBundle\Form\InteretType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class InteretController extends Controller
{
    public function suivreCatAction(Request $request){
        $id=$request-> get('id');
        $em = $this->getDoctrine()->getManager();
        $categorie=$em->getRepository('PiDevGestionCategorieCategorieBundle:Categorie')->find($id);
        $interet = new Interet();
        $interet->setCategorie($categorie);
        $interet->setUserid($this->getUser());
        $form = $this->createForm(InteretType::class,$interet);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid() ){
            $em = $this->getDoctrine()->getManager();
            $em->persist($interet);
            $em->flush();
            return $this->redirectToRoute('listCatF');
        }
        $old_nb = $categorie->getNbrabonnees();

        $new_nb = $old_nb+ 1;
        $categorie->setNbrabonnees($new_nb);
        $em->persist($categorie);
        $em->flush();
        return $this->render('@PiDevGestionCategorieCategorie/Categorie/suivre.html.twig',
            array(
                "Form"=> $form->createView()
            )
        );
    }

}