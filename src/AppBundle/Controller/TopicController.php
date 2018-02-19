<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use AppBundle\Entity\Topic;
use AppBundle\Form\TopicType;
use AppBundle\Service\Operation\PostOperation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class TopicController extends Controller
{
    private $postOperation;
    public function __construct(PostOperation $postOperation){
        $this->postOperation = $postOperation;
    }
    /**
     * @Route("/add_topic", name="add_topic")
     */
    public function newTopicAction(Request $request){
        $form = $this->createForm(TopicType::class, new Topic())->add('Přidat téma', SubmitType::class);
        if($form->isSubmitted() && $form->isValid()){
            $topic = $form->getData();
            $this->postOperation->addTopic($topic, $this->getUser());
        }
        return $this->render('topic/add.html.twig', ['form' => $form->createView(),
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("/edit_topic/{id}", name="edit_topic")
     */
    public function editTopicAction($id){
        $topic =  $this->postOperation->getTopicFunctionality()->getTopicByID($id);
        $form = $this->createForm(TopicType::class, $topic)->add('Upravit téma', SubmitType::class);
        $parentTopics = array();
        $actualTopic = $topic;
        while(!empty($actualTopic)){
            $actualTopic = $actualTopic->getParentTopic();
            if(!empty($actualTopic)){
                array_push($parentTopics, $actualTopic);
            }
        }
        if($form->isSubmitted() && $form->isValid()){
            $topic = $form->getData();
            $this->postOperation->editTopic($topic);
        }
        return $this->render('topic/edit.html.twig', ['form' => $form->createView(),
            'parentTopics' => $parentTopics,
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("/get_posts/{id}", name="get_posts")
     */
    public function getPostsAction(Request $request, $id){
        $topic =  $this->postOperation->getTopicFunctionality()->getTopicByID($id);
        $form = $this->createForm(Post::class, new Post())->add('Přidat příspěvek', SubmitType::class);
        $parentTopics = array();
        $actualTopic = $topic;
        while(!empty($actualTopic)){
            $actualTopic = $actualTopic->getParentTopic();
            if(!empty($actualTopic)){
                array_push($parentTopics, $actualTopic);
            }
        }
        if($form->isSubmitted() && $form->isValid()){
            $post = $form->getData();
            $this->postOperation->addPost($post, $topic, $this->getUser());
        }
        $posts = $topic->getPosts();
        return $this->render('topic/view.html.twig', ['form' => $form->createView(),
            'parentTopics' => $parentTopics,
            'posts' => $posts,
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("/get_subtopics/{id}", name="get_subtopics")
     */
    public function getSubtopicsAction($id){
        $topic =  $this->postOperation->getTopicFunctionality()->getTopicByID($id);
        $parentTopics = array();
        $actualTopic = $topic;
        while(!empty($actualTopic)){
            $actualTopic = $actualTopic->getParentTopic();
            if(!empty($actualTopic)){
                array_push($parentTopics, $actualTopic);
            }
        }
        $subtopics = $topic->getSubtopics();
        return $this->render('topic/view.html.twig', [
            'parentTopics' => $parentTopics,
            'subtopics' => $subtopics,
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}
