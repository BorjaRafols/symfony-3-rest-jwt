<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository {
    
    public function findAllOrderedByName() {
        
        return $this->getEntityManager()->createQuery(
            'SELECT p from AppBundle:Product p ORDER BY p.name ASC'
        )
        ->getResult();
        
    }
    
}

