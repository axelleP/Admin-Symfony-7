<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(targetEntity: Article::class, mappedBy: 'category', cascade: ['remove'])]
    private Collection $articles;

    #[ORM\Column(length: 30)]
    #[Assert\Type('string')]
    #[Assert\NotBlank(message: 'not_blank')]
    #[Assert\Length(
        max: 30,
        maxMessage: 'category.code.length',
    )]
    private ?string $code = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Assert\Type('integer')]
    #[Assert\NotBlank(message: 'not_blank', groups: ['update'])]
    #[Assert\Positive(message: 'positive')]
    private ?int $position = null;

    #[ORM\Column(length: 50)]
    #[Assert\Type('string')]
    #[Assert\NotBlank(message: 'not_blank')]
    #[Assert\Length(
        max: 50,
        maxMessage: 'category.name.length',
    )]
    private ?string $name_fr = null;

    #[ORM\Column(length: 50)]
    #[Assert\Type('string')]
    #[Assert\NotBlank(message: 'not_blank')]
    #[Assert\Length(
        max: 50,
        maxMessage: 'category.name.length',
    )]
    private ?string $name_en = null;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getNameFr(): ?string
    {
        return $this->name_fr;
    }

    public function setNameFr(string $name_fr): static
    {
        $this->name_fr = $name_fr;

        return $this;
    }

    public function getNameEn(): ?string
    {
        return $this->name_en;
    }

    public function setNameEn(string $name_en): static
    {
        $this->name_en = $name_en;

        return $this;
    }

    public function getArticles(): Collection
    {
        return $this->articles;
    }
}
