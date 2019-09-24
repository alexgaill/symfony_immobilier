<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Property;

class PropertyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        for ($i=0; $i < 20; $i++) { 
           $property = new Property();
           


           $property->setTitle(join($faker->words(3), " "))
                    ->setDescription(join($faker->paragraphs(2), " "))
                    ->setSurface(mt_rand(10,300));

            $rooms;
            $bedrooms;
            if ($property->getSurface() <= 20){
            $rooms=1;
            $bedrooms=0;
            }
            elseif ($property->getSurface() > 20 && $property->getSurface() <= 50){
            $rooms=2;
            $bedrooms=1;
            }
            elseif ($property->getSurface() > 50 && $property->getSurface() <= 70){
            $rooms=3;
            $bedrooms=2;
            }
            elseif ($property->getSurface() > 70 && $property->getSurface() <= 90){
            $rooms=4;
            $bedrooms=3;
            }
            elseif ($property->getSurface() > 90 && $property->getSurface() <= 110){
            $rooms=5;
            $bedrooms=4;
            }
            elseif ($property->getSurface() > 110 && $property->getSurface() <= 150){
            $rooms=6;
            $bedrooms=5;
            }
            elseif ($property->getSurface() > 150 && $property->getSurface() <= 300){
            $rooms=7;
            $bedrooms=6;
            }
            $property->setRooms($rooms)
                     ->setBedrooms($bedrooms)
                     ->setFloor(mt_rand(0,5))
                     ->setPrice(mt_rand(150000,2000000))
                     ->setHeat(mt_rand(0,1))
                     ->setCity($faker->city())
                     ->setAddress($faker->streetAddress())
                     ->setPostalCode($faker->postcode())
                     ->setCreatedAt($faker->dateTimeBetween('-6 months'));

            $manager->persist($property);
        }

        $manager->flush();
    }
}
