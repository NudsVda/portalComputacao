<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of PostFindController
 *
 * @author eduardo - edu.ugolini2@gmail.com
 */
class PostFindController extends Controller {
    
    /**
     * @Route("/getPostsIdsByTitle")
     * @Method({"POST"})
     */
    public function getPostsIdsByTitle(Request $request) {
        $titlePortion = $request->get('titlePortion');
        
        $postsIds = $this->get('post_find_service')->getPostsIdsByTitlePortion($titlePortion);
        
        return new JsonResponse($postsIds);
    }
    
}
