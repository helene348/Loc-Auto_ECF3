<?php

namespace App\Controller;


use App\Entity\Reserver;
use App\Entity\Categorie;
use App\Entity\Assurance;
use App\Entity\Client;
use App\Entity\Vehicule;
use App\Entity\Agence;
use App\Form\ReservationType;
use App\Form\ReservationEssaiType;
use App\Form\VehiculeClientSearchType;
use App\Repository\AgenceRepository;
use App\Repository\CategorieRepository;
use App\Repository\JourRepository;
use App\Repository\WeekEndRepository;
use App\Repository\AssuranceRepository;
use App\Repository\CarburantRepository;
use App\Repository\ClientRepository;
use App\Repository\ReserverRepository;
use App\Repository\VehiculeRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Query\AST\WhereClause;
use PhpParser\Node\Expr\BinaryOp\NotEqual;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarExporter\Internal\Values;

use \Doctrine\Common\Collections\Criteria;
use Symfony\Component\Validator\Constraints\DateTime as ConstraintsDateTime;
use Symfony\Component\Validator\Constraints\NotNull;
use Dompdf\Dompdf;
use Dompdf\Options;
use phpDocumentor\Reflection\DocBlock\Tags\Formatter;
use Symfony\Flex\Options as FlexOptions;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\CallbackTransformer;

class LocAutoController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('loc_auto/index.html.twig',[
            'controller_name' => 'LocAutoController'
        ]);
    }

    /**
     * @Route("/tarifs", name="tarifs")
     */
    public function tarifs(CategorieRepository $repo, CarburantRepository $repoCarbu): Response
    {
        $categorie = $repo->findAll();
        $carburants = $repoCarbu->findAll();
        return $this->render('loc_auto/tarifs.html.twig',[
            'categorie' => $categorie,
            'carburants' => $carburants
        ]);
    }

    /**
     * @Route("/vehicules", name="vehicules")
     */
    public function vehicules(VehiculeRepository $repo): Response{

        $vehicule = $repo->findByDateVenteIsNull();

        return $this->render('loc_auto/vehicules.html.twig', [
            'vehicule' => $vehicule
        ]);
    }

    /**
     * @Route("/meteo", name="meteo")
     */
    public function meteo(){
        return $this->render('loc_auto/meteo.html.twig');
    }

    /**
     * @Route("/localisation", name="localisation")
     */
    public function localisation(AgenceRepository $repo){

        $agences = $repo->findBy(['id' => 1]);
        return $this->render('loc_auto/localisation.html.twig', [
            'agences' => $agences
        ]);
    }

    /**
     * @Route("/reservations", name="new_reservation")
     */
    public function reserver(Request $request, EntityManagerInterface $manager): Response
    {
        $reservation = new Reserver();
        //$defaultData = ['message' => 'Bonjour'];
        $form= $this->createForm(ReservationType::class, $reservation);

        //$form =$this->createForm(ReservationType::class, $defaultData);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $client =$this->getUser();
            $reservation->setClient($client);
            $manager->persist($reservation);
            
            $manager->flush();
            $this->addFlash('success', 'Votre réservation a été validée avec succès ! Pour visualiser vos réservations, rendez-vous dans la rubrique Mon Compte.');
            return $this->redirectToRoute('home');
            
            //$data = $form->setData();
            /*
            return $this->render('loc_auto/essai.html.twig', [
                'data' => $data
            ]);
            */
            
        }
        
        return $this->render('loc_auto/reservations.html.twig', [
            'formReservation' => $form->createView()
                
        ]);
    }

    /**
     * @Route("/{idClient}/reservations", name="reservations_client")
     */
    public function reservation(ReserverRepository $repo, $idClient): Response{

        $reservations = $repo->findby([
            'client' => $idClient
        ]);

        if($reservations == null){
            $this->addFlash('success', 'Vous n\'avez pas de réservation en cours');
        }
        return $this->render('loc_auto/reservationsClient.html.twig',[
            'reservations' => $reservations
        ]);
    }

    /**
     * @Route("/{idClient}/deleteResa/{id}", name="delete_resa")
     */
    public function reservationDelete(ReserverRepository $repo, $id, $idClient, 
    ClientRepository $repoClient, EntityManagerInterface $manager): Response{


        $reservations = $repo->findOneById($id);
        $client = $repoClient->findby([
            'idClient' => $idClient
        ]);
        $manager->remove($reservations);
        $manager->flush();
        $this->addFlash('success', 'Votre réservation a été supprimée.');

        return $this->redirectToRoute('reservations_client', [
            'idClient' => $client
        ]);
    }

    //génération pdf

    /**
     * @Route("/rgpd", name="rgpd")
     */
    public function rgpd(){
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('loc_auto/rgpd.html.twig');
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("rgpd.pdf", [
            "Attachment" => false
        ]);
    }
    
}
