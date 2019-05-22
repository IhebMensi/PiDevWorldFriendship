<?php
/**
 * Created by PhpStorm.
 * User: Houssem
 * Date: 17/02/2019
 * Time: 13:18
 */

namespace PiDev\GestionVente\VenteBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use PiDev\GestionVente\VenteBundle\Entity\CommentaireProduit;
use PiDev\GestionVente\VenteBundle\Form\CommentaireProduitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CommentaireController extends Controller
{
    public function AjouterCommentaireAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        $Comm = new CommentaireProduit();
        {
            $em = $this->getDoctrine()->getManager();

            $commentaire = $em->getRepository("PiDevGestionVenteVenteBundle:CommentaireProduit")->findAll();
            $form = $this->createForm(CommentaireProduitType::class, $Comm);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $em->persist($Comm);
                $em->flush();
                $commentaire = $em->getRepository("PiDevGestionVenteVenteBundle:CommentaireProduit")->findAll();
                return $this->render('@PiDevGestionVenteVente/Com/com.html.twig',
                    array('f' => $form->createView(), "EVE" => $commentaire));
            }
            return $this->render('@PiDevGestionVenteVente/Com/com.html.twig',
                array('f' => $form->createView(), "EVE" => $commentaire));

        }
    }
public function ModifierCommentaireAction(Request $request)
{
    $idc=$request->get('idcommentaire');
    $em=$this->getDoctrine()->getManager();
    $commentaire=$em->getRepository("PiDevGestionVenteVenteBundle:CommentaireProduit")->find($idc);


    $form = $this->createForm(CommentaireProduitType::class,$commentaire);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid())
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($commentaire);
        $em->flush();
        return $this->redirectToRoute('gestion_vente_Afficher_TOUS_produit');
    }
    /////////////////////////
    return $this->render('@PiDevGestionVenteVente/Com/Modif.html.twig',
        array('F' => $form->createView()));
}

public function SupprimerCommentaireAction(Request $request)
{
    $idc=$request->get('idcommentaire');
    $em = $this->getDoctrine()->getManager();
    $com = $em->getRepository('PiDevGestionVenteVenteBundle:CommentaireProduit')
        ->find($idc);
    $em->remove($com);
    $em->flush();
    return $this->redirectToRoute('gestion_vente_Afficher_TOUS_produit');
}

}