<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6.2.18
 * Time: 14:06
 */

namespace AppBundle\Service\Operation;


use AppBundle\Entity\Post;
use AppBundle\Entity\Topic;
use AppBundle\Entity\User;

class PostOperation
{
    private $postFunctionality;
    private $topicFunctionality;
    private $userFunctionality;
    public function __construct($postFunctionality, $topicFunctionality, $userFunctionality)
    {
        $this->postFunctionality = $postFunctionality;
        $this->topicFunctionality = $topicFunctionality;
        $this->userFunctionality = $userFunctionality;
    }

    /**
     * @return mixed
     */
    public function getPostFunctionality()
    {
        return $this->postFunctionality;
    }

    /**
     * @return mixed
     */
    public function getTopicFunctionality()
    {
        return $this->topicFunctionality;
    }

    /**
     * @return mixed
     */
    public function getUserFunctionality()
    {
        return $this->userFunctionality;
    }
    public function addUser(User $user){

    }
    public function editUser(User $user){

    }
    public function addPost(Post $post, Topic $topic, User $author){

    }
    public function editPost(Post $post, Topic $topic){

    }

    public function addTopic(Topic $topic, User $author){

    }
    public function editTopic(Topic $topic, User $author){

    }
    public function removePost($id){

    }
    public function removeUser($id){

    }
    public function removeTopic($id){

    }
}