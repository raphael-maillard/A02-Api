<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CustomerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');        

        for ($i=0; $i <=10; $i++)
        {
            $customer = new Customer;
            $customer->setFirstname($faker->name());
            $customer->setLastname($faker->lastName());

            $manager->persist($customer);
        
        };

        $manager->flush();
    }
}
