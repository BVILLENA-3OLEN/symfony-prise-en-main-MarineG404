<?php

declare(strict_types=1);

namespace App\Controller\Post\Create;

use App\Entity\Post;
use App\Form\Type\PostType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route (
	path: "/post/create",
	name: "app_post_create_post",
	methods: [Request::METHOD_POST],
)]
class PostCreatePostController extends AbstractController {
	public function __invoke(
		EntityManagerInterface $entityManager,
		Request $request,
	) : Response {
		$newPost = new Post();
		$form = $this->createForm(type: PostType::class, data: $newPost,
	);
		$form->handleRequest(request: $request);

		$entityManager->persist($newPost);
		$entityManager->flush();

		return $this->redirectToRoute("app_index_get");
	}
}
