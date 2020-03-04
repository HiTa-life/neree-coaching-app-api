<?php

namespace App\Controller;

use App\Entity\Test;
use App\Entity\UserAccountCreation;
use App\Entity\UserActionPlanCreation;
use App\Repository\UserAccountCreationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\Normalizer\NormalizableInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class UserAccountCreationController
 * @package App\Controller
 *
 * @Route ("/user/account/creation")
 */

class UserAccountCreationController extends ApiController
{


    /**
     *
     * @Route(
     *     "/",
     *     name="user_account_creation_index",
     *     methods={"GET"}
     *     )
     */

    public function index(UserAccountCreationRepository $user
    ): Response
    {
        $response = new Response();
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE,OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', '*');
        try {
            $user = $this->getDoctrine()->getRepository(UserAccountCreation::class);
            $results = $user->findAll();
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
     *
     * "/new",
     *  name="user_account_creation_create",
     *  methods={"GET","POST"})
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function create(
        Request $request,
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager,
UserPasswordEncoderInterface $encoder)
        : JsonResponse
    {
        try {
            $jsonRecu = $request->getContent();
            $post = $serializer->deserialize(
                $jsonRecu,
                UserAccountCreation::class,
                'json');
            $post->setPassword($encoder->encodePassword($post,$post->getPassword()));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();
            return $this->json($post, 201, []);
        }
        catch (NotEncodableValueException $e) {
            return $this->json(['status' => 400,
                'message' => $e->getMessage()], 400);
        }
    }

    /**
     * @Route(
     *     "/show",
     *      name="user_account_creation_show",
     *     methods={"GET"}
     *     )
     *
     */
    public function show(UserAccountCreationRepository $user
    ): Response

    {
        $response = new Response();
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE,OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', '*');
        try {
            $user = $this->getDoctrine()->getRepository(UserAccountCreation::class);
            $results = $user->findAll();
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
     *      name="user_account_creation_show_one",
     *     methods={"GET"}
     *     )
     *
     */
    public function showOneUser(UserAccountCreationRepository $user, Request $request
    ): Response

    {
        $response = new Response();
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE,OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', '*');
        try {
            $user = $this->getDoctrine()->getRepository(UserAccountCreation::class);
            $results = $user->find($request->get('id'));
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
     *     "/edit/{id}",
     *      name="user_account_creation_edit",
     *     methods={"PUT"}
     *     )
     */
    public function edit($id,
                         Request $request,
                         SerializerInterface $serializer,
                         UserAccountCreation $userAccountCreation,
                         EntityManagerInterface $entityManager,
                         UserAccountCreationRepository $userAccountCreationRepository):
    JsonResponse
    {
        $user = new UserAccountCreation();
        try {
            $data = $this->getDoctrine()->getRepository(UserAccountCreation::class)
                ->find($request->get("id"));
              if($this->getDoctrine()->getRepository(UserAccountCreation::class)
                ->find($request->get("id"))) {
                  $jsonRecu = $request->getContent();
                  $array = json_decode($request->getContent(), true);
                  $user = $userAccountCreation->setSurname($array["surname"]);
                    $entityManager->persist($user);
               $entityManager->flush();
                return $this->json($user, 201, []);
                }

        } catch (NotEncodableValueException $e) {
            return $this->json(['status' => 400,
               'message' => $e->getMessage()], 400);
     }
    }


//        $form = $this->createForm(UserAccountCreationType::class, $userAccountCreation);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('user_account_creation_index');
//        }
//
//        return $this->render('user_account_creation/edit.html.twig', [
//            'user_account_creation' => $userAccountCreation,
//            'form' => $form->createView(),
//        ]);


    /**
     * @Route(
     *     "/delete/{id}",
     *     name="user_account_creation_delete",
     *     methods={"DELETE"}
     *     )
     */
    public function delete(Request $request, UserAccountCreation $userAccountCreation): Response
    {

        if ($this->getDoctrine()->getRepository(UserAccountCreation::class)
            ->find($request->get("id"))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userAccountCreation);
            $entityManager->flush();

            return $this->json([
                'content' => 'user deleted',
                'status' => 200]);
        }
       return $this->json([
           'content' => 'Unauthorized Request',
           'status' => 401,
       ]) ;

    }
}
