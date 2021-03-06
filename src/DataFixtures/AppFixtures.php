<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Chalet;
use App\Entity\Picture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture

{
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {

        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $admin = new User;
        $password = $this->encoder->hashPassword($admin, 'password');
        $admin->setFirstName($faker->firstName())
            ->setLastName($faker->lastName())
            ->setEmail('admin@agence.com')
            ->setPassword($password)
            ->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $users = [];
        for ($u = 1; $u < 10; $u++) {
            $user = new User;

            $user->setFirstName($faker->firstName())
                ->setLastName($faker->lastName())
                ->setEmail($faker->email())
                ->setPassword($password);

            $manager->persist($user);
            $users[] = $user;
        }




        for ($c = 1; $c < 10; $c++) {
            $chalet = new Chalet;
            $chalet->setName("Chalet $c")
                ->setDescription($faker->paragraph())
                ->setCoverImage("$c.jpg")
                ->setBedrooms(mt_rand(4, 10))
                ->setBathrooms(mt_rand(4, 8))
                ->setPrice(mt_rand(10000, 50000));

            for ($p = 1; $p <= mt_rand(2, 5); $p++) {
                $picture = new Picture();

                $picture->setUrl(mt_rand(1, 10) . '.jpg')
                    ->setCaption($faker->sentence())
                    ->setChalet($chalet);

                $manager->persist($picture);
            }


            $manager->persist($chalet);
        }

        $manager->flush();
    }
}
