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
     *
     * @Route(
     *     "/",
     *     name="user_action_plan_creation_index",
     *     methods={"GET"}
     *     )
     */

    public function index(UserActionPlanCreationRepository $actionPlanCreation
    ): Response
    {
        $response = new Response();
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE,OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', '*');
        try {
            $actionPlanCreation = $this->getDoctrine()->getRepository(UserActionPlanCreation::class);
            $results = $actionPlanCreation->findAll();
            return $this->json($results, $status = 200, $headers = [], $context = []);
        } catch (NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
        }
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
                           EntityManagerInterface $entityManager): JsonResponse
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
     *     "/show",
     *      name="user_action_plan_creation_show",
     *     methods={"GET"}
     *     )
     *
     */
    public function show(UserActionPlanCreationRepository $actionPlanCreationRepository
    ): Response

    {
        $response = new Response();
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE,OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', '*');
        try {
            $actionPlanCreationRepository = $this->getDoctrine()->getRepository(UserActionPlanCreation::class);
            $results = $actionPlanCreationRepository->findAll();
            return $this->json($results, $status = 200, $headers = [], $context = []);
        } catch (NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * @Route(
     *     "/show/{id}",
     *      name="user_action_plan_creation_show",
     *     methods={"GET"}
     *     )
     *
     */
    public function showOneAction(
        UserActionPlanCreationRepository $actionPlanCreationRepository,
        Request $request
    ): Response

    {
        $response = new Response();
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE,OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', '*');
        try {
            $actionPlanCreationRepository = $this->getDoctrine()->getRepository(UserActionPlanCreation::class);
            $results = $actionPlanCreationRepository->find($request->get('id'));
            return $this->json($results, $status = 200, $headers = [], $context = []);
        } catch (NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
        }
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
     * @Route(
     *     "/delete/{id}",
     *     name="user_action_plan_creation_delete",
     *     methods={"DELETE"}
     *     )
     */
    public function delete(
        Request $request,
        UserActionPlanCreation $actionPlanCreation)
    : Response
    {

        if ($this->getDoctrine()->getRepository(UserActionPlanCreation::class)
            ->find($request->get("id"))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($actionPlanCreation);
            $entityManager->flush();

            return $this->json([
                'content' => 'action deleted',
                'status' => 200]);
        }
        return $this->json([
            'content' => 'Unauthorized Request',
            'status' => 401,
        ]);
    }
}
