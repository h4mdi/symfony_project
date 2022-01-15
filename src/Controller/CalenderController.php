<?php

namespace App\Controller;

use App\Entity\Calend;
use App\Form\CalendType;
use App\Repository\CalendRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/calender")
 */
class CalenderController extends AbstractController
{
    /**
     * @Route("/", name="calender_index", methods={"GET"})
     */
    public function index(CalendRepository $calendRepository): Response
    {
        return $this->render('calender/index.html.twig', [
            'calends' => $calendRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="calender_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $calend = new Calend();
        $form = $this->createForm(CalendType::class, $calend);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($calend);
            $entityManager->flush();

            return $this->redirectToRoute('calender_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('calender/new.html.twig', [
            'calend' => $calend,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="calender_show", methods={"GET"})
     */
    public function show(Calend $calend): Response
    {
        return $this->render('calender/show.html.twig', [
            'calend' => $calend,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="calender_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Calend $calend): Response
    {
        $form = $this->createForm(CalendType::class, $calend);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('calender_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('calender/edit.html.twig', [
            'calend' => $calend,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="calender_delete", methods={"POST"})
     */
    public function delete(Request $request, Calend $calend): Response
    {
        if ($this->isCsrfTokenValid('delete'.$calend->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($calend);
            $entityManager->flush();
        }
        return $this->redirectToRoute('calender_index', [], Response::HTTP_SEE_OTHER);
    }
}
