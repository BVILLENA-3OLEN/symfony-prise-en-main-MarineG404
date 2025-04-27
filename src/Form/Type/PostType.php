<?php

namespace App\Form\Type;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class PostType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options): void
	{
		$builder
			->add('title', type:TextType::class, options: [
				"label" => "Titre du post",
				"constraints" => [new NotBlank(), new Length(max : 100)],
				"attr" => [
					"class" => "form-control",
				]
			])
			->add('content', type:TextareaType::class, options:[
				"label" => "Contenu du post",
				"constraints" => [new NotBlank()],
				"attr" => [
					"class" => "form-control",
				]
			])
			->add('publishat', type:DateTimeType::class ,options: [
				'widget' => 'single_text',
				"label" => "Date de publication",
				"constraints" => [
					new NotNull(),
					new GreaterThan(value: new \DateTime("-1 month"))
				],
				"attr" => [
					"class" => "form-control",
				]
			])
			->add('author', type:TextType::class, options: [
				"label" => "Auteur",
				"attr" => [
					"class" => "form-control",
				]
			]);

		if ($builder->getDisabled()===false) {
			$builder->add("submit", type:SubmitType::class, options: [
				"label" => "Enregistrer",
				"attr" => [
					"class" => "btn btn-primary",
				],
			]);
		}
	}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
