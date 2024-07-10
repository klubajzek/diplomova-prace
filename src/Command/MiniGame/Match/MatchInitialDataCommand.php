<?php

namespace App\Command\MiniGame\Match;

use App\Entity\MiniGames\Match\MiniGameMatchAnswer;
use App\Entity\MiniGames\Match\MiniGameMatchQuestion;
use App\Repository\MiniGame\Match\MiniGameMatchQuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MatchInitialDataCommand extends Command
{
    protected static $defaultName = 'mini-game:match:initial-data';
    protected static $defaultDescription = 'Insert initial data for match mini-game.';

    public function __construct(private readonly EntityManagerInterface          $entityManager,
                                private readonly MiniGameMatchQuestionRepository $miniGameMatchQuestionRepository)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->success('Starting import of initial data for match mini-game.');

        for ($i = 0; $i < 20; $i++) {
            [$num1, $num2, $operation, $answer] = $this->createNumbers();

            while ($this->miniGameMatchQuestionRepository->findOneBy(['question' => "$num1 $operation $num2"])) {
                [$num1, $num2, $operation, $answer] = $this->createNumbers();
            }

            $answerEntity = new MiniGameMatchAnswer();
            $answerEntity
                ->setAnswer($answer);
            $question = new MiniGameMatchQuestion();
            $question
                ->setQuestion("$num1 $operation $num2")
                ->setMiniGameMatchAnswer($answerEntity);

            $this->entityManager->persist($answerEntity);
            $this->entityManager->persist($question);
        }

        $this->entityManager->flush();

        $io->success('Import of initial data for match mini-game was successful.');

        return Command::SUCCESS;
    }

    private function createNumbers(): array
    {
        $num1 = rand(1, 20);
        $num2 = rand(1, 20);
        $operation = rand(0, 1) ? '+' : '-';

        if ($num1 < $num2) {
            [$num1, $num2] = [$num2, $num1];
        }

        if ($operation === '+') {
            $answer = $num1 + $num2;
        } else {
            $answer = $num1 - $num2;
        }

        return [$num1, $num2, $operation, $answer];
    }
}