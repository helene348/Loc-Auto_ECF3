<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\InscriptionType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     * @Route("/edit/{id}", name="edit_inscription")
     *
     */
    public function inscription(Client $client = null, Request $request, EntityManagerInterface $manager,
     UserPasswordEncoderInterface $encoder) {

        if(!$client){
            $client = new Client();
            $form= $this->createForm(InscriptionType::class, $client);

            $form->handleRequest($request);
    
            $client->setClientInscription(new \DateTime());

    
            if($form->isSubmitted() && $form->isValid()){
                $hash = $encoder->encodePassword($client, $client->getClientMdp());
    
                $client->setClientMdp($hash);
    
                $manager->persist($client);
                $manager->flush();
                $this->addFlash('success', 'Votre inscription a été validée avec succès ! Connectez-vous, puis réservez un véhicule !');
                return $this->redirectToRoute('login', [
                    'id' => $client->getId()]);
            }
    
            return $this->render('security/inscription.html.twig', [
                'formInscription' => $form->createView(),
                'editMode' => $client->getId() !== null
            ]);

        } else {
            $form= $this->createForm(InscriptionType::class, $client);

            $form->handleRequest($request);
    
            if($form->isSubmitted() && $form->isValid()){
                $hash = $encoder->encodePassword($client, $client->getClientMdp());
    
                $client->setClientMdp($hash);
    
                $manager->persist($client);
                $manager->flush();
                $this->addFlash('success', 'Vos informations ont été modifiées avec succès !');
                return $this->redirectToRoute('home', [
                    'id' => $client->getId()]);
            }
    
            return $this->render('security/inscription.html.twig', [
                'formInscription' => $form->createView(),
                'editMode' => $client->getId() !== null
            ]);
        }

    }

    /**
     * @Route("/connexion", name="login")
     */
    public function login(){
        return $this->render('security/login.html.twig');
    }

    /**
     * @Route("/deconnexion", name="logout")
     */
    public function logout(){

    }
}
