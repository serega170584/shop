<?php

namespace App\Entity;

use App\Repository\TestRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TestRepository::class)
 */
class Test
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=TestSubGroup::class, inversedBy="tests")
     * @ORM\JoinColumn(nullable=false)
     */
    private $testSubGroup;

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

    public function getTestSubGroup(): ?TestSubGroup
    {
        return $this->testSubGroup;
    }

    public function setTestSubGroup(?TestSubGroup $testSubGroup): self
    {
        $this->testSubGroup = $testSubGroup;

        return $this;
    }
}
