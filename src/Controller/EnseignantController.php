<?php

namespace App\Controller;

use App\Entity\Enseignant;
use App\Form\EnseignantType;
use App\Repository\EnseignantRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/enseignant")
 */
class EnseignantController extends AbstractController
{
    /**
     * @Route("/", name="enseignant_index", methods={"GET","POST"})
     */
    public function index(EnseignantRepository $enseignantRepository,PaginatorInterface $paginator,Request $request): Response
    {   $enseignant = new Enseignant();

        $form = $this->createForm(EnseignantType::class, $enseignant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($enseignant);
            $entityManager->flush();

            return $this->redirectToRoute('enseignant_index', [], Response::HTTP_SEE_OTHER);
        }


        $data=$enseignantRepository->findAll();
        $ens=$paginator->paginate($data,
            $request->query->getInt('page',1),6) ;
        return $this->renderForm('enseignant/index.html.twig', [
            'enseignants' => $ens,
            'form'=>$form
        ]);
    }

    /**
     * @Route("/new", name="enseignant_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $enseignant = new Enseignant();
        $form = $this->createForm(EnseignantType::class, $enseignant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($enseignant);
            $entityManager->flush();

            return $this->redirectToRoute('enseignant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('enseignant/new.html.twig', [
            'enseignant' => $enseignant,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/{id}/edit", name="enseignant_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Enseignant $enseignant): Response
    {
        $form = $this->createForm(EnseignantType::class, $enseignant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('enseignant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('enseignant/edit.html.twig', [
            'enseignant' => $enseignant,
            'form' => $form,
        ]);
    }

    /*
     * */







    /**
     * @Route("/{id}", name="enseignant_delete", methods={"POST"})
     */
    public function delete(Request $request, Enseignant $enseignant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$enseignant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($enseignant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('enseignant_index', [], Response::HTTP_SEE_OTHER);
    }
}
