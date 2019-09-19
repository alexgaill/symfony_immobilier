<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use App\Form\PropertyType;

class AdminPropertyController extends AbstractController{

    /**
     * @var PropertyRepository
     */
    private $repository;

    public function __construct(PropertyRepository $repository, ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->repository = $repository;
    }

    /**
     * @Route("/admin", name="admin.property.index")
     * @return Response
     */
    public function index() : Response
    {
        $properties = $this->repository->findAll();
        return $this->render('admin/index.html.twig', compact('properties'));
    }

    /**
     * @Route("/admin/create", name="admin.property.new")
     */
    public function new(Request $request){

        $property = new Property();
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($property);
            $this->manager->flush();
            $this->addFlash("success", "Créé avec succès");
            return $this->redirectToRoute('admin.property.index');
        }

        return $this->render("admin/new.html.twig", [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/{id}", name="admin.property.edit", methods="GET|POST")
     * @param Property $property
     */
    public function edit(Property $property, Request $request)
    {
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->flush();
            $this->addFlash("success", "Modifié avec succès");
            return $this->redirectToRoute('admin.property.index');
        }

        return $this->render("admin/edit.html.twig", [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/{id}", name="admin.property.delete", methods="DELETE")
     * @param Property $property
     */
    public function delete(Property $property, Request $request)
    {
        if ($this->isCsrfTokenValid('delete'. $property->getId(), $request->get('_token'))){

            $this->manager->remove($property);
            $this->manager->flush();
            $this->addFlash("success", "Supprimé avec succès");
        }
        return $this->redirectToRoute('admin.property.index');
    }
}

?>