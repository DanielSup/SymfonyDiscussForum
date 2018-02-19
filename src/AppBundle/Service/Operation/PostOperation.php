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
use AppBundle\Service\Functionality\PostFunctionality;
use AppBundle\Service\Functionality\TopicFunctionality;
use AppBundle\Service\Functionality\UserFunctionality;

class PostOperation
{
    private $postFunctionality;
    private $topicFunctionality;
    private $userFunctionality;
    public function __construct(PostFunctionality $postFunctionality, TopicFunctionality $topicFunctionality,
                                UserFunctionality $userFunctionality)
    {
        $this->postFunctionality = $postFunctionality;
        $this->topicFunctionality = $topicFunctionality;
        $this->userFunctionality = $userFunctionality;
    }

    /**
     * @return PostFunctionality
     */
    public function getPostFunctionality()
    {
        return $this->postFunctionality;
    }

    /**
     * @return TopicFunctionality
     */
    public function getTopicFunctionality()
    {
        return $this->topicFunctionality;
    }

    /**
     * @return UserFunctionality
     */
    public function getUserFunctionality()
    {
        return $this->userFunctionality;
    }

    public function addUser(User $user){
        $this->getUserFunctionality()->addOrEditUser($user);
    }
    public function editUser(User $user){
        $this->getUserFunctionality()->addOrEditUser($user);
    }
    public function addPost(Post $post, Topic $topic, User $author){
        $this->postFunctionality->addOrEditPost($post);
        $author->addPost($post);
        $topic->addPost($post);
        $this->userFunctionality->addOrEditUser($author);
        $this->topicFunctionality->addOrEditTopic($topic);
    }
    public function editPost(Post $post, Topic $topic){
        $newTopic = $post->getTopic();
        $topic->removePost($post);
        $newTopic->addPost($post);
        $this->postFunctionality->addOrEditPost($post);
        $this->topicFunctionality->addOrEditTopic($topic);
        $this->topicFunctionality->addOrEditTopic($newTopic);
    }

    public function addTopic(Topic $topic, User $author){
        $this->topicFunctionality->addOrEditTopic($topic);
        $author->addTopic($topic);
        $this->userFunctionality->addOrEditUser($author);
    }
    public function editTopic(Topic $topic){
        $this->topicFunctionality->addOrEditTopic($topic);
    }
    public function removePost(Post $post){
        $post->getAuthor()->removePost($post);
        $post->getTopic()->removePost($post);
        $this->postFunctionality->removePost($post);
        $this->userFunctionality->addOrEditUser($post->getAuthor());
        $this->topicFunctionality->addOrEditTopic($post->getTopic());
    }
    public function removeUser(User $user){
        $topics = $user->getTopics();
        foreach ($topics as $topic){
            $this->removeTopic($topic);
        }
        $this->userFunctionality->removeUser($user);
    }
    public function removeTopic(Topic $topic){
        $subtopics = $topic->getSubtopics();
        foreach($subtopics as $subtopic){
            $this->removeTopic($subtopic);
        }
        $posts = $topic->getPosts();
        foreach($posts as $post){
            $this->removePost($post);
        }
        $this->topicFunctionality->removeTopic($topic);
    }
}