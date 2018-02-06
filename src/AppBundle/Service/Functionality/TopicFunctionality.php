<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6.2.18
 * Time: 13:37
 */

namespace AppBundle\Service\Functionality;

use AppBundle\Entity\Topic;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TopicFunctionality extends Controller
{
    private $entityManager;
    public function __construct(EntityManager $entityManager){
        $this->entityManager = $entityManager;
    }
    public function addOrEditTopic($topic){
        $em = $this->entityManager;
        $em->persist($topic);
        $em->flush();
    }
    public function removeTopic(Topic $topic){
        $em = $this->entityManager;
        $em->remove($topic);
        $em->flush();
    }
    public function getAllTopics(){
        return $this->getDoctrine()->getRepository(Topic::class)->findAll();
    }
    public function getTopicByID($id){
        if(empty($id)){
            return new Topic();
        }
        return $this->getDoctrine()->getRepository(Topic::class)->find($id);
    }
}