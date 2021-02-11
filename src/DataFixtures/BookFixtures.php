<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');        

        for ($i=0; $i <=10; $i++)
        {
            $book = new Book;
            $book->setName($faker->title());
            $book->setAuthor($faker->name());
            $book->setIsbn($faker->isbn13());
            $book->setQuantity($faker->randomDigitNotNull());
            $book->setCategory($faker->word());
            $book->setImage($faker->imageUrl());
            $book->setResume($faker->text());


            $manager->persist($book);
        
        };

        $manager->flush();
    }
}
