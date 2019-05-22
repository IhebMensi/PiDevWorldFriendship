<?php
/**
 * Created by PhpStorm.
 * User: Houssem
 * Date: 24/02/2019
 * Time: 23:44
 */

namespace PiDev\GestionVente\VenteBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;

class MailController extends Controller

{
    public function ContactAction(Request $request)
    {
        $firstname = $lastname =$email = $object = $message =Null ;
        $contact_error_firstnamein = Null;
        $form =$this->createFormBuilder()
            ->add('firstname',TextType::class,
                array('constraints'=> array( new NotBlank(array(//'message' =>'contact_error.firstname'
                ))
                ,new Length(array('min'=>3,'max'=>10,)))))
            ->add('lastname',TextType::class,
                array('constraints'=> array( new NotBlank(array(//'message' =>'contact_error.firstname'
                ))
                ,new Length(array('min'=>3,'max'=>10,)))))
            ->add('email',TextType::class,
                array('constraints'=> array(
                    new Assert\Email(array('checkMX' => true)) ,
                    new NotBlank(),)))

            ->add('object',ChoiceType::class,
                array('choices' => array(''=>'','Autre'=>"Autre",'Bug'=>"Bug",'Demande'=>"Demande")))
            ->add('message',TextareaType::class,
                array('constraints'=> array( new NotBlank(array(//'message' =>'contact_error.firstname'
                )),new Length(array('min'=>8,'max'=>20,)))))
            ->add('Send',SubmitType::class, array('label'=>'Envoyer'))
            ->add('reset',ResetType::class,array('label'=>'Envoyer'))
            ->getForm();
        $form->handleRequest($request);
        if($form->isValid()) {
            if ($request->isMethod("post")) {
                $request = Request::createFromGlobals();


                $firstname = $form["firstname"]->getData();
                $lastname = $form["lastname"]->getData();
                $object = $form["object"]->getData();
                $email = $form["email"]->getData();
                $message = $form["message"]->getData();

                $message = \Swift_Message::newInstance()
                    ->setSubject($object)
                    ->setFrom(array($email))
                    ->setTo('ghaithbelkhir@gmail.com')
                    ->setCharset('utf-8')
                    ->setContentType('text/html')
                    ->setBody($this->container->get('templating')->render('@PiDevGestionVenteVente/Mail/email.html.twig',
                        array(
                            'lastname' => $lastname,
                            'firstname' => $firstname,
                            'email' => $email,
                            'object' => $object,
                            'message' => $message)));

                $this->get('mailer')->send($message);

                $this->addFlash('success', 'ok');
                $this->addFlash('sent', 'ok');
            } else {
                $this->addFlash('notice', 'form can\'t be reached like this');
            }
        }  else if ($form->isValid() === false && $request->isMethod("post"))
            {
                $this->addFlash('notice', 'form can\'t be reached like this');
            $this->addFlash('not_sent','Not ok');}
            return $this->render('@PiDevGestionVenteVente/Mail/contact.html.twig',
                array(
                    'f' => $form->createView(),
                    'lastname' => $lastname ,
                    'firstname' => $firstname ,
                    'email' => $email,
                    'object' => $object,
                    'message' => $message ));

        }

}