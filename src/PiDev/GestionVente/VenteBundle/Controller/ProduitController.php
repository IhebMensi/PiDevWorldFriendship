<?php
/**
 * Created by PhpStorm.
 * User: Houssem
 * Date: 11/02/2019
 * Time: 12:48
 */

namespace PiDev\GestionVente\VenteBundle\Controller;


use PiDev\GestionUser\FosBundle\Entity\User;
use PiDev\GestionVente\VenteBundle\Entity\CommentaireProduit;
use PiDev\GestionVente\VenteBundle\Entity\FavorisProduit;
use PiDev\GestionVente\VenteBundle\Entity\ReactionProduit;
use PiDev\GestionVente\VenteBundle\Entity\SignalerProduit;
use PiDev\GestionVente\VenteBundle\Form\CheckProduitType;
use PiDev\GestionVente\VenteBundle\Form\CommentaireProduitType;
use PiDev\GestionVente\VenteBundle\Form\NewProduitform;
use PiDev\GestionVente\VenteBundle\Form\ProduitType;
use PiDev\GestionVente\VenteBundle\Form\RangePrixType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PiDev\GestionVente\VenteBundle\Entity\Produit;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Constraints\Date;

class ProduitController extends Controller
{

    public function AfficherProduitAction(Request $request)
    {
        $datej=new \DateTime('now');
        $em= $this->getDoctrine()->getManager();
        $prod =$em->getRepository("PiDevGestionVenteVenteBundle:Produit")->findByEtat();

        $pr=new Produit();
        $Form=$this->createForm(CheckProduitType::class,$pr);
        $Form->handleRequest($request);

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator=$this->get('knp_paginator');
        $result= $paginator->paginate(
            $prod,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',4));



        if($request->isMethod("post") ) {

            $categorie = $request->get('categorie');
            $em = $this->getDoctrine()->getManager();
            $prod = $em->getRepository("PiDevGestionVenteVenteBundle:Produit")
                ->findBy(array('categorie' => $categorie));

            /**
             * @var $paginator \Knp\Component\Pager\Paginator
             */
            $paginator=$this->get('knp_paginator');
            $result= $paginator->paginate(
                $prod,
                $request->query->getInt('page',1),
                $request->query->getInt('limit',4));

            return $this->render('@PiDevGestionVenteVente/Prod/Rech.html.twig',
                array("F"=>$Form->createView(),"prn"=>$result , "daten"=>$datej));
        }
/////////////////////

        return $this->render('@PiDevGestionVenteVente/Prod/Rech.html.twig',
            array(
                "F" => $Form->createView(),
                "prn" => $result, "daten"=>$datej
            ));

    }


    public function RechercherProduitAction(Request $request)
    { //Rech1
        $pr= new Produit();
        $form1 = $this-> createForm(NewProduitform::class,$pr);
        $form1->handleRequest($request);
        if($form1->isSubmitted() && $form1->isValid())
        {

            $em = $this->getDoctrine()->getManager();
            $pr=$em->getRepository("PiDevGestionVenteVenteBundle:Produit")
                ->findBy(array('categorie'=>$pr->getCategorie()));
        }



        return $this->render('@PiDevGestionVenteVente/Prod/Rech.html.twig',
            array("F"=>$Form->createView(),
                "prods"=>$prods));

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
        $id=$request->get('idproduit');
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

// *************************** MON ESPACE********************************************************************
public function AddnewProduitAction(Request $request)
{
    $user = $this->getUser();
    $prod = new Produit();
    $prod->setUser($user);
    // $idu=$request->getSession();
    $form = $this->createForm(ProduitType::class, $prod);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $prod->uploadProfilePicture();
        $em->persist($prod);
        $em->flush();
        return $this->redirectToRoute('gestion_vente_Aj_Nv_produit');
    }
        return $this->render('@PiDevGestionVenteVente/Prod/EspaceAjout.html.twig',
            array("f" => $form->createView()));
    }

    public function AjouterProduitAction(Request $request)
    { // $idu=$request->getUser();

        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $pr=$em->getRepository("PiDevGestionVenteVenteBundle:Produit")->findByUser($user);
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator=$this->get('knp_paginator');
        $result= $paginator->paginate(
            $pr,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',2));
        $prod=new Produit();

        $em = $this->getDoctrine()->getManager();
        $Form=$this->createForm(CheckProduitType::class,$prod);
        $Form->handleRequest($request);
        if($request->isMethod("post") ) {

        $categorie = $request->get('categorie');
        $em = $this->getDoctrine()->getManager();
        $prods= $em->getRepository("PiDevGestionVenteVenteBundle:Produit")
            ->findBy(array('categorie' => $categorie));

        /**
             * @var $paginator \Knp\Component\Pager\Paginator
             */
            $paginator = $this->get('knp_paginator');
            $result = $paginator->paginate(
                $prods,
                $request->query->getInt('page', 1),
                $request->query->getInt('limit', 2));
            return $this->render('@PiDevGestionVenteVente/Prod/Ajouter_nv_p.html.twig',
                array("F" => $Form->createView(), "EVE" => $result));
        }
            return $this->render('@PiDevGestionVenteVente/Prod/Ajouter_nv_p.html.twig',
                array("F" => $Form->createView(), "EVE" => $result));

    } //CBN AJOUTD'UN NV PROD +AFF DE MES PROD
    public function SupprimerProduitAction(Request $request)
    {
        $id=$request->get('idproduit');
        $em=$em= $this->getDoctrine()->getManager();
        $event=$em->getRepository("PiDevGestionVenteVenteBundle:Produit")->find($id);

        $em->remove($event);
        $em->flush();


        return $this->redirectToRoute('gestion_vente_Aj_Nv_produit');

    } // Supp MOn Prod
    public function ConfirmationAction(Request $request)
    {$id=$request->get('idproduit');
        $em= $this->getDoctrine()->getManager();
        $prod=$em->getRepository("PiDevGestionVenteVenteBundle:Produit")->find($id);
        return $this->render('@PiDevGestionVenteVente/Prod/Confirmation.html.twig',array("p"=>$prod));
    }
    public function AfficherMesProduitsAction(Request $request)
    {
        $user = $this->getUser();
        $user = $this->getUser()->getNom();
        $em= $this->getDoctrine()->getManager();
        $prod=$em->getRepository("PiDevGestionVenteVenteBundle:Produit")->findBy(['user'=>$user]);

        return $this->render('@PiDevGestionVenteVente/Prod/Mesprod.html.twig',
            array("EVE"=>$prod));
    } //Tekhdem cbn Mon espace f west acceuil
    public function EspaceModificatioAction(Request $request)
    {
        $idp=$request->get('idproduit');
        $em= $this->getDoctrine()->getManager();
        $prod=$em->getRepository("PiDevGestionVenteVenteBundle:Produit")->find($idp) ;
        return $this->render('@PiDevGestionVenteVente/Prod/Espace_Modification_p.html.twig',
            array("produit"=>$prod));
    }  //View avant modif cbn
    public function ModifierMonProduitAction(Request $request)
    {
        $id = $request->get('idproduit');
        $em = $this->getDoctrine()->getManager();
        $prod = $em->getRepository("PiDevGestionVenteVenteBundle:Produit")
            ->find($id);
        $pr = $em->getRepository("PiDevGestionVenteVenteBundle:Produit")
            ->find($id);
        $form = $this->createForm(ProduitType::class, $prod);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $prod->uploadProfilePicture();
            $em->persist($prod);
            $em->flush();
            return $this->redirectToRoute('gestion_vente_Aj_Nv_produit');
        }
        return $this->render('@PiDevGestionVenteVente/Prod/Modif_Prod.html.twig',
            array(
                "Form" => $form->createView(),"ancienp"=>$pr
            ));
    }  //modification cbn
    public function EspaceProduitAction(Request $request)
    {
        $Comm = new CommentaireProduit();

        $em=$this->getDoctrine()->getManager();
        $user=$this->getUser();
        $idp=$request->get('idproduit');
        $prod=$em->getRepository("PiDevGestionVenteVenteBundle:Produit")->find($idp) ;
        $nom=$user->getPrenom();
        $commentaire=$em->getRepository("PiDevGestionVenteVenteBundle:CommentaireProduit")->findBy(array('produit'=>$idp));

        $form = $this->createForm(CommentaireProduitType::class,$Comm);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {   $em= $this->getDoctrine()->getManager();
            $Comm ->setUser($user);
            $Comm->setProduit($prod);
            $em->persist($Comm);
            $em->flush();
            return $this->redirectToRoute('gestion_vente_espace_produit',array('idproduit'=>$prod->getIdproduit()));
        }
        return $this->render('@PiDevGestionVenteVente/Prod/Espace_p.html.twig',
            array("produit"=>$prod,'f' => $form->createView(),"EVE"=>$commentaire,"n"=>$nom));
    } //tekhdem cbn espace d'un produit




// *************************** ESPACE Vente********************************************************************



    public function LikeProduitAction(Request $request)
    {

        $id=$request->get('idproduit');
        $em= $this->getDoctrine()->getManager();
        $prod=$em->getRepository("PiDevGestionVenteVenteBundle:Produit")->find($id);
        $old_nb_like=$prod->getNbrlikes();

        $new_nb_like = $old_nb_like + 1;
        $prod->setNbrlikes($new_nb_like);
        $em->persist($prod);
        $em->flush();
        $nb=$prod->getNbrlikes();

        return $this->redirectToRoute('gestion_vente_Afficher_TOUS_produit');

    }
    public function DislikeProduitAction(Request $request)
    {

        $id=$request->get('idproduit');
        $em= $this->getDoctrine()->getManager();
        $prod=$em->getRepository("PiDevGestionVenteVenteBundle:Produit")->find($id);
        $old_nb_dislike=$prod->getNbrdislikes();

        $new_nb_dislike = $old_nb_dislike + 1;
        $prod->setNbrdislikes($new_nb_dislike);
        $em->persist($prod);
        $em->flush();
        $nb=$prod->getNbrdislikes();

        return $this->redirectToRoute('gestion_vente_Afficher_TOUS_produit');

    }
    public function PaypalAction()
    {
        return $this->render('@PiDevGestionVenteVente/Prod/Paypal.html.twig');
    }
    public function tesAction(Request $request)
{
  //  $user = $this->getUser()->getId();
    //$em= $this->getDoctrine()->getManager();
    //$prod=$em->getRepository("PiDevGestionUserFosBundle:User")->find($user);

    $pr= new Produit();
    $em = $this->getDoctrine()->getManager();
    $pro = $em->getRepository("PiDevGestionVenteVenteBundle:Produit")->findAll();

    $form1 = $this-> createForm(CheckProduitType::class,$pr);
    $form1->handleRequest($request);
    if ($form1->isSubmitted() && $form1->isValid()) {
        $pays = $request->get('pays');
        $categorie = $request->get('categorie');
        $em = $this->getDoctrine()->getManager();
        //$pro = $em->getRepository("PiDevGestionVenteVenteBundle:Produit")->findByPrix($prix);
         $pro=$em->getRepository("PiDevGestionVenteVenteBundle:Produit")->findProduit($pays,$categorie);
        return $this->render('@PiDevGestionVenteVente/Prod/A.html.twig',
            array('RechF'=>$form1->createView(),"Amende"=>$pro));
    }

    return $this->render('@PiDevGestionVenteVente/Prod/A.html.twig',
        array('RechF'=>$form1->createView(),"Amende"=>$pro));
}
    public function testAction(Request $request)
    {

        $prod=new Produit();

        $em = $this->getDoctrine()->getManager();
        $prods = $em->getRepository('PiDevGestionVenteVenteBundle:Produit')
            ->findAll();
        $Form=$this->createForm(CheckProduitType::class,$prod);
        $Form->handleRequest($request);
        if($Form->isValid()){
            $pays=$prod->getPays();
            $categorie=$prod->getCategorie();
            $prods=$em->getRepository('PiDevGestionVenteVenteBundle:Produit')
                ->findProduitt($pays,$categorie);
            return $this->render('@PiDevGestionVenteVente/Prod/A.html.twig',
                array(
                    "Form" => $Form->createView(),
                    "prods" => $prods
                ));

        }

        return $this->render('@PiDevGestionVenteVente/Prod/A.html.twig',
            array(
                "Form" => $Form->createView(),
                "prods" => $prods
            ));
    }
    public function RangeAction(Request $request)
    {

        $prod=new Produit();

        $em = $this->getDoctrine()->getManager();
        $prods = $em->getRepository('PiDevGestionVenteVenteBundle:Produit')
            ->findAll();
        $Form=$this->createForm(RangePrixType::class,$prod);
        $Form->handleRequest($request);
        if($Form->isValid()){
            $prix=$prod->getPrix();
            $prods=$em->getRepository('PiDevGestionVenteVenteBundle:Produit')
                -> findRangeProduitt($prix);
            return $this->render('@PiDevGestionVenteVente/Prod/Range.html.twig',
                array(
                    "Form" => $Form->createView(),
                    "prods" => $prods
                ));

        }

        return $this->render('@PiDevGestionVenteVente/Prod/Range.html.twig',
            array(
                "Form" => $Form->createView(),
                "prods" => $prods
            ));
    }

    public function LikeAction(Request $request)
{

    $idp=$request->get('idproduit');
    $em=$this->getDoctrine()->getManager();
    $prod=$em->getRepository("PiDevGestionVenteVenteBundle:Produit")->find($idp);
//////////////////////////////////////////
      $idu=$this->getUser();
    $user=$em->getRepository("PiDevGestionUserFosBundle:User")->find($idu);
    //////////////////////////////////////////
   $like=$em->getRepository("PiDevGestionVenteVenteBundle:ReactionProduit")->findBy(["produit"=>$prod,"User"=>$user]);
    if($like != null) {
        //remove reaction
        $em->remove($like[0]);
        $em->flush();
    }
    $like = new ReactionProduit();
    $like->setUser($user);
    $like->setProduit($prod);
    $like->setReaction('like');
    $em->persist($like);
    $em->flush();

return $this->redirectToRoute('gestion_vente_Afficher_TOUS_produit');


}
    public function DislikeAction(Request $request)
    {

        $idp=$request->get('idproduit');
        $em=$this->getDoctrine()->getManager();
        $prod=$em->getRepository("PiDevGestionVenteVenteBundle:Produit")->find($idp);
//////////////////////////////////////////
        $idu=$this->getUser();
        $user=$em->getRepository("PiDevGestionUserFosBundle:User")->find($idu);
        //////////////////////////////////////////
        $dislike=$em->getRepository("PiDevGestionVenteVenteBundle:ReactionProduit")->findBy(["produit"=>$prod,"User"=>$user]);
        if($dislike != null) {
            //remove reaction
            $em->remove($dislike[0]);
            $em->flush();
        }
        $dislike = new ReactionProduit();
        $dislike->setUser($user);
        $dislike->setProduit($prod);
        $dislike->setReaction('dislike');
        $em->persist($dislike);
        $em->flush();

        return $this->redirectToRoute('gestion_vente_Afficher_TOUS_produit');


    }
    public  function abcAction(Request $request)
{
    $idp=$request->get('idproduit');
    $em=$this->getDoctrine()->getManager();
    $prod=$em->getRepository("PiDevGestionVenteVenteBundle:Produit")->find($idp);
    $idu=$this->getUser();
    $user=$em->getRepository("PiDevGestionUserFosBundle:User")->find($idu);

    $commentaire=$em->getRepository("PiDevGestionVenteVenteBundle:CommentaireProduit")->findBy(["produit"=>$prod,"User"=>$user]);

    $com=$em->getRepository("PiDevGestionVenteVenteBundle:CommentaireProduit")->findAll();
    $form = $this->createForm(CommentaireProduitType::class,$commentaire);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid())
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($commentaire);
        $em->flush();
        return $this->redirectToRoute('gestion_vente_AFf_produit');
    }
    return $this->render('@PiDevGestionVenteVente/Prod/abc.html.twig',
            array('f' => $form->createView(),"EVE"=>$com,"pr"=>$prod));
}
public function SignalerAction(Request $request)
{

    $idp = $request->get('idproduit');
    $em = $this->getDoctrine()->getManager();
    $prod = $em->getRepository("PiDevGestionVenteVenteBundle:Produit")->find($idp);
//////////////////////////////////////////
    $idu = $this->getUser();
    $user = $em->getRepository("PiDevGestionUserFosBundle:User")->find($idu);
    //////////////////////////////////////////
    $sig = $em->getRepository("PiDevGestionVenteVenteBundle:SignalerProduit")->findBy(["produit" => $prod, "User" => $user]);
    $old_nb_sig = $sig->getNbsig();
    if ($old_nb_sig > 0) {
        $new_nb_sig = $old_nb_sig - 1;
        $sig->setNbsig($new_nb_sig);
        $em->persist($sig);
        $em->flush();
    }
    return $this->redirectToRoute('gestion_vente_Afficher_TOUS_produit');

}

    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $entities =  $em->getRepository('PiDevGestionVenteVenteBundle:Produit')->findByNom($requestString);
        if(!$entities) {
            $result['entities']['error'] = "there is no challenge with this name";
        } else {
            $result['entities'] = $this->getRealEntities($entities);
        }
        return new Response(json_encode($result));
    }
    public function getRealEntities($entities)
    {
        foreach ($entities as $entity){
            $realEntities[$entity->getIdproduit()] = [$entity->getNomproduit(),
                $entity->getDescriptionproduit(), $entity->getCategorie(),
                $entity->getPrix(),$entity->getDatemisevente(),
                $entity->getNomimage(),$entity->getNbrdislikes(),
                $entity->getNbrlikes(),$entity->getIdcom(),
                $entity->getUser(),$entity->getFile()];
        }
        return $realEntities;
    }

    ///////////////////////////////////////////////////////////////////////
    ///

    public function allAction(){
        $tasks = $this->getDoctrine()->getManager()
            ->getRepository('PiDevGestionVenteVenteBundle:Produit')
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);

    }
    public function findAction($id){

      //  $encoders = array(new JsonEncoder());
        //$normalizers = array(new GetSetMethodNormalizer());
        //$serializer = new Serializer($normalizers, $encoders);

        $tasks = $this->getDoctrine()->getManager()
            ->getRepository('PiDevGestionVenteVenteBundle:Produit')
            ->find($id);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }
    public function findByUserAction($id){


        //  $encoders = array(new JsonEncoder());
        //$normalizers = array(new GetSetMethodNormalizer());
        //$serializer = new Serializer($normalizers, $encoders);

        $tasks = $this->getDoctrine()->getManager()
            ->getRepository('PiDevGestionVenteVenteBundle:Produit')
            ->findBy(['user'=>$id]);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }


    public function newAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $prod = new Produit();
        $datej=new \DateTime('now');

        $prod->setNomproduit($request->get('nomproduit'));
        $prod->setDatemisevente($datej);
        $prod->setPrix($request->get('prix'));
        $prod->setDescriptionproduit($request->get('descriptionproduit'));
        $prod->setCategorie($request->get('categorie'));
        $prod->setNomimage($request->get('nomimage'));

        $em->persist($prod);
        $em->flush();


        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($prod);
        return new JsonResponse($formatted);
    }

    public function deleteAction($id){

        $em=$em= $this->getDoctrine()->getManager();
        $prod=$em->getRepository("PiDevGestionVenteVenteBundle:Produit")->find($id);

        $em->remove($prod);
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($prod);
        return new JsonResponse($formatted);
    }

    public function updateAction(Request $request,$id)
    {

        $em = $this->getDoctrine()->getManager();
        $prod = $em->getRepository("PiDevGestionVenteVenteBundle:Produit")
            ->find($id);
        if ($request->isMethod('POST')) {
            $prod->setNomproduit($request->get('nomproduit'));
            $prod->setPrix($request->get('prix'));
            $prod->setCategorie($request->get('categorie'));
            $prod->setDescriptionproduit($request->get('descriptionproduit'));
            $em->persist($prod);
            $em->flush();
        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($prod);
        return new JsonResponse($formatted);
    }
    public function addfavorisAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $prodfav = new FavorisProduit();
$em = $this->getDoctrine()->getManager();
$u= new User();
$u = $em->getRepository("PiDevGestionUserFosBundle:User")->find($request->get('user'));
        $prodfav->setUser($u);
        $p = new Produit();
        $p=$em->getRepository("PiDevGestionVenteVenteBundle:Produit")->find($request->get('prod'));
        $prodfav->setProd($p);

        $em->persist($prodfav);
        $em->flush();


        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($prodfav);
        return new JsonResponse($formatted);
    }


    public function getAllFavorisAction(){

        $em = $this->getDoctrine()->getManager();
$id=3;
       $favoris = $em->getRepository("PiDevGestionUserFosBundle:User")->find($id);
       // $idp= $favoris->getId();
       $prod=$em->getRepository("PiDevGestionVenteVenteBundle:Produit")->findProdfav($favoris);


        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($prod);
        return new JsonResponse($formatted);
    }
    public function deletefavAction($id){

        $em= $this->getDoctrine()->getManager();
        $idu=3;
        //$idu=$request->get('user');
        $user = $em->getRepository("PiDevGestionUserFosBundle:User")->find($idu);
        $favoris = $em->getRepository("PiDevGestionVenteVenteBundle:FavorisProduit")->find($id);
        $em->remove($favoris);
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($favoris);
        return new JsonResponse($formatted);
    }

    public function favbyidAction($id){

        $em= $this->getDoctrine()->getManager();
        $idu=3;
//$id=17;
        $fav =new FavorisProduit();

        $user = $em->getRepository("PiDevGestionUserFosBundle:User")->find($idu);
        $favoris =new FavorisProduit();
        $favoris = $em->getRepository("PiDevGestionVenteVenteBundle:FavorisProduit")->findfavdelBy($idu,$id);
      //$idf=$favoris->get('id');
        //$fav = $em->getRepository("PiDevGestionVenteVenteBundle:FavorisProduit")->find($idf);
        foreach ($favoris as $fav) {
            $em->remove($fav);
        }
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($favoris);
        return new JsonResponse($formatted);
    }





}