<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use App\Enum\Entity\RoleEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture{

	public function __construct(private UserPasswordHasherInterface $passwordHasher
	) {}
	public function load(ObjectManager $manager): void
	{
		$adminRole = new Role();
		$adminRole
			->setCode(RoleEnum::ADMIN->value)
			->setLabel("Administrateur");
		$manager->persist($adminRole);

		$userRole = new Role();
		$userRole
			->setCode(RoleEnum::USER->value)
			->setLabel("Utilisateur");
		$manager->persist($userRole);

		$admin = new User();
		$admin
			->setName("admin")
			->setEmail("marineg1515@gmail.com")
			->setPassword($this->passwordHasher->hashPassword($admin, "admin"))
			->setRole($adminRole);
		$manager->persist($admin);

		$manager->flush();
	}
}
