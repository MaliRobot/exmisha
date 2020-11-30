<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\News;
use App\Entity\Album;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $news = new News();
            $news->setCid($i+1);
            $news->setTitle($faker->words(5, true));
            $news->setText($faker->text());
            $news->setPublic($faker->boolean(90));
            $news->setLanguage($faker->randomElement(['eng', 'bhs']));
            $news->setDatePublished($faker->dateTime);
            $manager->persist($news);
        }

        for ($i = 0; $i < 10; $i++) {
            $event = new Event();
            $event->setCid($i+1);
            $event->setName($faker->words(5, true));
            $event->setDescription($faker->text());
            $event->setPublic($faker->boolean(90));
            $event->setAddress($faker->address);
            $event->setCity($faker->city);
            $event->setStart($faker->dateTime);
            $event->setEnd($faker->dateTime);
            $manager->persist($event);
        }

        for ($i = 0; $i < 10; $i++) {
            $album = new Album();
            $album->setCid($i+1);
            $album->setName($faker->words(3, true));
            $album->setArtist($faker->name);
            $album->setDescription($faker->text);
            $album->setCode($faker->postcode);
            $album->setImage($faker->imageUrl());
            $album->setPublic($faker->boolean(90));
            $album->setReleaseDate($faker->dateTime);
            $manager->persist($album);
        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
