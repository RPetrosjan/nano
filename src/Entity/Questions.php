<?php

namespace App\Entity;

use App\Repository\QuestionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionsRepository::class)]
class Questions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $question = null;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: Results::class)]
    private Collection $results;

    #[ORM\Column(nullable: true)]
    private ?int $nReponse = null;

    #[ORM\OneToMany(mappedBy: 'questions', targetEntity: Reponses::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $reponses;

    #[ORM\ManyToOne(cascade: ['persist'], inversedBy: 'questions')]
    private ?TypeSection $typeSection = null;

    public function __construct()
    {
        $this->results = new ArrayCollection();
        $this->reponses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    /**
     * @return Collection<int, Results>
     */
    public function getResults(): Collection
    {
        return $this->results;
    }

    public function addResult(Results $result): self
    {
        if (!$this->results->contains($result)) {
            $this->results->add($result);
            $result->setQuestion($this);
        }

        return $this;
    }

    public function removeResult(Results $result): self
    {
        if ($this->results->removeElement($result)) {
            // set the owning side to null (unless already changed)
            if ($result->getQuestion() === $this) {
                $result->setQuestion(null);
            }
        }

        return $this;
    }

    public function getNReponse(): ?int
    {
        return $this->nReponse;
    }

    public function setNReponse(?int $nReponse): self
    {
        $this->nReponse = $nReponse;

        return $this;
    }

    /**
     * @return Collection<int, Reponses>
     */
    public function getReponses(): Collection
    {
        return $this->reponses;
    }

    public function addReponse(Reponses $reponse): static
    {
        if (!$this->reponses->contains($reponse)) {
            $this->reponses->add($reponse);
            $reponse->setQuestions($this);
        }

        return $this;
    }

    public function removeReponse(Reponses $reponse): static
    {
        if ($this->reponses->removeElement($reponse)) {
            // set the owning side to null (unless already changed)
            if ($reponse->getQuestions() === $this) {
                $reponse->setQuestions(null);
            }
        }

        return $this;
    }

    public function getTypeSection(): ?TypeSection
    {
        return $this->typeSection;
    }

    public function setTypeSection(?TypeSection $typeSection): static
    {
        $this->typeSection = $typeSection;

        return $this;
    }
}
