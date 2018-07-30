<?php
namespace App\Security;

use App\Entity\PrintOrder;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class PrintOrderVoter extends Voter
{
    const EDIT   = 'edit';
    const DELETE = 'delete';

    /**
     * @param string $attribute
     * @param mixed $subject
     * @return bool
     */
    protected function supports($attribute, $subject)
    {
        if( !in_array($attribute, [ self::EDIT, self::DELETE ]) )
        {
            return false;
        }

        if( ! $subject instanceof PrintOrder )
        {
            return false;
        }

        return true;
    }

    /**
     * @param string $attribute
     * @param mixed $subject
     * @param TokenInterface $token
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $authenticatedUser = $token->getUser();

        if( ! $authenticatedUser instanceof User )
        {
            return false;
        }

        /** @var \App\Entity\PrintOrder $printOrder */
        $printOrder = $subject;

        return $printOrder->getUser()->getId() === $authenticatedUser->getId();
    }
}