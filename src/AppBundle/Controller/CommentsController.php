<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

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
        $userSystem = $this->get('user_data_service')->getLoggedUser($this->getUser());
        
        $post = $this->get('comment_service')->addNewPost($userSystem);
        
        return new JsonResponse([
            'id' => $post->getId()
        ]);
    }
    
    /**
     * @Route("/addPostContent")
     */
    public function addPostContent(Request $request) {
        $userSystem = $this->get('user_data_service')->getLoggedUser($this->getUser());
        
        $postId = $request->get('postId');
        $content = $request->get('content');
        
        $this->get('comment_service')->addPostContent($userSystem, $postId, $content);
    }
    
    /**
     * @Route("/addComment/{postId}")
     * @Method({"POST"})
     */
    public function addComment(Request $request, $postId) {
        $text = $request->get('text');
        $userSystem = $this->get('user_data_service')->getLoggedUser($this->getUser());
        
        $post = $this->get('comment_service')->getCommentObject($postId);
        
        $comment = $this->get('comment_service')->addNewComment($post, $userSystem, $text);
        
        return new JsonResponse([
            'id' => $comment->getId()
        ]);
    }
}
