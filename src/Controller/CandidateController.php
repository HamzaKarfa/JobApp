<?php

namespace App\Controller;

use App\Entity\Candidate;
use App\Form\CandidateType;
use App\Repository\CandidateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/candidate')]
class CandidateController extends AbstractController
{
    #[Route('/', name: 'candidate_index', methods: ['GET'])]
    public function index(CandidateRepository $candidateRepository): Response
    {
        return $this->render('candidate/index.html.twig', [
            'candidates' => $candidateRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'candidate_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $candidate = new Candidate();
        $form = $this->createForm(CandidateType::class, $candidate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($candidate);
            $entityManager->flush();

            return $this->redirectToRoute('candidate_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('candidate/new.html.twig', [
            'candidate' => $candidate,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'candidate_show', methods: ['GET'])]
    public function show(Candidate $candidate): Response
    {
        return $this->render('candidate/show.html.twig', [
            'candidate' => $candidate,
        ]);
    }

    #[Route('/{id}/edit', name: 'candidate_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Candidate $candidate, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(CandidateType::class, $candidate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->uploadFile(
                
                
                $form->get("profil_picture")->getData(),
                $slugger, 
                'profil_picture_directory' 
            );
            $this->uploadFile(
                
                
                $form->get("passport_file")->getData(),
                $slugger, 
                'passport_file_directory' 
            );
            $this->uploadFile(
                
                
                $form->get("curriculum_vitae")->getData(),
                $slugger, 
                'curriculum_vitae_directory' 
            );
            dd($candidate);
            



            $entityManager->flush();

            return $this->redirectToRoute('candidate_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('candidate/edit.html.twig', [
            'candidate' => $candidate,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'candidate_delete', methods: ['POST'])]
    public function delete(Request $request, Candidate $candidate, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$candidate->getId(), $request->request->get('_token'))) {
            $entityManager->remove($candidate);
            $entityManager->flush();
        }

        return $this->redirectToRoute('candidate_index', [], Response::HTTP_SEE_OTHER);
    }


    public function uploadFile(UploadedFile $brochureFile, SluggerInterface $slugger, string $directory){
        if ($brochureFile) {
            $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

            // Move the file to the directory where brochures are stored
            try {
                $brochureFile->move(
                    $this->getParameter($directory),
                    $newFilename
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

            // updates the 'brochureFilename' property to store the PDF file name
            // instead of its contents
            // $product->setBrochureFilename($newFilename);
        }
    }
}