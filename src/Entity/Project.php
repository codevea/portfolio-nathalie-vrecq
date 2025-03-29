<?php
declare(strict_types=1);

namespace App\Entity;

use Stringable;
use DateTimeImmutable;
use App\Entity\Category;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
#[UniqueEntity('title')]
#[UniqueEntity('slug')]
#[Vich\Uploadable]
class Project implements Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[Assert\Length( min: 5, max: 255)]
    #[Assert\Regex(
        pattern: '/^[a-zA-ZÀ-ÖØ-öø-ÿ \-]+$/',
        message: 'Le champ doit uniquement contenir des lettres (minuscules ou majuscules, avec accents), des espaces, des tirets et aucun autre caractère.'
    )]
    #[ORM\Column(type: types::STRING, length: 255, unique: true)]
    private string $title = '';

    #[Assert\NotBlank]
    #[Assert\Length(min: 5, max: 255)]
    #[Assert\Regex(
        pattern: '/^[a-z]+(?:-[a-z]+)*$/',
        message: 'Le slug doit uniquement contenir des lettres minuscules et des tirets.'
    )]
    #[ORM\Column(type: types::STRING, length: 255, unique: true)]
    private string $slug = '';

    #[Assert\NotBlank]
    #[Assert\Length( min: 5, max: 1200)]
    #[ORM\Column(type: Types::TEXT)]
    private string $content = '';

    #[Assert\NotNull]
    #[Assert\Type(type: \DateTimeImmutable::class)]
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $createdAt;

    #[Assert\Type(type: \DateTimeImmutable::class)]
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[Assert\Url(protocols: ['https'])]
    #[ORM\Column(type: types::STRING, length: 255, nullable: true)]
    private ?string $url = null;

    /**
     * @var Collection<int, Technology>
     */
    #[ORM\ManyToMany(targetEntity: Technology::class, cascade: ['remove', 'persist'])]
    private ?Collection $technology = null;

    #[Vich\UploadableField(mapping: 'project', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $imageName = null;

    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^[a-z]+(?:-[a-z]+)*$/',
        message: 'Le slug doit uniquement contenir des lettres minuscules et des tirets.'
    )]
    #[ORM\Column(type: Types::STRING, length: 255, unique: true)]
    private string $imageSlug = '';

    #[Assert\Type(Category::class)]
    #[ORM\ManyToOne(inversedBy: 'projects')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
        $this->technology = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): static
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return Collection<int, Technology>
     */
    public function getTechnology(): Collection
    {
        return $this->technology;
    }

    public function addTechnology(Technology $technology): static
    {
        if (!$this->technology->contains($technology)) {
            $this->technology->add($technology);
        }

        return $this;
    }

    public function removeTechnology(Technology $technology): static
    {
        $this->technology->removeElement($technology);

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
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

    public function __toString(): string
    {
        return $this->title;
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
