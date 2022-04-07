<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`users`')]
class User
{
    public const STATUS_ACTIVE = "active";
    public const STATUS_SUSPENDED = "suspended";

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string $email;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string $status;

    #[ORM\Column(type: 'integer', nullable: true)]
    private int $is_premium;

    #[ORM\Column(type: 'string', length: 2, nullable: true)]
    private string $country_code;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $last_active_at;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $created_at;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Device::class, orphanRemoval: true)]
    private $devices;

    public function __construct()
    {
        $this->devices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function IsPremium(): ?bool
    {
        return $this->is_premium;
    }

    public function setIsPremium(?bool $is_premium): self
    {
        $this->is_premium = $is_premium;

        return $this;
    }

    public function isFromCountry(string $countryCode): ?string
    {
        return $countryCode === $this->country_code;
    }

    public function getCountryCode(): ?string
    {
        return $this->country_code;
    }

    public function setCountryCode(?string $country_code): self
    {
        $this->country_code = $country_code;

        return $this;
    }

    public function getLastActiveAt(): ?\DateTimeImmutable
    {
        return $this->last_active_at;
    }

    public function setLastActiveAt(?\DateTimeImmutable $last_active_at): self
    {
        $this->last_active_at = $last_active_at;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getPlatform(): ?Device
    {
        return $this->platform;
    }

    public function setPlatform(?Device $platform): self
    {
        $this->platform = $platform;

        return $this;
    }

    public function hasDevice(string $type): bool
    {
        /** @var Device $device */
        foreach ($this->devices as $device) {
            if ($type === $device->getPlatform()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return Collection<int, Device>
     */
    public function getDevices(): Collection
    {
        return $this->devices;
    }

    public function addDevice(Device $device): self
    {
        if (!$this->devices->contains($device)) {
            $this->devices[] = $device;
            $device->setUserId($this);
        }

        return $this;
    }

    public function removeDevice(Device $device): self
    {
        if ($this->devices->removeElement($device)) {
            // set the owning side to null (unless already changed)
            if ($device->getUserId() === $this) {
                $device->setUserId(null);
            }
        }

        return $this;
    }
}
