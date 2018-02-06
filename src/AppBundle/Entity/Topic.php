<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Topic
 *
 * @ORM\Table(name="topic")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TopicRepository")
 */
class Topic
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=150)
     */
    private $title;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string")
     */
    private $description;
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="topics")
     */
    private $author;
    /**
     * @ORM\ManyToOne(targetEntity="Topic", inversedBy="subtopics")
     */
    private $parentTopic;
    /**
     * @ORM\OneToMany(targetEntity="Topic", mappedBy="parentTopic")
     */
    private $subtopics;
    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="topic")
     */
    private $posts;

    public function __construct()
    {
        $this->subtopics = new ArrayCollection();
        $this->posts = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getParentTopic()
    {
        return $this->parentTopic;
    }

    /**
     * @return mixed
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @return mixed
     */
    public function getSubtopics()
    {
        return $this->subtopics;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param mixed $parentTopic
     */
    public function setParentTopic($parentTopic)
    {
        $this->parentTopic = $parentTopic;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function addSubtopic(Topic $topic){
        $this->subtopics->add($topic);
    }
    public function removeSubtopic(Topic $topic){
        $this->subtopics->removeElement($topic);
    }
    public function addPost(Post $post){
        $this->posts->add($post);
    }
    public function removePost(Post $post){
        $this->posts->removeElement($post);
    }

}

