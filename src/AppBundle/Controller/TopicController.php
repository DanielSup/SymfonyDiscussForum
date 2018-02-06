<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class TopicController extends Controller
{
    /**
     * @Route("/add_topic", name="add_topic")
     */
    public function newTopicAction(){

    }
    /**
     * @Route("/edit_topic/{id}", name="edit_topic")
     */
    public function editTopicAction($id){

    }
    /**
     * @Route("/get_posts/{id}", name="get_posts")
     */
    public function getPostsAction(Request $request,$id){

    }
    /**
     * @Route("/get_subtopics/{id}", name="get_subtopics")
     */
    public function getSubtopicsAction($id){

    }
}
