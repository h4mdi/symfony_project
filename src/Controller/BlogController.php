<?php

namespace App\Controller;

use App\Entity\Calend;
use App\Entity\Cours;
use App\Entity\Enseignant;
use App\Repository\CalendRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date ;


class BlogController extends AbstractController
{
    /**
     * @Route("/", name="/")
     */
    public function index(CalendRepository $calendar): Response
    {


            return $this->redirectToRoute('emploi');

    }


    /**
     * @Route("/emploi", name="emploi")
     */
    public function emploi(CalendRepository $calendar): Response
    {
        $events= $calendar ->findAll();
       // dd($events);
        $sceances=[] ;
        foreach ($events as $event ) {
            $sceances[] = [
                'id'=> $event->getId() ,
                'start'=> $event->getDebut()->format('Y-m-d H:i:s') ,
                'end'=> $event->getFin()->format('Y-m-d H:i:s') ,
                'title'=> $event->getTitre(),
                'description'=> $event->getDescription(),
                'backgroundColor'=> $event->getBgColor(),
                'borderColor'=> $event->getBorderColor(),
                'textColor'=> $event->getTextColor(),
                //'allDay'=> $event->getDallDays(),
                //'daysOfWeek'=> ['0'],
                //$newformat = date($event->getDebut()->format('Y-m-d H:i:s')),
                $week = date("w", strtotime($event->getDebut()->format('Y-m-d'))),
                 'daysOfWeek'=> [$week],
                'endRecur'=>'2022-01-01' ,



            ] ;
    }
       $data = json_encode($sceances) ;
      //dd($data);
        return $this->render('blog/emploi.html.twig', compact('data'));
    }

    /**
     * @Route("/addCs", name="addCs")
     */
    public function addCourse(Request $request): Response
    {   $c1=new Cours();
    {   $e1=new Enseignant();
        $title=$request->request->get('title') ;
        $startDate=$request->request->get('startDate') ;
        $endDate=$request->request->get('endDate') ;
        $allDay=$request->request->get('allDay') ;
        $description=$request->request->get('description') ;
        $cour = new Calend();
        $cour->setTitre($title);
        $cour->setDebut(new \DateTime($startDate));
        $cour->setFin(new \DateTime($endDate));
        $cour->setDallDays(1);
        $cour->setDescription($description);
        $cour->setIdCours($c1->getId());
        $cour->setIdEnseignant($e1->getId());
        $cour->setBgColor('#ab7853');
        $cour->setTextColor('#232525') ;
        $cour->setBorderColor('#ab7853') ;
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($cour);
        $entityManager->flush();

        return $this->redirectToRoute('emploi');


    }






}
    /**
     * @Route("/id_e", name="id_e")
     */
    public function ide():Response
    {
        return $this->render('blog/ide.html.twig');

    }




}
