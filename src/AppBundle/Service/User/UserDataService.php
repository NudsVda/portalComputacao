<?php

namespace AppBundle\Service\User;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\UserSystem;

/**
 * Description of UserDataService
 *
 * @author eduardo - edu.ugolini2@gmail.com
 */
class UserDataService {
    
    private $em;
    
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function getLoggedUser($user) : UserSystem {
        if (! isset($user)) {
            throw new \Exception('Você precisa estar logado para adicionar novas postagens', 403);
        }
        
        return $this->em->getRepository(UserSystem::class)->find($user->getId());
    }
    
}
