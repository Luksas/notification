<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\NotificationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NotificationController extends AbstractController
{
    private NotificationService $notificationService;

    /**
     * @param NotificationService $notificationService
     */
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    #[Route('/notifications', name: 'all_notifications')]
    public function notifications(Request $request, UserRepository $userRepository): Response
    {
        // Don't care about input verification right now.
        $user = $userRepository->find($request->query->get("user_id"));

        return $this->notificationService->GetNotifications($user);
    }
}
