<?php

namespace App\Dto;

class NotificationDto
{
    private string $title;
    private string $description;
    private string $ctaUrl;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): NotificationDto
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): NotificationDto
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getCtaUrl(): string
    {
        return $this->ctaUrl;
    }

    /**
     * @param string $ctaUrl
     */
    public function setCtaUrl(string $ctaUrl): NotificationDto
    {
        $this->ctaUrl = $ctaUrl;

        return $this;
    }
}
