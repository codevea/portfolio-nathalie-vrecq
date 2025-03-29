<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\MonitoringRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: MonitoringRepository::class)]
#[UniqueEntity('title')]
class Monitoring
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^[a-zA-ZÀ-ÖØ-öø-ÿ0-9 \-]+$/',
        message: 'Le champ doit uniquement contenir des lettres (minuscules ou majuscules, avec accents), des chiffres, des espaces, des tirets et aucun autre caractère.'
    )]
    #[Assert\Length( min: 2, max: 255)]
    #[ORM\Column(length: 255, unique: true)]
    private string $title = '';

    #[Assert\Length(min: 5, max: 1200)]
    #[Assert\NotBlank]
    #[ORM\Column(type: Types::TEXT)]
    private string $content = '';

    #[Assert\Length(min: 5, max: 255)]
    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    private string $category = '';

    #[Assert\Length( min: 5, max: 255)]
    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    private string $uxicon = '';

    #[Assert\Url(protocols: ['https'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $url = null;

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

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getUxicon(): string
    {
        return $this->uxicon;
    }

    public function setUxicon(string $uxicon): static
    {
        $this->uxicon = $uxicon;

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

}
