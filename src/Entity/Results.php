<?php

namespace App\Entity;

use App\Repository\ResultsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResultsRepository::class)]
class Results
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64)]
    private ?string $nResult = null;

    #[ORM\ManyToOne(inversedBy: 'results')]
    private ?Questions $question = null;

    #[ORM\Column(nullable: true)]
    private ?bool $success = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNResult(): ?string
    {
        return $this->nResult;
    }

    public function setNResult(string $nResult): self
    {
        $this->nResult = $nResult;

        return $this;
    }

    public function getQuestion(): ?Questions
    {
        return $this->question;
    }

    public function setQuestion(?Questions $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function isSuccess(): ?bool
    {
        return $this->success;
    }

    public function setSuccess(?bool $success): self
    {
        $this->success = $success;

        return $this;
    }
}
