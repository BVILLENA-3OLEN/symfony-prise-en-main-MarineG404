<?php

declare(strict_types=1);

namespace App\Controller\Post\Create;

use App\Form\Type\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route (
	path: "/post/create",
	name: "app_post_create_get",
	methods: [Request::METHOD_GET],
)]
class PostCreateGetController extends AbstractController {
	public function __invoke() : Response {
		$form = $this->createForm(type: PostType::class);
		return $this->render(
			view: "pages/post/create/post_create_form.html.twig",
			parameters:[
                "page_title" => 'Nouvel article',
				"form" => $form->createView(),
			],
		);
	}
}
