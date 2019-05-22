<?php
/**
 * Created by PhpStorm.
 * User: dorra
 * Date: 12/02/2019
 * Time: 11:15
 */

namespace PiDev\GestionCategorie\CategorieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use PiDev\GestionCategorie\CategorieBundle\Entity\Categorie;
use PiDev\GestionCategorie\CategorieBundle\Form\CategorieType;
use PiDev\GestionCategorie\CategorieBundle\Form\RechercheForm;
use Symfony\Component\HttpFoundation\Response;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;


class CategorieController extends Controller
{
    public function listCategorieAction(){
        $em=$this->getDoctrine()->getManager();
        $categories= $em->getRepository('PiDevGestionCategorieCategorieBundle:Categorie')->findAll();


        return $this->render('@PiDevGestionCategorieCategorie/Categorie/listCategorie.html.twig',
            array(
                "categorie"=>$categories
            ));

    }

    public function listCatFAction(){
        $em=$this->getDoctrine()->getManager();
        $categories= $em->getRepository('PiDevGestionCategorieCategorieBundle:Categorie')->findAll();


        return $this->render('@PiDevGestionCategorieCategorie/Categorie/listCatFront.html.twig',
            array(
                "categorie"=>$categories
            ));

    }

    public function addCategorieAction(Request $request){
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class,$categorie);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isSubmitted()){
            /*
            * @var Symfony\Component\HttpFoundation\File\UploadedFile $file
            */
            $file = $categorie->getImagecategorie();

            $fileName =md5(uniqid()).'.'.$file->guessExtension();


            $file->move( $this->getParameter('categories_directory'), $fileName);
            $categorie->setImagecategorie($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();
            return $this->redirectToRoute('listCategorie');
        }
        return $this->render('@PiDevGestionCategorieCategorie/Categorie/addCategorie.html.twig',
            array(
                "Form"=> $form->createView()
            )
        );
    }

    public function modifCategorieAction(Request $request){
        $id=$request-> get('id');
        $em=$this->getDoctrine()->getManager();
        $categorie=$em->getRepository('PiDevGestionCategorieCategorieBundle:Categorie')->find($id);
        $form = $this->createForm(CategorieType::class,$categorie);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $categorie->setImagecategorie(
                new File($this->getParameter('categories_directory').'/'.$categorie->getImagecategorie())
            );

            $em->persist($categorie);
            $em->flush();
            return $this->redirectToRoute('listCategorie');
        }
        return $this->render('@PiDevGestionCategorieCategorie/Categorie/modifCategorie.html.twig',
            array(
                "Form"=> $form->createView()
            )
        );

    }
    public function suppCategorieAction(Request $request){
        $id=$request-> get('id');
        $em=$this->getDoctrine()->getManager();
        $categorie=$em->getRepository('PiDevGestionCategorieCategorieBundle:Categorie')->find($id);
        $em->remove($categorie);
        $em->flush();
        return $this->redirectToRoute('listCategorie');

    }
    public function recherchenomDQLAction(Request $request)
    {
        $categoriee=new Categorie();
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('PiDevGestionCategorieCategorieBundle:Categorie')
            ->findAll();
        $Form=$this->createForm(RechercheForm::class,$categoriee);
        $Form->handleRequest($request);

        if($Form->isValid()){
            $nomcategorie=$categoriee->getNomcategorie();
            $categorie=$em->getRepository('PiDevGestionCategorieCategorieBundle:Categorie')
                ->findNom($nomcategorie);
        }

        return $this->render('PiDevGestionCategorieCategorieBundle:Categorie:recherche.html.twig',
            array(
                "Form" => $Form->createView(),
                "categorie" => $categorie
            ));
    }

    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $entities =  $em->getRepository('PiDevGestionCategorieCategorieBundle:Categorie')
            ->findByNom($requestString);
        if(!$entities) {
            $result['entities']['error'] = "there is no categorie with this name";
        } else {
            $result['entities'] = $this->getRealEntities($entities);
        }
        return new Response(json_encode($result));

    }

    public function getRealEntities($entities){
        foreach ($entities as $entity){
            $realEntities[$entity->getIdcategorie()] =
                [$entity->getNomcategorie(),
                    $entity->getNbrabonnees(),
                    $entity->getDescriptioncategorie()];
        }
        return $realEntities;
    }

    public function indexAction() {
        $pieChart = new PieChart();
        $em= $this->getDoctrine()->getManager();
        $categories = $em->getRepository('PiDevGestionCategorieCategorieBundle:Categorie')
            ->findAll();
        $totalAb=0;
        foreach($categories as $categorie)
        {
            $totalAb=$totalAb+$categorie->getNbrabonnees();
        }
        $data= array();
        $stat=['categorie', 'nbAbonnes'];
        $nb=0; array_push($data,$stat);
        foreach($categories as $categorie)
        {
            $stat=array();
            array_push($stat,$categorie->getNomcategorie(),
                (( $categorie -> getNbrabonnees() ) *100) / $totalAb );

            $nb=($categorie->getNbrabonnees() *100)/$totalAb;

            $stat=[$categorie->getNomcategorie(),$nb]; array_push($data,$stat);
        }
        $pieChart->getData()->setArrayToDataTable( $data );
        $pieChart->getOptions()->setTitle('Pourcentages des abonnés par categorie');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        return $this->render('PiDevGestionCategorieCategorieBundle:Categorie:stat.html.twig',
            array('piechart' => $pieChart));
    }

}