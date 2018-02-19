<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6.2.18
 * Time: 13:38
 */

namespace AppBundle\Service\Functionality;


use AppBundle\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PostFunctionality extends Controller
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }
    public function addOrEditPost(Post $post){
        $em = $this->entityManager;
        $em->persist($post);
        $em->flush();
    }
    public function removePost(Post $post){
        $em = $this->entityManager;
        $em->remove($post);
        $em->flush();
    }
    public function getAllPosts(){
        return $this->getDoctrine()->getRepository(Post::class)->findAll();
    }
    public function getPostByID($id){
        if(empty($id)){
            return new Post();
        }
        return $this->getDoctrine()->getRepository(Post::class)->find($id);
    }
}