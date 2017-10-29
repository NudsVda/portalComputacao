<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;

/**
 * Description of PostFindService
 *
 * @author eduardo - edu.ugolini2@gmail.com
 */
class PostFindService {
    
    private $em;
    
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function getPostsIdsByTitlePortion($titlePortion) {
        return $this->em->createQuery(
            'SELECT c.id '
            . 'FROM AppBundle:Comment c '
            . 'WHERE c.title LIKE :titlePortion '
                . 'AND c.comment IS NULL')
        ->setParameter('titlePortion', "%$titlePortion%")
        ->getArrayResult();
    }
    
}
