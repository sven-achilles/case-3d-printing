<?php
namespace App\DataFixtures;

use App\Entity\PrintOrder;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker\Factory as Faker;

class AppFixtures extends Fixture implements ContainerAwareInterface
{
    private $faker;
    private $passwordEncoder;
    private $container;

    const MATERIALS = [
        PrintOrder::MATERIAL_SAND_STONE,
        PrintOrder::MATERIAL_ALUMINUM,
        PrintOrder::MATERIAL_FINE_PLASTIC,
        PrintOrder::MATERIAL_PLASTIC
    ];

    const FINISH = [
        PrintOrder::FINISH_NONE,
        PrintOrder::FINISH_BRASS,
        PrintOrder::FINISH_BRONZE,
        PrintOrder::FINISH_GOLD,
        PrintOrder::FINISH_SILVER,
        PrintOrder::FINISH_PLATINUM,
        PrintOrder::FINISH_PLASTIC
    ];

    private const USERS = [
        [
            'email'    => 'john@domain.com',
            'fullname' => 'John Snow',
            'password' => 'Welkom01!'
        ]
    ];

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->faker = Faker::create();
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $users = $this->getDummyUsersData();

        $this->cleanDesignsUploadFolder();
        $this->loadUsers( $manager, $users );
        $this->loadPrintOrders( $manager, $users );
    }

    private function loadUsers(ObjectManager $manager, $users)
    {
        foreach( $users as $user_data ) {
            $user = new User();

            $user->setEmail( $user_data['email'] );
            $user->setFullName( $user_data['fullname'] );
            $user->setPassword(
                $this->passwordEncoder->encodePassword( $user, $user_data['password'] )
            );

            $this->addReference( $this->convertToReferenceName( $user_data['fullname'] ), $user);

            $manager->persist( $user );
        }

        $manager->flush();
    }

    private function loadPrintOrders(ObjectManager $manager, $users)
    {
        for( $i = 0; $i < 100; $i++ )
        {
            $order = new PrintOrder();

            $order->setTitle( substr( $this->faker->sentence(rand(2, 3)), 0, -1) );
            $order->setColor( $this->faker->hexcolor, 1 );
            $order->setMaterial( self::MATERIALS[ count(self::MATERIALS) - 1 ] );
            $order->setMaterial( self::FINISH[ count(self::FINISH) - 1 ] );
            $order->setPolish( rand(0, 1) );
            $order->setWidth( rand(50, 500) );
            $order->setHeight( rand(50, 500) );
            $order->setCreateDate( $this->faker->dateTimeBetween('-2 years') );
            $order->setUser( $this->getReference( $this->convertToReferenceName( $users[ rand( 0, count($users) - 1 ) ]['fullname'] ) ) );

            $manager->persist($order);
        }

        $manager->flush();
    }

    private function getDummyUsersData()
    {
        $users = [];

        for( $i = 0; $i < 10; $i++ )
        {
            $users[] = [
                'email'    => $this->faker->email,
                'fullname' => $this->faker->name,
                'password' => 'Welkom01!'
            ];
        }

        return array_merge( self::USERS, $users );
    }

    private function convertToReferenceName( $name ) {
        return preg_replace('/\s+|\.+/', '-', strtolower( $name ) );
    }

    private function cleanDesignsUploadFolder()
    {
        $files = glob($this->container->getParameter('designs_directory') . "/*.stl");

        foreach( $files as $file )
        {
            if( is_file( $file ) )
            {
                @unlink($file);
            }
        }
    }

    private function copyDummy3DFiles()
    {
    
    }

    /**
     * @param ContainerInterface|null $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}