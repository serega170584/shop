<?php

namespace App\Entity;

use App\Repository\TestSubGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TestSubGroupRepository::class)
 */
class TestSubGroup
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
     * @ORM\OneToMany(targetEntity=Test::class, mappedBy="testSubGroup", orphanRemoval=true)
     */
    private $tests;

    /**
     * @ORM\ManyToOne(targetEntity=TestGroup::class, inversedBy="testSubGroups")
     * @ORM\JoinColumn(nullable=false)
     */
    private $testGroup;

    public function __construct()
    {
        $this->tests = new ArrayCollection();
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

    /**
     * @return Collection|Test[]
     */
    public function getTests(): Collection
    {
        return $this->tests;
    }

    public function addTest(Test $test): self
    {
        if (!$this->tests->contains($test)) {
            $this->tests[] = $test;
            $test->setTestSubGroup($this);
        }

        return $this;
    }

    public function removeTest(Test $test): self
    {
        if ($this->tests->removeElement($test)) {
            // set the owning side to null (unless already changed)
            if ($test->getTestSubGroup() === $this) {
                $test->setTestSubGroup(null);
            }
        }

        return $this;
    }

    public function getTestGroup(): ?TestGroup
    {
        return $this->testGroup;
    }

    public function setTestGroup(?TestGroup $testGroup): self
    {
        $this->testGroup = $testGroup;

        return $this;
    }
}
