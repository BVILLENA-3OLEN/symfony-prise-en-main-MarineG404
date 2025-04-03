<?php

declare(strict_types=1);

namespace App\Controller\Index;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

#[Route (
	path: "/",
	name: "app_index_get",
	methods: ["GET"]
)]
class IndexGetController extends AbstractController {

	public function __invoke(
		PostRepository $postRepository,
		#[MapQueryParameter]
		?string $name = null,
	) : Response {
		$allPosts = $postRepository->getAllPublished();
		dump($allPosts);
		return $this->render(
			view: "pages/index/index.html.twig",
			parameters:[
				"name" => $name,
				"posts" => $allPosts,
			],
		);
	}
}
