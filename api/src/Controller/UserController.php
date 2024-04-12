<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/users')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(SerializerInterface $serializer, UserRepository $userRepository): JsonResponse
    {
        return new JsonResponse($serializer->serialize(
            $userRepository->findAll(),
            JsonEncoder::FORMAT
        ), Response::HTTP_OK, [], true);
    }

    #[Route('/', name: 'app_user_create', methods: ['POST'])]
    public function create(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager, ValidatorInterface $validator): Response
    {
        // Сериализацию можно было бы вынести в отдельный слой
        $data = json_decode($request->getContent());
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Invalid JSON');
        }

        $user = (new User())->init($data);

        $errors = $validator->validate($user);

        if (!empty(count($errors)))
            return new Response($errors[0], 409);

        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse($serializer->serialize(
            $user,
            JsonEncoder::FORMAT
        ), Response::HTTP_OK, [], true);
    }

    #[Route('/{id}', name: 'app_user_update', methods: ['PUT'])]
    public function show(Request $request, User $user, SerializerInterface $serializer, EntityManagerInterface $entityManager, ValidatorInterface $validator): Response
    {
        // Сериализацию можно было бы вынести в отдельный слой
        $data = json_decode($request->getContent());
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Invalid JSON');
        }

        $user->init($data);

        $errors = $validator->validate($user);

        if (!empty(count($errors)))
            return new Response($errors[0], 409);

        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse($serializer->serialize(
            $user,
            JsonEncoder::FORMAT
        ), Response::HTTP_OK, [], true);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['DELETE'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($user);
        $entityManager->flush();
        return new Response(null, Response::HTTP_OK);
    }
}
