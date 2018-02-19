<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User
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
     * @ORM\Column(name="username", type="string", length=100)
     */
    private $username;
    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=100)
     */
    private $password;
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=180)
     */
    private $email;
    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="author")
     */
    private $posts;
    /**
     * @ORM\OneToMany(targetEntity="Topic", mappedBy="author")
     */
    private $topics;


    public function __construct()
    {
        $this->topics = new ArrayCollection();
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
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
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
    public function getTopics()
    {
        return $this->topics;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function addPost(Post $post){
        $this->posts->add($post);
    }
    public function removePost(Post $post){
        $this->posts->removeElement($post);
    }
    public function addTopic(Topic $topic){
        $this->topics->add($topic);
    }
    public function removeTopic(Topic $topic){
        $this->topics->removeElement($topic);
    }
}

