<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Comment;

/**
 * Description of RankingController
 *
 * @author eduardo - edu.ugolini2@gmail.com
 * @Route("/votes")
 */
class RankingController extends Controller {
    
    /**
     * @Route("/getAmount/{comment}")
     * @ParamConverter("comment", class="AppBundle:Comment")
     */
    public function getCommentRankingVotesAmount(Comment $comment) {
        $rankingVotes = $this->get('ranking_service')->getRankingVotesAmountByComment($comment);
        
        return new JsonResponse($rankingVotes);
    }
    
    /**
     * @Route("/update/{action}/{comment}")
     * @ParamConverter("comment", class="AppBundle:Comment")
     */
    public function updateRankingVotes($action, Comment $comment) {
        $userSystem = $this->get('user_data_service')->getLoggedUser($this->getUser());
        
        switch ($action) {
            case 'add':
                $userSystem->addComment($comment);
                break;
            case 'remove':
                $userSystem->removeComment($comment);
                break;
            default:
                throw new \Exception('Commando ' . $action . ' desconhecido!', 400);
        }
        
        $this->getDoctrine()->getManager()->flush();
        
        return new Response();
    }
    
}
