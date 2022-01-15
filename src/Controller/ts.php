<?php
// src/Controller/ts.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Message\GenerateReport ;

class ts extends AbstractController
{
    /**
     * @Route("/nm", name="heavy_work_new")
     */
    public function new():Response
    {
        $account_sid = 'AC0b7ecb2ae9b93eb9d2d4d7d3f3c01071';
        $auth_token = 'f56de035bc7b399ef0c801c279556367';

        $url = "https://api.twilio.com/2010-04-01/Accounts/$account_sid/SMS/Messages";
        $to = "+21694003636";
        $from = "+19402897125"; // twilio trial verified number
        $body = "Bonjour, Une nouvelle affectation est faite, Etudiant ";
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

//var_dump($post);
//var_dump($y);

    }

    /**
     * @Route("/complete", name="heavy_work_show")
     * @param Request $request
     * @return Response
     */
    public function show(Request $request)
    {
        return $this->render('show.html.twig', [
            'firstName' => $request->query->get('firstName')
        ]);
    }
}
