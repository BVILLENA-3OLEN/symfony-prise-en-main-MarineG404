<?php

declare(strict_types=1);

namespace App\Enum\Entity;

enum RoleEnum: string
{
	case USER = "ROLE_USER";
	case ADMIN = "ROLE_ADMIN";

	public function getLabel(): string
	{
		return match ($this) {
			self::USER => "Utilisateur",
			self::ADMIN => "Administrateur",
		};
	}

}
