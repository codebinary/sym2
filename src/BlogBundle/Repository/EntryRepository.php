<?php 
namespace BlogBundle\Repository;

use BlogBundle\Entity\Contacto;
use \Doctrine\ORM\Tools\Pagination\Paginator;

class EntryRepository extends \Doctrine\ORM\EntityRepository{

	public function getPaginateEntries($pageSize = 5, $currentPage = 1){

		//Utilizamos dql
		$em = $this->getEntityManager();

		$dql = "SELECT c FROM BlogBundle\Entity\Contacto c ORDER BY c.id DESC";

		$query = $em->createQuery($dql)
					->setFirstResult($pageSize * ($currentPage - 1))
					->setMaxResults($pageSize);

		$paginator = new Paginator($query, $fetchJoinCollection = true);

		return $paginator;

	}


}