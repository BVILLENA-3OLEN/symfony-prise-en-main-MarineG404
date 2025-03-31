<?php

declare(strict_types=1);

namespace App\Controller\Index;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route (
	path: "/",
	name: "app_index_get",
	methods: ["GET"]
)]
class IndexGetController extends AbstractController {

	public function __invoke() : Response {
		// return new Response(
		// 	content: "Hello World !",
		// 	status: Response::HTTP_OK,
		// );

		return $this->render(
			view: "pages/index/index.html.twig",
		);
	}
}
