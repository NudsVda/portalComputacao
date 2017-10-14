<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\UserSystem;

/**
 * Description of CommentsController
 *
 * @author eduardo - edu.ugolini2@gmail.com
 */
class CommentsController extends Controller {
     
    /**
     * @Route("/addPost")
     */
    public function addPost() {
        $userSystem = $this->getLoggedUser();
        
        $post = $this->get('comment_service')->addNewPost($userSystem);
        
        return new JsonResponse([
            'id' => $post->getId()
        ]);
    }
    
    /**
     * @Route("/addComment/{postId}")
     * @Method({"POST"})
     */
    public function addComment(Request $request, $postId) {
        $text = $request->get('text');
        $userSystem = $this->getLoggedUser();
        
        $post = $this->get('comment_service')->getCommentObject($postId);
        
        $comment = $this->get('comment_service')->addNewComment($post, $userSystem, $text);
        
        return new JsonResponse([
            'id' => $comment->getId()
        ]);
    }
    
    private function getLoggedUser() : UserSystem {
        $user = $this->getUser();
        
        if (! isset($user)) {
            throw new \Exception('Você precisa estar logado para adicionar novas postagens', 403);
        }
        
        return $this->getDoctrine()->getManager()->getRepository(UserSystem::class)->find($user->getId());
    }
}
