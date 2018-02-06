<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6.2.18
 * Time: 13:37
 */

namespace AppBundle\Service\Functionality;


use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserFunctionality extends Controller
{
    private $entityManager;
    public function __construct(EntityManager $entityManager){
        $this->entityManager = $entityManager;
    }
    public function addOrEditPost(User $user){
        $em = $this->entityManager;
        $em->persist($user);
        $em->flush();
    }
    public function removeUser(User $user){
        $em = $this->entityManager;
        $em->remove($user);
        $em->flush();
    }
    public function getAllUsers(){
        return $this->getDoctrine()->getRepository(User::class)->findAll();
    }
    public function getUserByID($id){
        if(empty($id)){
            return new User();
        }
        return $this->getDoctrine()->getRepository(User::class)->find($id);
    }
}