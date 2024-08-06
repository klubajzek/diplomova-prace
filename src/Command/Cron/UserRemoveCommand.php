<?php

namespace App\Command\Cron;

use App\Entity\User\User;
use App\Model\Roles;
use App\Repository\User\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserRemoveCommand extends Command
{
    protected static $defaultName = 'user:deactivate-selected';
    protected static $defaultDescription = 'Deactivate users with today deactivated date.';

    public function __construct(private readonly EntityManagerInterface        $entityManager,
                                private readonly UserRepository                $userRepository)
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

        $today = new \DateTimeImmutable();
        $users = $this->userRepository->findForDeactivation($today);

        $count = 0;
        if ($users != null) {
            foreach ($users as $user) {
                $user->deactivate();
                $this->entityManager->persist($user);
                $count++;
            }
        }

        $this->entityManager->flush();

        $io->success($count . ' users has been deactivated.');

        return Command::SUCCESS;
    }
}