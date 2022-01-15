<?php

namespace App\Controller;

use App\Entity\Pfe;
use App\Form\Pfe1Type;
use App\Repository\PfeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/f/ct")
 */
class PfeCtController extends AbstractController
{
    /**
     * @Route("/", name="pfe_ct_index", methods={"GET"})
     */
    public function index(PfeRepository $pfeRepository,Request $request,Pfe $pfe): Response
    {

        return $this->render('pfe_ct/index.html.twig', [
            'pves' => $pfeRepository->findAll(),
            'form' => $form,

        ]);
    }

    /**
     * @Route("/new", name="pfe_ct_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pfe = new Pfe();
        $form = $this->createForm(Pfe1Type::class, $pfe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pfe);
            $entityManager->flush();

            return $this->redirectToRoute('pfe_ct_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pfe_ct/new.html.twig', [
            'pfe' => $pfe,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="pfe_ct_show", methods={"GET"})
     */
    public function show(Pfe $pfe): Response
    {
        return $this->render('pfe_ct/show.html.twig', [
            'pfe' => $pfe,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="pfe_ct_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pfe $pfe): Response
    {
        $form = $this->createForm(Pfe1Type::class, $pfe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pfe_ct_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pfe_ct/edit.html.twig', [
            'pfe' => $pfe,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="pfe_ct_delete", methods={"POST"})
     */
    public function delete(Request $request, Pfe $pfe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pfe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pfe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pfe_ct_index', [], Response::HTTP_SEE_OTHER);
    }
}
