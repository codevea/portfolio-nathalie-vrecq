<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\SettingsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SettingsRepository::class)]
class Settings
{
    #[ORM\Id]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\Type(type: 'integer')]
    #[ORM\Column(type: types::INTEGER)]
    private int $id = 1;

    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^[a-zA-ZÀ-ÖØ-öø-ÿ0-9 \-\',]+$/',
        message: 'Le champ doit uniquement contenir des lettres (minuscules ou majuscules, avec accents), des chiffres, des espaces, des tirets, des virgules, des apostrophes et aucun autre caractère.'
    )]
    #[Assert\Length(min: 5, max: 255)]
    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $title = '';

    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^[a-zA-ZÀ-ÖØ-öø-ÿ0-9 \-\',]+$/',
        message: 'Le champ doit uniquement contenir des lettres (minuscules ou majuscules, avec accents), des chiffres, des espaces, des tirets, des virgules, des apostrophes et aucun autre caractère.'
    )]
    #[Assert\Length(min: 5, max: 255)]
    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $subTitle = '';

    #[Assert\Length(min: 5, max: 1200)]
    #[Assert\NotBlank]
    #[ORM\Column(type: Types::TEXT)]
    private string $content = '';

    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^[a-zA-ZÀ-ÖØ-öø-ÿ0-9 \-]+$/',
        message: 'Le champ doit uniquement contenir des lettres (minuscules ou majuscules, avec accents), des chiffres, des espaces, des tirets et aucun autre caractère.'
    )]
    #[Assert\Length(min: 2, max: 255)]
    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $lastName = '';

    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^[a-zA-ZÀ-ÖØ-öø-ÿ0-9 \-]+$/',
        message: 'Le champ doit uniquement contenir des lettres (minuscules ou majuscules, avec accents), des chiffres, des espaces, des tirets et aucun autre caractère.'
    )]
    #[Assert\Length(min: 2, max: 255)]
    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $firstName = '';

    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^[a-zA-ZÀ-ÖØ-öø-ÿ0-9 \-\',]+$/',
        message: 'Le champ doit uniquement contenir des lettres (minuscules ou majuscules, avec accents), des chiffres, des espaces, des tirets, des virgules, des apostrophes et aucun autre caractère.'
    )]
    #[Assert\Length(min: 5, max: 255)]
    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $address = '';

    #[Assert\Email]
    #[Assert\NotBlank]
    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $email = '';

    #[Assert\Length(min: 10, max: 10)]
    #[ORM\Column(type: Types::STRING, length: 10, nullable: true)]
    private ?string $phone = null;

    #[Assert\Length(min: 10, max: 10)]
    #[ORM\Column(type: Types::STRING, length: 10, nullable: true)]
    private ?string $mobile = null;

    #[Assert\Url(protocols: ['https'])]
    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $facebook = null;

    #[Assert\Url(protocols: ['https'])]
    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $github = null;

    #[Assert\Url(protocols: ['https'])]
    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $linkedin = null;

    #[Assert\Length(min: 2, max: 100)]
    #[ORM\Column(type: Types::STRING, length: 100, nullable:  true)]
    private ?string $copyright = null;

    #[Assert\Length(min: 2, max: 100)]
    #[ORM\Column(type: Types::STRING, length: 100, nullable: true)]
    private ?string $version = null;

    #[Assert\Length(min: 2, max: 100)]
    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $technology = null;

    #[Assert\Length(min: 2, max: 255)]
    #[Assert\NotBlank]
    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $province = '';

    #[Assert\Length(min: 10, max: 1200)]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $messageAbout = null;

    #[Assert\Length(min: 10, max: 1200)]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $messageSkills = null;


    public function getId(): int
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

    public function getSubTitle(): string
    {
        return $this->subTitle;
    }

    public function setSubTitle(string $subTitle): static
    {
        $this->subTitle = $subTitle;

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
    

    public function getLastName(): string
    {
        return $this->lastName;
    }


    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(?string $mobile): static
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): static
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getGithub(): ?string
    {
        return $this->github;
    }

    public function setGithub(?string $github): static
    {
        $this->github = $github;

        return $this;
    }

    public function getLinkedin(): ?string
    {
        return $this->linkedin;
    }

    public function setLinkedin(?string $linkedin): static
    {
        $this->linkedin = $linkedin;

        return $this;
    }

    public function getCopyright(): ?string
    {
        return $this->copyright;
    }

    public function setCopyright(string $copyright): static
    {
        $this->copyright = $copyright;

        return $this;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(?string $version): static
    {
        $this->version = $version;

        return $this;
    }

    public function getTechnology(): ?string
    {
        return $this->technology;
    }

    public function setTechnology(?string $technology): static
    {
        $this->technology = $technology;

        return $this;
    }

    public function getProvince(): string
    {
        return $this->province;
    }

    public function setProvince(string $province): static
    {
        $this->province = $province;

        return $this;
    }

    public function getMessageAbout(): ?string
    {
        return $this->messageAbout;
    }

    public function setMessageAbout(?string $messageAbout): static
    {
        $this->messageAbout = $messageAbout;

        return $this;
    }

    public function getMessageSkills(): ?string
    {
        return $this->messageSkills;
    }

    public function setMessageSkills(?string $messageSkills): static
    {
        $this->messageSkills = $messageSkills;

        return $this;
    }

}
