<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\TimelineRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: TimelineRepository::class)]
#[UniqueEntity('title')]
#[UniqueEntity('imageSlug')]
#[Vich\Uploadable]
class Timeline
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^[a-zA-ZÀ-ÖØ-öø-ÿ \-]+$/',
        message: 'Le champ doit uniquement contenir des lettres (minuscules ou majuscules, avec accents), des espaces, des tirets et aucun autre caractère.'
    )]
    #[Assert\Length(min: 2, max: 255)]
    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $title = '';

    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 1200)]
    #[ORM\Column(type: Types::TEXT)]
    private string $content = '';

    #[Assert\NotNull]
    #[Assert\Type(type: \DateTime::class)]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private \DateTime $date;

    #[Vich\UploadableField(mapping: 'badge', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $imageName = null;
  
    #[Assert\NotNull]
    #[Assert\Type(type: \DateTimeImmutable::class)]
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $createdAt;

    #[Assert\Type(type: \DateTimeImmutable::class)]
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[Assert\NotNull]
    #[Assert\Url(protocols: ['https'])]
    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $imageUrl = '';

    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^[a-z]+(?:-[a-z]+)*$/',
        message: 'Le slug doit uniquement contenir des lettres minuscules et des tirets.'
    )]
    #[ORM\Column(type: Types::STRING, length: 255, unique: true)]
    private string $imageSlug = '';

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): static
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getImageSlug(): string
    {
        return $this->imageSlug;
    }

    public function setImageSlug(string $imageSlug): static
    {
        $this->imageSlug = $imageSlug;

        return $this;
    }

}
