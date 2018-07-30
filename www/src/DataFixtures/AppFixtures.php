<?php
namespace App\DataFixtures;

use App\Entity\PrintOrder;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker\Factory as Faker;

class AppFixtures extends Fixture
{
    private $faker;
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->faker = Faker::create();
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $this->loadUsers( $manager );
        $this->loadPrintOrders( $manager );
    }

    private function loadUsers(ObjectManager $manager)
    {
        $user = new User();

        $user->setEmail('john@domain.com');
        $user->setFullName('John Snow');
        $user->setPassword(
            $this->passwordEncoder->encodePassword( $user, 'John01!' )
        );

        $this->addReference('user-john', $user);

        $manager->persist( $user );
        $manager->flush();
    }

    private function loadPrintOrders(ObjectManager $manager)
    {
        for( $i = 0; $i < 100; $i++ )
        {
            $order = new PrintOrder();

            $order->setTitle( substr( $this->faker->sentence(rand(2, 3)), 0, -1) );
            $order->setColor( substr( $this->faker->hexcolor, 1 ) );
            $order->setPolish( rand(0, 1) );
            $order->setWidth( rand(50, 500) );
            $order->setHeight( rand(50, 500) );
            $order->setCreateDate( $this->faker->dateTimeBetween('-2 years') );
            $order->setUser( $this->getReference('user-john') );

            $manager->persist($order);
        }

        $manager->flush();
    }
}