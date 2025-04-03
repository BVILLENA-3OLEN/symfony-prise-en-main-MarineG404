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

class PostType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options): void
	{
		$builder
			->add('title', type:TextType::class, options: [
				"label" => "Titre du post",
				"attr" => [
					"class" => "form-control",
				]
			])
			->add('content', type:TextareaType::class, options:[
				"label" => "Contenu du post",
				"attr" => [
					"class" => "form-control",
				]
			])
			->add('publishat', type:DateTimeType::class ,options: [
				'widget' => 'single_text',
				"label" => "Date de publication",
				"attr" => [
					"class" => "form-control",
				]
			])
			->add('author', type:TextType::class, options: [
				"label" => "Auteur",
				"attr" => [
					"class" => "form-control",
				]
			])
			->add("submit", type:SubmitType::class, options: [
				"label" => "Enregistrer",
				"attr" => [
					"class" => "btn btn-primary",
				],
			])
		;
	}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
