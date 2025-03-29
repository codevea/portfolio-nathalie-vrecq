<?php
declare(strict_types=1);

namespace App\Entity;

use Stringable;
use App\Entity\Project;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category implements Stringable
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
    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $name = '';

    /**
     * @var Collection<int, Project>
     */
    #[ORM\OneToMany(targetEntity: Project::class, mappedBy: 'category')]
    private Collection $projects;

    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^[a-z]+(?:-[a-z]+)*$/',
        message: 'Le slug doit uniquement contenir des lettres minuscules et des tirets.'
    )]
    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
    }

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

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Collection<int, Project>
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): static
    {
        if (!$this->projects->contains($project)) {
            $this->projects->add($project);
            $project->setCategory($this);
        }

        return $this;
    }

    public function removeProject(Project $project): static
    {
        if ($this->projects->removeElement($project)) {
            // set the owning side to null (unless already changed)
            if ($project->getCategory() === $this) {
                $project->setCategory(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }
}
