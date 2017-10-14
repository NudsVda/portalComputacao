<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Comment;

/**
 * Description of RankingService
 *
 * @author eduardo - edu.ugolini2@gmail.com
 */
class RankingService {
    
    private $em;
    
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function getRankingVotesAmountByComment(Comment $comment) {
        $rankingAmount = $this->em->createQuery(
                'SELECT COUNT(us) '
                . 'FROM AppBundle:Comment c '
                . 'JOIN c.userSystem us '
                . 'WHERE c = :comment')
                ->setParameter('comment', $comment)
                ->getOneOrNullResult();
        
        return reset($rankingAmount);        
    }
    
}
