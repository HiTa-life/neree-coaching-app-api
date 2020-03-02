<?php

namespace App\Controller;

use App\Entity\UserActionPlanCreation;
use App\Form\UserActionPlanCreationType;
use App\Repository\UserActionPlanCreationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/user/action/plan/creation")
 */
class UserActionPlanCreationController extends AbstractController
{
    /**
     * @Route("/", name="user_action_plan_creation_index", methods={"GET"})
     */
    public function index(UserActionPlanCreationRepository $userActionPlanCreationRepository): Response
    {
        return $this->render('user_action_plan_creation/index.html.twig', [
            'user_action_plan_creations' => $userActionPlanCreationRepository->findAll(),
        ]);
    }

    /**
     * @Route(
     *     "/new",
     *     name="user_action_plan_creation_new",
     *     methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request,
SerializerInterface $serializer,
EntityManagerInterface $entityManager)
    : JsonResponse
    {
        try {
            $jsonRecu = $request->getContent();
            $post = $serializer->deserialize(
                $jsonRecu,
                UserActionPlanCreation::class,
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
     * @Route(
     *     "show/{id}",
     *      name="user_action_plan_creation_show",
     *     methods={"GET"})
     */
    public function show(UserActionPlanCreation $userActionPlanCreation): Response
    {
        return $this->render('user_action_plan_creation/show.html.twig', [
            'user_action_plan_creation' => $userActionPlanCreation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_action_plan_creation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UserActionPlanCreation $userActionPlanCreation): Response
    {
        $form = $this->createForm(UserActionPlanCreationType::class, $userActionPlanCreation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_action_plan_creation_index');
        }

        return $this->render('user_action_plan_creation/edit.html.twig', [
            'user_action_plan_creation' => $userActionPlanCreation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_action_plan_creation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, UserActionPlanCreation $userActionPlanCreation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userActionPlanCreation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userActionPlanCreation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_action_plan_creation_index');
    }
}
