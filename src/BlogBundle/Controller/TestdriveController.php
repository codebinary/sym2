<?php 

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Session\Session;

class TestdriveController extends Controller
{

	//Listar datos
	public function indexAction($page){


		$em = $this->getDoctrine()->getEntityManager();
		$test_repo = $em->getRepository("BlogBundle:Testdrive");

		$pageSize = 20;
		$testdrives = $test_repo->getPaginateTest(20, $page);

		//Pagination
		$totalItems = count($testdrives);
		$pageCount = ceil($totalItems / $pageSize);


		return $this->render("BlogBundle:Testdrive:index.html.twig", array(
   			"testdrives" => $testdrives,
   			"totalItems" => $totalItems,
   			"pagesCount" => $pageCount,
            "page" => $page,
            "page_m" => $page
   		));
	}


	public function deleteAction($id){

		$em = $this->getDoctrine()->getEntityManager();
   		$testdrive_repo = $em->getRepository("BlogBundle:Testdrive");
   		$testdrive = $testdrive_repo->find($id);

   		$em->remove($testdrive);
   		$em->flush();

   		return $this->redirectToRoute("blog_testdrives");
	}

}