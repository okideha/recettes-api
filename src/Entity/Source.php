<?php

namespace App\Entity;

use App\Repository\SourceRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\HasIdTrait;
use App\Entity\Traits\HasNameTrait;
use App\Entity\Traits\HasDescriptionTrait;
use Gedmo\Timestampable\Traits\TimestampableEntity as TimestampableTrait;

#[ORM\Entity(repositoryClass: SourceRepository::class)]
class Source
{
    use HasIdTrait;
    use HasNameTrait;
    use HasDescriptionTrait;
    use TimestampableTrait;

    #[ORM\Column(length: 255)]
    private ?string $url = null;


    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }
}
