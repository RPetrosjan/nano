<?php

namespace App\Entity;

use App\Repository\TypeSectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeSectionRepository::class)]
class TypeSection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 128)]
    private ?string $title = null;

    #[ORM\OneToMany(mappedBy: 'typeSection', targetEntity: Questions::class)]
    private Collection $questions;

    #[ORM\OneToMany(mappedBy: 'typeSection', targetEntity: Documentation::class)]
    private Collection $documentations;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->documentations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection<int, Questions>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Questions $question): static
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setTypeSection($this);
        }

        return $this;
    }

    public function removeQuestion(Questions $question): static
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getTypeSection() === $this) {
                $question->setTypeSection(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->title ?? '';
    }

    /**
     * @return Collection<int, Documentation>
     */
    public function getDocumentations(): Collection
    {
        return $this->documentations;
    }

    public function addDocumentation(Documentation $documentation): self
    {
        if (!$this->documentations->contains($documentation)) {
            $this->documentations->add($documentation);
            $documentation->setTypeSection($this);
        }

        return $this;
    }

    public function removeDocumentation(Documentation $documentation): self
    {
        if ($this->documentations->removeElement($documentation)) {
            // set the owning side to null (unless already changed)
            if ($documentation->getTypeSection() === $this) {
                $documentation->setTypeSection(null);
            }
        }

        return $this;
    }
}
