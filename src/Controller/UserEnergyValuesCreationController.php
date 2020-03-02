<?php

namespace App\Controller;

use App\Entity\Test;
use App\Entity\UserEnergyValuesCreation;
use App\Form\UserEnergyValuesCreationType;
use App\Repository\UserEnergyValuesCreationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/user/energy/values/creation")
 */
class UserEnergyValuesCreationController extends AbstractController
{
    /**
     * @Route(
     *     "/",
     *     name="user_energy_values_creation_index",
     *     methods={"GET"})
     */
    public function index(UserEnergyValuesCreationRepository $userEnergyValuesCreationRepository): Response
    {
        {
            $response = new Response();
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->headers->set('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE,OPTIONS');
            $response->headers->set('Access-Control-Allow-Headers', '*');
            try {
                $results = $this->getDoctrine()->getRepository(UserEnergyValuesCreation::class)->findAll();
                return $this->json($results, $status = 200, $headers = [], $context = []);
            } catch (NotEncodableValueException $e) {
                return $this->json([
                    'status' => 400,
                    'message' => $e->getMessage()
                ], 400);
            }
        }
    }

    /**
     * @Route(
     *     "/new",
     *      name="user_energy_values_creation_new",
     *     methods={"GET","POST"})
     */


    public function create(Request $request,
                           SerializerInterface $serializer,
                           EntityManagerInterface $entityManager)
    {
        try {
            $jsonRecu = $request->getContent();
            $post = $serializer->deserialize($jsonRecu, UserEnergyValuesCreation::class, 'json');
            $entityManager->persist($post);
            $entityManager->flush();
            return $this->json($post, 201, []);
        } catch (NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
        }
    }


    /**
     * @Route(
     *     "/{id}",
     *     name="user_energy_values_creation_show",
     *     methods={"GET"})
     */
    public function show(UserEnergyValuesCreation $userEnergyValuesCreation): Response
    {
        return $this->render('user_energy_values_creation/show.html.twig', [
            'user_energy_values_creation' => $userEnergyValuesCreation,
        ]);
    }

    /**
     * @Route(
     *     "/edit/{id}",
     *     name="user_energy_values_creation_edit",
     *     methods={"PUT"})
     */
    public function edit($id,
                         Request $request,
                         UserEnergyValuesCreation $userEnergyValuesCreation,
                         SerializerInterface $serializer,
                         EntityManagerInterface $entityManager,
                         UserEnergyValuesCreationRepository $userEnergyValuesCreationRepository):
    JsonResponse
    {
        $results = $this->getDoctrine()
            ->getRepository(UserEnergyValuesCreation::class)
            ->find($id);


        if ($results) {
            try {
                $jsonRecu = $request->getContent() . $id;
                $post = $serializer->deserialize($jsonRecu, UserEnergyValuesCreation::class, 'json');

                $entityManager->persist($post);
                $entityManager->flush();
                return $this->json($post, 201, []);
            } catch (NotEncodableValueException $e) {
                return $this->json([
                    'status' => 400,
                    'message' => $e->getMessage()
                ], 400);
            }
        }
        return new JsonResponse('error');
    }


//
//
//        $form = $this->createForm(UserEnergyValuesCreationType::class, $userEnergyValuesCreation);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('user_energy_values_creation_index');
//        }
//
//        return $this->render('user_energy_values_creation/edit.html.twig', [
//            'user_energy_values_creation' => $userEnergyValuesCreation,
//            'form' => $form->createView(),
//        ]);


    /**
     * @Route(
     *     "delete/{id}",
     *      name="user_energy_values_creation_delete",
     *     methods={"DELETE"})
     */
    public function delete(Request $request, UserEnergyValuesCreation $userEnergyValuesCreation): Response
    {
        if ($this->getDoctrine()->getRepository(UserEnergyValuesCreation::class)
            ->find($request->get("id"))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userEnergyValuesCreation);
            $entityManager->flush();

            return $this->json([
                'content' => 'user deleted',
                'status' => 200]);
        }
        return $this->json([
            'content' => 'Unauthorized Request',
            'status' => 401,
        ]);
    }
}
