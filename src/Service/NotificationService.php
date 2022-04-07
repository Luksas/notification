<?php

namespace App\Service;

use App\Entity\User;
use App\Service\NotificationRules\NotificationRuleInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class NotificationService
{
    private SerializerInterface $serializer;
    private iterable $notificationRules;

    /**
     * @param SerializerInterface $serializer
     * @param NotificationRuleInterface[]|iterable $notificationRules
     */
    public function __construct(SerializerInterface $serializer, iterable $notificationRules)
    {
        $this->notificationRules = $notificationRules;
        $this->serializer = $serializer;
    }

    public function GetNotifications(User $user): Response
    {
        $notifications = [];

        /** @var NotificationRuleInterface $rule */
        foreach ($this->notificationRules as $rule) {
            if ($rule->IsValid($user)) {
                $notifications[] = $rule->GetNotification();
            }
        }

        return new JsonResponse($this->serializer->serialize($notifications, "json"), Response::HTTP_OK, [], true);
    }
}
