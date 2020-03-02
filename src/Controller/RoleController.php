<?php

namespace App\Controller;

use App\Entity\Role;
use App\Form\RoleType;
use App\Repository\RoleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/role")
 */
class RoleController extends AbstractController
{
    /**
     * @Route("/", name="role_index", methods={"GET"})
     */
    public function index(RoleRepository $roleRepository): Response
    {
        return $this->render('role/index.html.twig', [
            'roles' => $roleRepository->findAll(),
        ]);
    }

    /**
     * @Route(
     *     "/new",
     *     name="role_new",
     *      methods={"GET","POST"})
     * @param Request $request
     * @param Role $role
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     * @param EntityManager $entityManager
     * @return Response
     */
    public function new(Request $request,
                        Role $role,
                        SerializerInterface $serializer,
                        ValidatorInterface $validator,
                        EntityManagerInterface $entityManager
    ): Response
    {
        $role = new Role();
        $response = new Response(json_encode($role));
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE,OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', '*');
        try {
            $jsonRecu = $request->getContent();
            $role = $serializer->deserialize(
                $jsonRecu,
                Role::class,
                'json');
            $errors = $validator->validate($role);
            if (count($errors) > 0) {
                return $this->json($errors, 400);
            }
            $entityManager->persist($role);
            $entityManager->getDoctrine()->getManager()->flush();
            $this->json($role, 201, []);

            return $response;
        } catch (NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
//        $role = new Role();
//        $form = $this->createForm(RoleType::class, $role);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($role);
//            $entityManager->flush();
//
//            return $this->redirectToRoute('role_index');
//        }
//
//        return $this->render('role/new.html.twig', [
//            'role' => $role,
//            'form' => $form->createView(),
//        ]);
        }
    }

    /**
     * @Route("/{id}", name="role_show", methods={"GET"})
     */
    public function show(Role $role): Response
    {
        return $this->render('role/show.html.twig', [
            'role' => $role,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="role_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Role $role): Response
    {
        $form = $this->createForm(RoleType::class, $role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('role_index');
        }

        return $this->render('role/edit.html.twig', [
            'role' => $role,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="role_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Role $role): Response
    {
        if ($this->isCsrfTokenValid('delete'.$role->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($role);
            $entityManager->flush();
        }

        return $this->redirectToRoute('role_index');
    }
}
