<?php

declare(strict_types=1);

namespace App\Controller\Post\Show;

use App\Entity\Post;
use App\Form\Type\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route (
	path: "/post/{id}/show",
	name: "app_post_show_post",
	methods: [Request::METHOD_GET],
)]
class PostShowGetController extends AbstractController {
	public function __invoke(
		Post $post
	) : Response {
		$form = $this->createForm(
			type: PostType::class,
			data: $post,
			options: [
				"disabled" => true
			]
			);
		return $this->render(
		view: "pages/post/create/post_create_form.html.twig",
		parameters:[
			"page_title" => 'Nouvel article',
			"form" => $form->createView(),
		],);

	}
}

