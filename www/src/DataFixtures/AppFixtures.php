<?php
namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $this->loadUsers( $manager );
    }

    private function loadUsers(ObjectManager $manager)
    {
        $user = new User();

        $user->setEmail('john@domain.com');
        $user->setFullName('John Snow');
        $user->setPassword(
            $this->passwordEncoder->encodePassword( $user, 'John01!' )
        );

        $manager->persist( $user );
        $manager->flush();
    }
}