<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Session\Session;

use BlogBundle\Entity\User;

use BlogBundle\Form\UserType;

class UserController extends Controller
{

	private $session;

	public function __construct(){
		$this->session = new Session();
	}

   
   	public function loginAction(Request $request ){

   		$authenticationUtils = $this->get("security.authentication_utils");
   		$error = $authenticationUtils->getLastAuthenticationError();
   		$last_username = $authenticationUtils->getLastUsername();

 
   		$user = new User();

   		//Creamos el formulario
   		$form = $this->createForm(UserType::class, $user);

   		//Rellenamos el formulario
   		$form->handleRequest($request);

   		if ($form->isSubmitted()) {
	   		//si el formulario es valido
	   		if($form->isValid()){
	   			$user = new User();
	   			$user->setName($form->get("name")->getData());
	   			$user->setSurname($form->get("surname")->getData());
	   			$user->setEmail($form->get("email")->getData());

	   			//Cifrando contraseña
	   			//Llamamos al servicio
	   			$factory = $this->get("security.encoder_factory");

	   			$user->setPassword($form->get("password")->getData());
	   			$user->setRole("ROLE_USER");
	   			$user->setImage(null);
 
	   			$em = $this->getDoctrine()->getEntityManager();
	   			$em->persist($user); 

	   			$flush = $em->flush();

	   			if($flush == null){
					$status = "el usuario se ha creado correctamente";
	   			}else{
	   				$status = "No te has registrado correctamente";	
	   			}
	   		}else{
	   			$status = "No te has registrado correctamente";
	   		}

	   		$this->session->getFlashBag()->add("status", $status);
   		}

   		return $this->render('BlogBundle:User:login.html.twig', array(
   				"error" => $error,
   				"last_username" => $last_username,
   				"form" => $form->createView()
   			));
   	}



}
