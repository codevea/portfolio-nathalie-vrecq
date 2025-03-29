<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\SkillsRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: SkillsRepository::class)]
#[UniqueEntity('name')]
class Skills
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $progressbar = '';

    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^[a-zA-ZÀ-ÖØ-öø-ÿ0-9 \-]+$/',
        message: 'Le champ doit uniquement contenir des lettres (minuscules ou majuscules, avec accents), des chiffres, des espaces, des tirets et aucun autre caractère.'
    )]
    #[Assert\Length(min: 2, max: 255)]
    #[ORM\Column(type: Types::STRING, length: 255, unique: true)]
    private string $name = '';

    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $category = '';


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProgressbar(): string
    {
        return $this->progressbar;
    }

    public function setProgressbar(string $progressbar): static
    {
        $this->progressbar = $progressbar;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

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

}
