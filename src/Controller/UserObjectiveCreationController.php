<?php

namespace App\Controller;

use App\Entity\UserObjectiveCreation;
use App\Form\UserObjectiveCreationType;
use App\Repository\UserObjectiveCreationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/user/objective/creation")
 */
class UserObjectiveCreationController extends AbstractController
{
    /**
     * @Route("/", name="user_objective_creation_index", methods={"GET"})
     */
    public function index(UserObjectiveCreationRepository $userObjectiveCreationRepository): Response
    {
        return $this->render('user_objective_creation/index.html.twig', [
            'user_objective_creations' => $userObjectiveCreationRepository->findAll(),
        ]);
    }

    /**
     * @Route(
     *     "/new",
     *     name="user_objective_creation_new",
     *     methods={"POST"})
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function create(Request $request,
                           EntityManagerInterface $entityManager,
                           SerializerInterface $serializer)
    : JsonResponse
    {
        try {
            $jsonRecu = $request->getContent();
            $post = $serializer->deserialize(
                $jsonRecu,
                UserObjectiveCreation::class,
                'json');
            $entityManager->persist($post);
            $entityManager->flush();
            return $this->json($post, 201, []);
        } catch (NotEncodableValueException $e) {
            return $this->json(['status' => 400,
                'message' => $e->getMessage()], 400);
        }
    }

    /**
     * @Route("/{id}", name="user_objective_creation_show", methods={"GET"})
     */
    public function show(UserObjectiveCreation $userObjectiveCreation): Response
    {
        return $this->render('user_objective_creation/show.html.twig', [
            'user_objective_creation' => $userObjectiveCreation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_objective_creation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UserObjectiveCreation $userObjectiveCreation): Response
    {
        $form = $this->createForm(UserObjectiveCreationType::class, $userObjectiveCreation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_objective_creation_index');
        }

        return $this->render('user_objective_creation/edit.html.twig', [
            'user_objective_creation' => $userObjectiveCreation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_objective_creation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, UserObjectiveCreation $userObjectiveCreation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userObjectiveCreation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userObjectiveCreation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_objective_creation_index');
    }
}
