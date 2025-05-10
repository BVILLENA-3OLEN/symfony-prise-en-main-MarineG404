<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager): void {

		$faker = Factory::create(locale: 'fr_FR');
		for ($i = 0; $i < 20; $i++) {
			$post = new Post();
			$post
				->setTitle(title: $faker->realTextBetween(minNbChars: 10, maxNbChars: 50))
				->setContent(content: $faker->realText())
				->setAuthor(author: $faker->name())
				->setPublishat(
					publishat: \DateTimeImmutable::createFromMutable(
						object: $faker->dateTimeBetween(startDate: '-20 days', endDate: '+5 days')
					)
				);

			$manager->persist(object: $post);
		}

		$manager->flush();
    }
}
