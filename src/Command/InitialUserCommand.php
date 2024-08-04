<?php

namespace App\Command;

use App\Entity\User\User;
use App\Repository\User\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class InitialUserCommand extends Command
{
    protected static $defaultName = 'app:initial-user';
    protected static $defaultDescription = 'Creates initial user for application.';

    public function __construct(private readonly EntityManagerInterface        $entityManager,
                                private readonly UserRepository                $userRepository,
                                private readonly UserPasswordHasherInterface    $passwordHasher)
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

        $user = $this->userRepository->findOneBy(['nickname' => 'admin']);

        if ($user != null) {
            $io->error('User with nickname "admin" exist.');
            return Command::FAILURE;
        }

        $user = new User();
        $user
            ->setNickname('admin')
            ->setEmail('urbanja1@uhk.cz')
            ->setRoles(['ROLE_ADMIN'])
            ->setIsVerified(true)
            ->setName('Admin')
            ->setSurname('Admin');

        $user->setPassword($this->passwordHasher->hashPassword($user, 'admin'));

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $io->success('User with nickname "admin" and password "admin" was successfully created.');

        return Command::SUCCESS;
    }
}