<?php

namespace App\Command;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;


#[AsCommand(name: 'app:create-articles')]
class CreateArticles extends Command {

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

	protected function configure(): void
    {
        $this
            ->setDescription('Creates a new article.')
            ->setHelp('This command allows you to create an article...')
            ->addArgument('title', InputArgument::REQUIRED, 'The title of the article')
            ->addArgument('content', InputArgument::REQUIRED, 'The content of the article')
            ->addArgument('author', InputArgument::REQUIRED, 'The author of the article');
    }

	protected function execute(InputInterface $input, OutputInterface $output): int {

        $title = $input->getArgument('title');
        $content = $input->getArgument('content');
        $author = $input->getArgument('author');

        $post = new Post();
        $post->setTitle(title: $title);
        $post->setContent(content: $content);
        $post->setAuthor(author: $author);
		$post->setPublishAt(publishat: new \DateTimeImmutable());

        $this->entityManager->persist(object: $post);
        $this->entityManager->flush();

        $output->writeln('✅ Article created successfully!');

		return Command::SUCCESS;
	}

}
