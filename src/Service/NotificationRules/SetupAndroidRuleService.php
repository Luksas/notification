<?php

namespace App\Service\NotificationRules;

use App\Constant\CountryConst;
use App\Dto\NotificationDto;
use App\Entity\Device;
use App\Entity\User;

class SetupAndroidRuleService implements NotificationRuleInterface
{
    public function GetNotification(): NotificationDto
    {
        return (new NotificationDto())
            ->setTitle("Setup android plz")
            ->setDescription("You need to setup android sir.")
            ->setCtaUrl("https://google.lt")
        ;
    }

    public function IsValid(User $user): bool
    {
        return $user->isFromCountry(CountryConst::COUNTRY_CODE_SPAIN)
            && !$user->IsPremium()
            && !$user->hasDevice(Device::PLATFORM_ANDROID)
            && ($user->getLastActiveAt()->diff(new \DateTime())->days > 7)
        ;
    }
}
