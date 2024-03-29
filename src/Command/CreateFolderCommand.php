<?php

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'CreateFolderCommand',
    description: 'Add a short description for your command',
)]
class CreateFolderCommand extends Command
{
    public const CONTROLLER = 'Controller';
    public const ENTITY = 'Entity';
    public const DTO = 'DTO';
    public const FORM = 'Form';
    public const SERVICE = 'Service';
    public const REPOSITORY = 'Repository';
    public const MESSAGE = 'Message';
    public const MESSAGEHANDLER = 'MessageHandler';
    public const EVENTSUBSCRIBER = 'EventSubscriber';




    public function __construct()
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::REQUIRED, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');
        $subFolders = [
            self::CONTROLLER, 
            self::ENTITY, 
            self::DTO, 
            self::SERVICE, 
            self::REPOSITORY, 
            self::MESSAGE, 
            self::MESSAGEHANDLER, 
            self::FORM, 
            self::EVENTSUBSCRIBER
        
        ];

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }


        $folderName = $arg1; // Change this to the desired folder name
        $srcDir = __DIR__ . '/../'; // Assuming the src directory is at the root level of your projec

        // dd($srcDir);
        // Check if the folder already exists
        if (is_dir($srcDir . $folderName)) {
            $output->writeln('The folder already exists.');
            return Command::FAILURE;
        }

        // Create the folder
        if (mkdir($srcDir . $folderName)) {
            $output->writeln('Folder created successfully.');

            foreach ($subFolders as $subFolder) {
                $subFolderPath = $srcDir . $folderName . '/' . $subFolder;
                if (!mkdir($subFolderPath)) {
                    $output->writeln('Failed to create subFolder$subFolders: ' . $subFolder);
                    return Command::FAILURE;
                }

                // Create PHP class file
                $fileName = $folderName . $subFolder . '.php';
                $classFilePath = $subFolderPath . '/' . $fileName;
                $className = $folderName . $subFolder;
                $classContent =$this->getClassContent($folderName,$subFolder,$className);
                if (!file_put_contents($classFilePath, $classContent)) {
                    $output->writeln('Failed to create class file: ' . $fileName);
                    return Command::FAILURE;
                }
            }
            return Command::SUCCESS;
        } else {
            $output->writeln('Failed to create folder.');
            return Command::FAILURE;
        }
    }

    private function getClassContent(string $folderName, string $subFolder, string $className): string
    {

        $val = match ($subFolder) {
            Self::CONTROLLER => $this->controllerContent($folderName,$subFolder, $className),
            Self::ENTITY => $this->normalFileContent($folderName,$subFolder, $className),
            Self::FORM => $this->normalFileContent($folderName,$subFolder, $className),
            Self::SERVICE => $this->normalFileContent($folderName,$subFolder, $className),
            Self::REPOSITORY => $this->normalFileContent($folderName,$subFolder, $className),
            Self::MESSAGE => $this->normalFileContent($folderName,$subFolder, $className),
            Self::MESSAGEHANDLER => $this->normalFileContent($folderName,$subFolder, $className),
            Self::EVENTSUBSCRIBER => $this->normalFileContent($folderName,$subFolder, $className),
            Self::DTO => $this->normalFileContent($folderName,$subFolder, $className),
            default => $this->normalFileContent($folderName,$subFolder, $className),
        };
    

        return $val;
    }

    private function controllerContent(string $folderName, string $subFolder, string $className): string
    {
        return
            <<<EOD
                <?php

                declare(strict_types=1);

                namespace App\\$folderName\\$subFolder;

                use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
                use Symfony\Component\HttpFoundation\Response;
                use Symfony\Component\Routing\Annotation\Route;
                use Symfony\Component\Security\Http\Attribute\IsGranted;

                class $className extends AbstractController
                    {
                        #[Route(''), IsGranted('ROLE_USER')]
                        public function index(): Response
                        {
                          
                        }

                        #[Route(''), IsGranted('ROLE_USER')]
                        public function edit(): Response
                        {
                     
                        }
                }
                EOD;
    }
    private function normalFileContent(string $folderName, string $subFolder, string $className): string
    {
        return
            <<<EOD
                <?php

                declare(strict_types=1);

                namespace App\\$folderName\\$subFolder;

                class $className
                {
                    // Your class definition goes here
                }
                EOD;
    }
}
