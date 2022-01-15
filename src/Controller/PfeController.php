<?php

namespace App\Controller;


use App\Entity\Calend;
use App\Entity\Pfe;
use App\Entity\Enseignant;
use App\Form\Pfe1Type;
use App\Form\PfeType;
use App\Repository\CalendRepository;
use App\Repository\EnseignantRepository;
use App\Repository\EtudiantRepository;
use App\Repository\InscriptionRepository;
use App\Repository\PfeRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class PfeController extends AbstractController
{




    /**
     * @Route("/pfe", name="pfe")
     * @IsGranted("ROLE_USER")
     */
    public function pfe (EnseignantRepository $enseignantRepository,EtudiantRepository $etudiantRepository,
                         PfeRepository $pfeRepository,PaginatorInterface $paginator, Request $request
                        ): Response
    {

        $data=$pfeRepository->findAll();
        $pfe=$paginator->paginate($data,
        $request->query->getInt('page',1),6) ;

        return $this->render('pfe/pfe.html.twig',['ensListe'=> $enseignantRepository->findAll(),
            'etudLicenceListe'=>$etudiantRepository->findEtudiantsLicence(),
            'etudIngenieurListe'=>$etudiantRepository->findEtudiantsIngenieur(),
            'pfes' => $pfe,


        ]);
    }


    /**
     * @Route("/affpfe", name="affpfe")
     */
    public function affPfe(Request $request,EtudiantRepository $etrep,EnseignantRepository $enrep,PfeRepository $pfeRepository
    , MailerInterface $mailer): Response
    {
        $c1 = new Pfe();

            $sujet = $request->request->get('sujet');
            $etid = (int)$request->request->get('etudLicenceListe');
            $etL=$etrep->find($etid);
            $etI = $request->request->get('etudIngenieurListe');
            $ensid =(int) $request->request->get('ens');
            $ens=$enrep->find($ensid) ;
            $description = $request->request->get('description');
            $c1->setEns($ens);
            $c1->setSujet($sujet);
            $c1->setEtud($etL);
            $c1->setAnnee(2020) ;
            $c1->setEtat(1) ;
            $c1->setDescription($description) ;
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($c1);
            $entityManager->flush();

            /* Tel*/

        $account_sid = $this->getParameter('twilio_account_sid');
        $auth_token = $this->getParameter('twilio_auth_token') ;

        $url = "https://api.twilio.com/2010-04-01/Accounts/$account_sid/SMS/Messages";
        $to ='+216'.$ens->getTel();
        $from = $this->getParameter('twilio_number'); // twilio trial verified number
        $body = "Bonjour,".$ens->getPrenom().' '.$ens->getNom() ."Une nouvelle affectation PFE est faite, Etudiant".$etL->getNom().' '.$etL->getPrenom();
        $data = array (
            'From' => $from,
            'To' => $to,
            'Body' => $body,
        );

        $post = http_build_query($data);

        $x = curl_init($url );
        curl_setopt($x, CURLOPT_POST, true);
        curl_setopt($x, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($x, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($x, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($x, CURLOPT_USERPWD, "$account_sid:$auth_token");
        curl_setopt($x, CURLOPT_POSTFIELDS, $post);
        $y = curl_exec($x);
        curl_close($x);


        $email = (new Email())
            ->from(new Address('mailtrap@example.com', 'Mailtrap'))
            ->to($etL->getEmail())
            ->subject('Nouvelle Affectaion PFE')
            ->text('Bonjour, une nvelle affectation est disponible !')
            ->html('<html>
<body>
		<p><br>Bonjour </br>
		Votre affectation PFE est faite ! consulter le site de l"univversité pour plus d"information.</p>
		<p><a href="www.universitesesame.com">Université SESAME</a> </p>
		<img src="public/img/ses.png"> ... 
				</body>
			</html>')
       ;

        $mailer->send($email);


            return $this->redirectToRoute('pfe',[
                'pfes' => $pfeRepository->findAll(),
            ]);


        }

    /**
     * @Route("change_etat/{id}", name="change_etat", methods={"GET","POST"})
     */
    public function edit($id,Request $request,PfeRepository $pfeRep): Response
    {
        $pfe= $pfeRep->find($id) ;
        if($pfe->getEtat()==1 ){
            $pfe->setEtat(0) ;
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pfe);
            $entityManager->flush();
        }
        else if($pfe->getEtat()==0 ){
            $pfe->setEtat(1) ;
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pfe);
            $entityManager->flush();
        }


        return $this->redirectToRoute("pfe") ;

    }


    /**
     * @Route("/{id}/edit", name="pfe_ct_edit", methods={"GET","POST"})
     */
    public function edition(Request $request, Pfe $pfe): Response
    {
        $form = $this->createForm(Pfe1Type::class, $pfe);
        $form->handleRequest($request);


        return $this->renderForm('pfe/pfe.html.twig', [
            'pfe' => $pfe,
            'form' => $form,
        ]);
    }








    }