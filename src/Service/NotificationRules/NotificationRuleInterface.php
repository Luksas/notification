<?php

namespace App\Service\NotificationRules;

use App\Dto\NotificationDto;
use App\Entity\User;

interface NotificationRuleInterface
{
    public function GetNotification(): NotificationDto;

    public function IsValid(User $user): bool;
}
