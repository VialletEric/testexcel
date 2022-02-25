<?php

namespace App\Command;

use App\Entity\Rockband;
use App\Repository\RockbandRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class CreateRockBandCommand extends Command
{
    private EntityManagerInterface $entityManager;

    private string $dataDirectory;

    private SymfonyStyle $io;

    private RockbandRepository $rockbandRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        string $dataDirectory,
        RockbandRepository $rockbandRepository
    )
    {
        parent::__construct();
        $this->dataDirectory = $dataDirectory;
        $this->entityManager = $entityManager;
        $this->rockbandRepository = $rockbandRepository;
    }

    protected static $defaultName = 'app:create-rockband-from-file';
    protected static $defaultDescription = 'Importer des données en provenance d\'un fichier excel';

    protected function configure(): void
    {

    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->io = new SymfonyStyle($input, $output);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
       $this->createRockBand();

        return Command::SUCCESS;
    }

    private function getDataFromFile(): array
    {
        $file = $this->dataDirectory . 'test.csv';

        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);

        $normalizers = [new ObjectNormalizer()];

        $encorders = [
            new CsvEncoder()
        ];

        $serializer = new Serializer($normalizers, $encorders);

        /** @var string $fileString */
        $fileString = file_get_contents($file);

        $data = $serializer->decode($fileString, $fileExtension);

        if (array_key_exists('results', $data)) {
            return $data['results'];
        }

        return $data;
    }

    private function createRockBand(): void
    {
        $this->io->section('CREATION DES GROUPES DE ROCK A PARTIR DU FICHIER');


       $rockBandCreated = 0;

        foreach($this->getDataFromFile() as $row) {
            if(array_key_exists('name', $row) && !empty($row['name'])) {
                $rockBand = $this->rockbandRepository->findOneBy([
                    'name' => $row['name']
                ]);

                if (!$rockBand) {
                    $rockBand = new Rockband();

                    $rockBand->setOrigine($row['name']);

                    $this->entityManager->persist($rockBand);

                    $rockBandCreated++;

                }
            }
        }

        $this->entityManager->flush();

        if ($rockBandCreated > 1) {
            $string = "{$rockBandCreated} GROUPES DE ROCK CREES EN BASE DE DONNEES.";
        } elseif ($rockBandCreated === 1) {
            $string = 'UN GROUPE DE ROCK A ETE CREE EN BASE DE DONNEES.';
        } else {
            $string = 'AUCUN GROUPE DE ROCK N\'A ETE CREE EN BASE DE DONNEES.';
        }

        $this->io->success($string);  
    }
}
