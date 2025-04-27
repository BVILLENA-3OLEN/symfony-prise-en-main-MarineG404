<?php

declare(strict_types=1);

namespace App\Controller\Post\Create;

use App\Entity\Post;
use App\Enum\Entity\RoleEnum;
use App\Form\Type\PostType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route (
	path: "/post/create",
	name: "app_post_create_post",
	methods: [Request::METHOD_POST],
)]
#[IsGranted(
	attribute: RoleEnum::ADMIN->value
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
		if ($form->isSubmitted() && $form->isValid()){
			$entityManager->persist($newPost);
			$entityManager->flush();

			return $this->redirectToRoute("app_index_get");
		} else {
			return $this->render(
			view: "pages/post/create/post_create_form.html.twig",
			parameters:[
				"page_title" => 'Nouvel article',
				"form" => $form->createView(),
			],);
		}
	}
}
