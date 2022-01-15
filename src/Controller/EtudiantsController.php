<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Entity\Enseignant;
use App\Entity\Etudiant;
use App\Entity\Inscription;
use App\Form\EnseignantType;
use App\Form\EtudiantType;
use App\Repository\ClasseRepository;
use App\Repository\EtudiantRepository;
use App\Repository\InscriptionRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Vich\UploaderBundle\Form\Type\VichFileType;



class EtudiantsController extends AbstractController
{
    /**
     * @Route("/etudIng", name="etudIng")
     * @IsGranted("ROLE_ADMIN")
     */
    public function etudIng (EtudiantRepository $etudiantRepository): Response
    {

        return $this->render('etudiants/etudiantIng.html.twig',[
            'eing'=>$etudiantRepository->findEtudiantsIngenieur(),
        ]);
    }

    /**
     * @Route("/etudLic", name="etudLic")
     */
    public function etudLic (EtudiantRepository $etudiantRepository,Request $request,PaginatorInterface $paginator): Response
    {

        $etudiantL = new Etudiant();

        $form = $this->createForm(EtudiantType::class, $etudiantL);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($etudiantL);
            $entityManager->flush();

            return $this->redirectToRoute('etudLic', [], Response::HTTP_SEE_OTHER);
        }

        $data=$etudiantRepository->findAll();
        $etd=$paginator->paginate($data,
            $request->query->getInt('page',1),6) ;
        return $this->renderForm('etudiants/etudiantlic.html.twig', [
            'elic' => $etd,
            'form'=>$form
        ]);
    }

    /**
     * @Route("/profile/{id}", name="profile")
     */
    public function profile($id,EtudiantRepository $etudiantRepository,Etudiant $etudiant, Request $request)
    {
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->render("etudiants/profile.html.twig", ['elic' => $etudiantRepository->find($id)]);
        }

        return $this->renderForm('etudiants/profile.html.twig', [
            'elic' => $etudiant,
            'form' => $form,
        ]);

    }






    /**
     * @Route("/new", name="etud_new", methods={"GET","POST"})
     */
    public function new(Request $request,EtudiantRepository $etudiantRepository, ClasseRepository $classeRepository, InscriptionRepository $inscRepository ,PaginatorInterface $paginator): Response
    {
        $etudLic = new Etudiant();
        $isc = new Inscription() ;
        $cls = $classeRepository->find(1) ;

        $form = $this->createForm(EtudiantType::class, $etudLic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($etudLic);
            $isc->setAu('2021-2022') ;
            $isc->setClasse($cls) ;
            $isc->setEtudiant($etudLic) ;
            $isc->setMoyenne(0);
            $entityManager->persist($isc);
            $entityManager->flush();

            return $this->redirectToRoute('etudLic', [], Response::HTTP_SEE_OTHER);
        }
        $data=$etudiantRepository->findEtudiantsLicence();
        $etd=$paginator->paginate($data,
            $request->query->getInt('page',1),6) ;
        return $this->renderForm('etudiants/profile.html.twig', [
            'elic' => $etd,
            'form'=>$form
        ]);
    }

}
