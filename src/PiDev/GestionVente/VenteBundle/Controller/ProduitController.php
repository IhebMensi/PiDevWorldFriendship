<?php
/**
 * Created by PhpStorm.
 * User: Houssem
 * Date: 11/02/2019
 * Time: 12:48
 */

namespace PiDev\GestionVente\VenteBundle\Controller;


use PiDev\GestionVente\VenteBundle\Form\NewProduitform;
use PiDev\GestionVente\VenteBundle\Form\ProduitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PiDev\GestionVente\VenteBundle\Entity\Produit;

class ProduitController extends Controller
{
    public function AjouterProduitAction(Request $request)
    { // $idu=$request->getUser();

        $prod = new Produit();
       // $idu=$request->getSession();
        $form = $this->createForm(ProduitType::class, $prod);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $prod->uploadProfilePicture();
            $em->persist($prod);
            $em->flush();
            return $this->redirectToRoute('gestion_vente_Afficher_produit');
        }
        return $this->render('@PiDevGestionVenteVente/Prod/ajouter_p.html.twig',
            array('Form' => $form->createView()));

    }
    public function AfficherProduitAction()
    {
        $em= $this->getDoctrine()->getManager();
        $prod=$em->getRepository("PiDevGestionVenteVenteBundle:Produit")->findAll();
        return $this->render('@PiDevGestionVenteVente/Prod/afficher_p.html.twig',
            array("EVE"=>$prod));
    }
    public function SupprimerProduitAction(Request $request)
    {
        $id=$request->get('id');
        $em=$em= $this->getDoctrine()->getManager();
        $event=$em->getRepository("PiDevGestionVenteVenteBundle:Produit")->find($id);

        $em->remove($event);
        $em->flush();


        return $this->redirectToRoute('gestion_vente_Afficher_produit');

    }

    public function RechercherProduitAction(Request $request)
    {
        $pr= new Produit();
        $form1 = $this-> createForm(NewProduitform::class,$pr);
        $form1->handleRequest($request);
        if($form1->isSubmitted() && $form1->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $pr=$em->getRepository("PiDevGestionVenteVenteBundle:Produit")
                ->findBy(array('categorie'=>$pr->getCategorie()));

        }

        return $this->render('@PiDevGestionVenteVente/Prod/rechercher.html.twig',
            array('RechF'=>$form1->createView(),"Amende"=>$pr));

    }

    public function AjouterAfficherProduitAction(Request $request)
    { $prod = new Produit();
        $pr=new  Produit();
        $form = $this->createForm(ProduitType::class, $prod);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $prod->uploadProfilePicture();
            $em->persist($prod);
            $em->flush();
            return $this->redirectToRoute('gestion_vente_Afficher_produit');
        }
        $em= $this->getDoctrine()->getManager();

        $pr=$em->getRepository("PiDevGestionVenteVenteBundle:Produit")->findAll();

        return $this->render('@PiDevGestionVenteVente/Prod/monespace.html.twig',
            array('Form' => $form->createView(),"EVE"=>$pr));
            }
    public function AjouterAfficherProduitnewAction(Request $request)
    {$user = $this->getUser();
        $prod = new Produit();
        $prod->setUser($user);
        $pr=new  Produit();
        $form = $this->createForm(ProduitType::class, $prod);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $prod->uploadProfilePicture();
            $em->persist($prod);
            $em->flush();
            return $this->redirectToRoute('gestion_vente_Afficher_produit');
        }
        //nbr like code

        $em= $this->getDoctrine()->getManager();

        $pr=$em->getRepository("PiDevGestionVenteVenteBundle:Produit")->findAll();
        $id=$request->get('id');
        $em= $this->getDoctrine()->getManager();
        $prod=$em->getRepository("PiDevGestionVenteVenteBundle:Produit")->find($id);
        $old_nb_like=$prod->getNbrlikes();
        $new_nb_like = $old_nb_like + 1;
        $prod->setNbrlikes($new_nb_like);
        $em->persist($prod);
        $em->flush();
        $nb=$prod->getNbrlikes();
        return $this->render('@PiDevGestionVenteVente/Prod/monespacenew.html.twig',
            array('Form' => $form->createView(),"EVE"=>$pr,"p"=>$nb));
    }






}