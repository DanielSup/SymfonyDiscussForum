<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19.2.18
 * Time: 11:38
 */

namespace AppBundle\Security;


use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class PostVoter extends Voter
{

    public function mapOfAttributes($subject){
        return array(empty($subject) => array("homepage", "add_topic"),
            $subject instanceof Topic => array("edit_topic","subtopics"));
    }
    /**
     * Determines if the attribute and subject are supported by this voter.
     *
     * @param string $attribute An attribute
     * @param mixed $subject The subject to secure, e.g. an object the user wants to access or any other PHP type
     *
     * @return bool True if the attribute and subject are supported, false otherwise
     */
    protected function supports($attribute, $subject)
    {

        $map = $this->mapOfAttributes($subject);
        foreach($map as $key => $value){
            if($key == true && in_array($attribute, $value)){
                return true;
            }
        }
        return false;
    }

    /**
     * Perform a single access check operation on a given attribute, subject and token.
     * It is safe to assume that $attribute and $subject already passed the "supports()" method check.
     *
     * @param string $attribute
     * @param mixed $subject
     * @param TokenInterface $token
     *
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        if($this->supports($attribute, $subject)){
            return false;
        }
        switch($subject){
            case "homepage":
                return true;
            case "view_topic":
                return true;
            case "subtopics":
                return true;
        }
        $user = $token->getUser();
        if(!$user instanceof User){
            return false;
        }
        switch($subject){
            case "add_topic":
                return true;
            case "edit_topic":
                return true;
        }
        return false;
    }
}