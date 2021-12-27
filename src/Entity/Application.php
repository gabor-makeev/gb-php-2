<?php

namespace App\Entity;

use App\Repository\ApplicationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicationRepository::class)]
class Application
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 150)]
    private $name;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\ManyToOne(targetEntity: Company::class, inversedBy: 'applications')]
    #[ORM\JoinColumn(nullable: false)]
    private $company_id;

    #[ORM\ManyToMany(targetEntity: ProgrammingLang::class, inversedBy: 'applications')]
    private $ProgrammingLanguages;

    public function __construct()
    {
        $this->ProgrammingLanguages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCompanyId(): ?Company
    {
        return $this->company_id;
    }

    public function setCompanyId(?Company $company_id): self
    {
        $this->company_id = $company_id;

        return $this;
    }

    /**
     * @return Collection|ProgrammingLang[]
     */
    public function getProgrammingLanguages(): Collection
    {
        return $this->ProgrammingLanguages;
    }

    public function addProgrammingLanguage(ProgrammingLang $programmingLanguage): self
    {
        if (!$this->ProgrammingLanguages->contains($programmingLanguage)) {
            $this->ProgrammingLanguages[] = $programmingLanguage;
        }

        return $this;
    }

    public function removeProgrammingLanguage(ProgrammingLang $programmingLanguage): self
    {
        $this->ProgrammingLanguages->removeElement($programmingLanguage);

        return $this;
    }
}
