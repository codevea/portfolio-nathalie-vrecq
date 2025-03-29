<?php
declare(strict_types=1);

namespace App\Entity;

use Stringable;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TechnologyRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TechnologyRepository::class)]
class Technology implements Stringable
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
    #[Assert\Length(min: 5, max: 255)]
    #[ORM\Column(length: 255)]
    private string $name = '';

    public function getId(): ?int
    {
        return $this->id;
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

    public function __toString(): string
    {
        return $this->name;
    }

}
