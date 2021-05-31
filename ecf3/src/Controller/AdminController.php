<?php

namespace App\Controller;

use App\Entity\Agence;
use App\Entity\Assurance;
use App\Entity\Carburant;
use App\Entity\Categorie;
use App\Entity\Jour;
use App\Entity\Type;
use App\Entity\Vehicule;
use App\Entity\WeekEnd;
use App\Entity\Reserver;
use App\Form\AgenceType;
use App\Form\AssuranceType;
use App\Form\CarburantType;
use App\Form\CategorieType;
use App\Form\InscriptionAdminType;
use App\Form\InscriptionType;
use App\Form\InscriptionEditType;
use App\Form\JourType;
use App\Form\ReservationEditType;
use App\Form\ReservationType;
use App\Form\TypeType;
use App\Form\VehiculeType;
use App\Form\WkType;
use App\Repository\AgenceRepository;
use App\Repository\AssuranceRepository;
use App\Repository\CarburantRepository;
use App\Repository\CategorieRepository;
use App\Repository\ClientRepository;
use App\Repository\JourRepository;
use App\Repository\ReserverRepository;
use App\Repository\TypeRepository;
use App\Repository\VehiculeRepository;
use App\Repository\WeekEndRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;


class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="home_admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig',[
            'controller_name' => 'AdminController'
        ]);
    }

    //GESTION DES VEHICULES

    /**
     * @Route("/admin/vehicules", name="vehicules_admin")
     */
    public function vehiculesGestion(VehiculeRepository $repo, TypeRepository $repoType,
    CarburantRepository $repoCarbu, AgenceRepository $repoAgence): Response{

        $vehicule = $repo->findAll();
        $type = $repoType->findAll();
        $carburant = $repoCarbu->findAll();
        $agence = $repoAgence->findAll();
        return $this->render('admin/vehiculeListe.html.twig',[
            'vehicule' => $vehicule,
            'type' => $type,
            'carburant' => $carburant,
            'agence' => $agence
        ]);
    }

    /**
     * @Route("/vehicule", name="vehicule_new")
     * @Route("/vehicule/edit/{id}", name="edit_vehicule")
     */
    public function vehiculeGestion(Request $request, EntityManagerInterface $manager, 
    VehiculeRepository $repo, $id = null): Response{

        if($id !== null){
            $vehicule = $repo->findOneById($id);
            $form= $this->createForm(VehiculeType::class, $vehicule);
            $form->handleRequest($request);
    
            if($form->isSubmitted() && $form->isValid()){
    
                $manager->persist($vehicule);
                $manager->flush();
                $this->addFlash('success', 'Le véhicule a été modifié avec succès !');
                return $this->redirectToRoute('vehicules_admin');
            }
        
            return $this->render('admin/newVehicule.html.twig', [
                'formVehicule' => $form->createView(),
                'vehicule' => $vehicule
            ]);
        } else {
            $vehicule = new Vehicule();
            $form= $this->createForm(VehiculeType::class, $vehicule);
    
            $form->handleRequest($request);
    
            
            if($form->isSubmitted() && $form->isValid()){
    
                $manager->persist($vehicule);
                $manager->flush();
                $this->addFlash('success', 'Le véhicule a été crée avec succès !');
                return $this->redirectToRoute('vehicules_admin');
            }
        
            return $this->render('admin/newVehicule.html.twig', [
                'formVehicule' => $form->createView(),
                'vehicule' => $vehicule
            ]);
        }

    }

    /**
     * @Route("/admin/{id}/delete_vehicule", name="delete_vehicule")
     */
    public function deleteVehicule(EntityManagerInterface $manager, 
    VehiculeRepository $repo, $id = null): Response {
        
        $vehicule = $repo->findOneById($id);

        $manager->remove($vehicule);
        $manager->flush();
        $this->addFlash('success', 'Le véhicule a été supprimé avec succès !');
        return $this->redirectToRoute('vehicules_admin');
        

    }

    /**
     * @Route("/admin/new/type", name="new_type")
     * @Route("/admin/type/{id}", name="edit_type")
     */
    public function newType(Request $request, EntityManagerInterface $manager, 
    TypeRepository $repo, $id = null): Response {
        
        if($id !== null){
            $type = $repo->findOneById($id);
            $form = $this->createForm(TypeType::class, $type);
            $form->handleRequest($request);
    
            if($form->isSubmitted() && $form->isValid()){
                $manager->persist($type);
                $manager->flush();
                $this->addFlash('success', 'Le type de véhicule a été modifié avec succès !');
                return $this->redirectToRoute('vehicules_admin');
            }
            return $this->render('admin/newType.html.twig', [
                'formType' => $form->createView(),
                'type' => $type
            ]);
        } else {
            $type = new Type();
            $form = $this->createForm(TypeType::class, $type);
            $form->handleRequest($request);
    
            if($form->isSubmitted() && $form->isValid()){
                $manager->persist($type);
                $manager->flush();
                $this->addFlash('success', 'Le type de véhicule a été crée avec succès !');
                return $this->redirectToRoute('vehicules_admin');
            }
            return $this->render('admin/newType.html.twig', [
                'formType' => $form->createView(),
                'type' => $type
            ]);
        }

    }
    /**
     * @Route("/admin/{id}/delete_type", name="delete_type")
     */
    public function deleteType(EntityManagerInterface $manager, 
    TypeRepository $repo, $id = null): Response {
        
        $type = $repo->findOneById($id);

        $manager->remove($type);
        $manager->flush();
        $this->addFlash('success', 'Le type de véhicule a été supprimé avec succès !');
        return $this->redirectToRoute('vehicules_admin');
        

    }

    /**
     * @Route("/admin/new/carbu", name="new_carbu")
     * @Route("/admin/carbu/{id}", name="edit_carbu")
     */
    public function newCarbu(Request $request, EntityManagerInterface $manager, 
    CarburantRepository $repo, $id = null): Response {
        
        if($id !== null){
            $carburant = $repo->findOneById($id);
            $form = $this->createForm(CarburantType::class, $carburant);
            $form->handleRequest($request);
    
            if($form->isSubmitted() && $form->isValid()){
                $manager->persist($carburant);
                $manager->flush();
                $this->addFlash('success', 'Le carburant a été modifié avec succès !');
                return $this->redirectToRoute('vehicules_admin');
            }
            return $this->render('admin/newCarbu.html.twig', [
                'formCarbu' => $form->createView(),
                'carburant' => $carburant
            ]);
        } else {
            $carburant = new Carburant();
            $form = $this->createForm(CarburantType::class, $carburant);
            $form->handleRequest($request);
    
            if($form->isSubmitted() && $form->isValid()){
                $manager->persist($carburant);
                $manager->flush();
                $this->addFlash('success', 'Le carburant a été crée avec succès !');
                return $this->redirectToRoute('vehicules_admin');
            }
            return $this->render('admin/newCarbu.html.twig', [
                'formCarbu' => $form->createView(),
                'carburant' => $carburant
            ]);
        }

    }

        /**
     * @Route("/admin/{id}/delete_carbu", name="delete_carbu")
     */
    public function deleteCarbu(EntityManagerInterface $manager, 
    CarburantRepository $repo, $id = null): Response {
        
            $carburant = $repo->findOneById($id);
    
            $manager->remove($carburant);
            $manager->flush();
            $this->addFlash('success', 'Le carburant a été supprimé avec succès !');
            return $this->redirectToRoute('vehicules_admin');
    }

    /**
     * @Route("/admin/new/agence", name="new_agence")
     * @Route("/admin/agence/{id}", name="edit_agence")
     */
    public function newAgence(Request $request, EntityManagerInterface $manager, 
    AgenceRepository $repo, $id = null): Response {
        
        if($id !== null){
            $agence = $repo->findOneById($id);
            $form = $this->createForm(AgenceType::class, $agence);
            $form->handleRequest($request);
    
            if($form->isSubmitted() && $form->isValid()){
                $manager->persist($agence);
                $manager->flush();
                $this->addFlash('success', 'L\'agence a été modifiée avec succès !');
                return $this->redirectToRoute('vehicules_admin');
            }
            return $this->render('admin/newAgence.html.twig', [
                'formAgence' => $form->createView(),
                'agence' => $agence
            ]);
        } else {
            $agence = new Agence();
            $form = $this->createForm(AgenceType::class, $agence);
            $form->handleRequest($request);
    
            if($form->isSubmitted() && $form->isValid()){
                $manager->persist($agence);
                $manager->flush();
                $this->addFlash('success', 'L\'agence a été créée avec succès !');
                return $this->redirectToRoute('vehicules_admin');
            }
            return $this->render('admin/newAgence.html.twig', [
                'formAgence' => $form->createView(),
                'agence' => $agence
            ]);
        }

    }

    /**
     * @Route("/admin/{id}/delete_agence", name="delete_agence")
     */
    public function deleteAgence(EntityManagerInterface $manager, 
    AgenceRepository $repo, $id = null): Response {
        
        $agence = $repo->findOneById($id);

        $manager->remove($agence);
        $manager->flush();
        $this->addFlash('success', 'L\'agence a été supprimée avec succès !');
        return $this->redirectToRoute('vehicules_admin');        

    }


    //GESTION TARIFS

    /**
     * @Route("/admin/tarifs", name="tarifs_admin")
     */
    public function tarifsGestion(CategorieRepository $repo, JourRepository $repoJour,
    WeekEndRepository $repoWk, AssuranceRepository $repoAssu): Response{

        $categorie = $repo->findAll();
        $jour = $repoJour->findAll();
        $weekend = $repoWk->findAll();
        $assurance = $repoAssu->findAll();
        return $this->render('admin/tarifs.html.twig',[
            'categorie' => $categorie,
            'jour' => $jour,
            'weekend' => $weekend,
            'assurance' => $assurance
        ]);
    }
    
    /**
     * @Route("/admin/new/categorie", name="new_categorie")
     * @Route("/admin/edit/{id}", name="edit_categorie")
     */
    public function newCategorie(Request $request, EntityManagerInterface $manager, 
    CategorieRepository $repo, $id = null): Response {
        
        if($id !== null){
            $categorie = $repo->findOneById($id);
            $form = $this->createForm(CategorieType::class, $categorie);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $manager->persist($categorie);
                $manager->flush();
                $this->addFlash('success', 'La catégorie a été modifiée avec succès !');
                return $this->redirectToRoute('tarifs_admin');
            }
            return $this->render('admin/newCategorie.html.twig', [
                'formCategorie' => $form->createView(),
                'categorie' => $categorie
            ]);
        } else {
            $categorie = new Categorie();
            $form = $this->createForm(CategorieType::class, $categorie);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $manager->persist($categorie);
                $manager->flush();
                $this->addFlash('success', 'La catégorie a été créée avec succès !');
                return $this->redirectToRoute('tarifs_admin');
            }
            return $this->render('admin/newCategorie.html.twig', [
                'formCategorie' => $form->createView(),
                'categorie' => $categorie
            ]);
        }
    }



    /**
     * @Route("/admin/new/tarif/jour", name="new_tarif_jour")
     */
    public function newTarifJour(Request $request, EntityManagerInterface $manager) {
        
        $jour = new Jour();
        
        $form = $this->createForm(JourType::class, $jour);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $jour->setJourDatePrix(new \DateTime());
            $manager->persist($jour);
            $manager->flush();
            $this->addFlash('success', 'Le tarif Jour a été crée/modifié avec succès !');
            return $this->redirectToRoute('tarifs_admin');
        }
        return $this->render('admin/newTarifJour.html.twig', [
            'formTarif' => $form->createView()
        ]);

    }

        /**
     * @Route("/admin/new/tarif/wk", name="new_tarif_wk")
     */
    public function newTarifWk(Request $request, EntityManagerInterface $manager) {
        
        $wk = new WeekEnd();
        
        $form = $this->createForm(WkType::class, $wk);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $wk->setWkDatePrix(new \DateTime());
            $manager->persist($wk);
            $manager->flush();
            $this->addFlash('success', 'Le tarif Week-end a été crée/modifié avec succès !');
            return $this->redirectToRoute('tarifs_admin');
        }
        return $this->render('admin/newTarifWk.html.twig', [
            'formTarifWk' => $form->createView()
        ]);

    }

    /**
     * @Route("/admin/new/tarif/assu", name="new_tarif_assu")
     */
    public function newTarifAssu(Request $request, EntityManagerInterface $manager) {
        
        $assurance = new Assurance();
        
        $form = $this->createForm(AssuranceType::class, $assurance);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $assurance->setAssuranceDatePrix(new \DateTime());
            $manager->persist($assurance);
            $manager->flush();
            $this->addFlash('success', 'Le tarif Assurance a été crée/modifié avec succès !');
            return $this->redirectToRoute('tarifs_admin');
        }
        return $this->render('admin/newTarifAssu.html.twig', [
            'formTarifAssu' => $form->createView()
        ]);

    }

    //GESTION CLIENTS (AJOUT d'admins)

    /**
     * @Route("/admin/clients", name="clients_admin")
     */
    public function clientGestion(ClientRepository $repo): Response{

        $clients = $repo->findAll();
        return $this->render('admin/clients.html.twig',[
            'clients' => $clients,
        ]);
    }

    /**
     * @Route("/admin/client/{id}", name="edit_client")
     */
    public function editClient(Request $request, EntityManagerInterface $manager, 
    ClientRepository $repo, $id = null): Response {
        
        $clients = $repo->findOneById($id);
        $form = $this->createForm(InscriptionAdminType::class, $clients);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){
            
            $manager->persist($clients);
            $manager->flush();
            $this->addFlash('success', 'Le client a été  modifié avec succès !');
            return $this->redirectToRoute('clients_admin', [
                'id' => $clients->getId()]);
        }
        return $this->render('admin/inscriptionEdit.html.twig', [
            'formInscriptionAdmin' => $form->createView(),
            'editMode' => $clients->getId() !== null,
            'clients' => $clients

        ]);

    }

    //GESTION RESERVATIONS

    /**
     * @Route("/admin/reservations", name="reservations_admin")
     */
    public function reservationGestion(ReserverRepository $repo): Response{

        $reservations = $repo->findAll();
        return $this->render('admin/reservations.html.twig',[
            'reservations' => $reservations,
        ]);
    }

    /**
     * @Route("/admin/resa/{id}", name="edit_resa")
     */
    public function editResa(Request $request, EntityManagerInterface $manager, 
    ReserverRepository $repo, $id = null): Response {
        
        $reservations = $repo->findOneById($id);
        $form = $this->createForm(ReservationEditType::class, $reservations);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($reservations);
            $manager->flush();
            
            return $this->redirectToRoute('reservations_admin', [
                'id' => $reservations->getId()]);
        }
        return $this->render('admin/resaEdit.html.twig', [
            'formReservationEdit' => $form->createView(),
            'reservations' => $reservations,

        ]);

    }
}
