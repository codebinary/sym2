<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Session\Session;

use BlogBundle\Entity\User;

use BlogBundle\Form\UserType;

class ContactoController extends Controller
{

	private $session;

	public function __construct(){
		$this->session = new Session();
	}

   
   	public function indexAction($page){

   		$em = $this->getDoctrine()->getEntityManager();
   		$contacto_repo = $em->getRepository("BlogBundle:Contacto");

   		$pageSize = 20;
   		$contactos = $contacto_repo->getPaginateEntries(20, $page);

   		//Pagination
   		$totalItems = count($contactos);
   		$pageCount = ceil($totalItems/$pageSize);




   		return $this->render("BlogBundle:Contacto:index.html.twig", array(
   			"contactos" => $contactos,
   			"totalItems" => $totalItems,
   			"pages" => $pageCount
   		));

   	}

   	public function deleteAction($id){

   		$em = $this->getDoctrine()->getEntityManager();
   		$contacto_repo = $em->getRepository("BlogBundle:Contacto");
   		$contacto = $contacto_repo->find($id);

   		$em->remove($contacto);
   		$em->flush();

   		return $this->redirectToRoute("blog_contactos");


   	}


}