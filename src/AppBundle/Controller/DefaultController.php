<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Topic;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        $topics = $this->getDoctrine()->getRepository(Topic::class);
        $rootTopics = array();
        foreach ($topics as $topic){
            if(empty($topic->getParentTopic())){
                array_push($rootTopics, $topic);
            }
        }
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'topics' => $rootTopics
        ]);
    }
}
