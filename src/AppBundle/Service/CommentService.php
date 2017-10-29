<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Comment;
use AppBundle\Entity\UserSystem;

/**
 * Description of CommentService
 *
 * @author eduardo - edu.ugolini2@gmail.com
 */
class CommentService {
    
    private $em;
    
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function getCommentObject($commentId) {
        return $this->em->getRepository(Comment::class)->find($commentId);
    }
    
    public function addNewPost(UserSystem $userSystem) : Comment {
        $now = new \DateTime('now');
        
        $post = new Comment();
        $post->setCreatedAt($now);
        $post->setOwner($userSystem);
        $post->setText('');
        
        $this->em->persist($post);
        $this->em->flush();
        
        return $post;
    }
    
    public function addPostContent(UserSystem $userSystem, Comment $post, string $content) {
        if ($post->getOwner() != $userSystem) {
            throw new \Exception('Postagem não pertence ao usuário', '403');
        }
        
        $post->setText($content);
        
        $this->em->persist($post);
        $this->em->flush();
    }
    
    public function addNewComment(Comment $post, UserSystem $userSystem, $text) : Comment {
        $now = new \DateTime('now');
        
        $comment = new Comment();
        $comment->setComment($post);
        $comment->setCreatedAt($now);
        $comment->setOwner($userSystem);
        $comment->setText($text);
        
        $this->em->persist($comment);
        $this->em->flush();
        
        return $comment;
    }
    
}
