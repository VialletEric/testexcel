<?php

namespace App\Controller;

use App\Entity\Rockband;
use App\Form\SendDocumentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Translation\Dumper\CsvFileDumper;
use Symfony\Component\String\Slugger\SluggerInterface;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(Request $request, SluggerInterface $slugger): Response
    {
        $rockBand = new Rockband();
        $form = $this->createForm(SendDocumentType::class, $rockBand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $attachementFile */
            $attachementFile = $form->get('attachement')->getData();

            if ($attachementFile) {
                $originalFilename = pathinfo($attachementFile->getClientOriginalName(), PATHINFO_FILENAME);
                
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$attachementFile->guessExtension();

                
                try {
                    $attachementFile->move(
                        $this->getParameter('attachement_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                   
                }

                $rockBand->setAttachementFilename($newFilename);
            }

        

            return $this->redirectToRoute('main');
        }

        return $this->renderForm('main/index.html.twig', [
            'form' => $form,
        ]);
    }
}
