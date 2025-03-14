<?php

namespace App\Command;

use App\Entity\Admin\Utilisateur;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateArchitectCommand extends Command
{
    private $em;

    private $passwordEncoder;

    private $validator;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em, ValidatorInterface $validator)
    {
        $this->em = $em;
        $this->passwordEncoder = $passwordEncoder;
        $this->validator = $validator;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('app:create-architect')
            ->setDescription('Création de compte architect.')
            ->setDefinition(array(
                new InputArgument('username', InputArgument::REQUIRED, 'The username'),
                new InputArgument('email', InputArgument::REQUIRED, 'The email'),
                new InputArgument('password', InputArgument::REQUIRED, 'The password'),
            ))
            ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $architect = new Utilisateur();

        $username = $input->getArgument('username');

        $email = $input->getArgument('email');

        $password = $input->getArgument('password');
        $password = $this->passwordEncoder->encodePassword($architect, $password);

        $architect->setUsername($username);
        $architect->setEmail($email);
        $architect->setPassword($password);

        $errors = $this->validator->validate($architect);

        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            throw new \Exception($errorsString);
        }


        $this->em->persist($architect);
        $this->em->flush();

        $output->writeln(sprintf('Created architect %s', $username));
    }

    /**
     * {@inheritdoc}
     */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        $questions = array();

        if (!$input->getArgument('username')) {
            $question = new Question('Choisir un pseudo :');
            $questions['username'] = $question;
        }

        if (!$input->getArgument('email')) {
            $question = new Question('Votre adresse mail :');
            $questions['email'] = $question;
        }

        if (!$input->getArgument('password')) {
            $question = new Question('Choisir un mot de passe:');
            $question->setHidden(true);
            $question->setHiddenFallback(false);
            $questions['password'] = $question;
        }

        foreach ($questions as $name => $question) {
            $answer = $this->getHelper('question')->ask($input, $output, $question);
            $input->setArgument($name, $answer);
        }
    }
}
