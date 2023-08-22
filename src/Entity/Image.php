<?php

namespace App\Entity;

use App\Entity\Traits\HasDescriptionTrait;
use App\Entity\Traits\HasIdTrait;
use App\Entity\Traits\HasPriorityTrait;
use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\HasTimestampTrait as TimestampableTrait;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new Delete(security: "is_granted('ROLE_ADMIN') or object.isUserAllowedToEdit(user)"),
        new GetCollection(),
        new Post(security: "is_granted('ROLE_ADMIN') or object.isUserAllowedToEdit(user)"),
    ],
)]
#[Vich\Uploadable]
class Image
{
    use HasIdTrait;
    use HasDescriptionTrait;
    use HasPriorityTrait;
    use TimestampableTrait;

    #[ORM\Column(length: 255)]
    #[Groups(['get'])]
    private ?string $path = null;

    #[ORM\Column]
    #[Groups(['get'])]
    private ?int $size = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Recipe $recipe = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Step $step = null;

    #[Vich\UploadableField(mapping: 'images', fileNameProperty: 'path', size: 'size')]
    private ?File $file = null;

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): static
    {
        $this->path = $path;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): static
    {
        $this->recipe = $recipe;

        return $this;
    }

    public function getStep(): ?Step
    {
        return $this->step;
    }

    public function setStep(?Step $step): static
    {
        $this->step = $step;

        return $this;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(File|UploadedFile|null $file): Image
    {
        $this->file = $file;

        if (null !== $file) {
            $this->setUpdatedAt(new \DateTime());
        }

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->getPath();
    }
}
