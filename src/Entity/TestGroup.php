<?php

namespace App\Entity;

use App\Repository\TestGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TestGroupRepository::class)
 */
class TestGroup
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
     * @ORM\OneToMany(targetEntity=TestSubGroup::class, mappedBy="testGroup", orphanRemoval=true)
     */
    private $testSubGroups;

    public function __construct()
    {
        $this->testSubGroups = new ArrayCollection();
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
     * @return Collection|TestSubGroup[]
     */
    public function getTestSubGroups(): Collection
    {
        return $this->testSubGroups;
    }

    public function addTestSubGroup(TestSubGroup $testSubGroup): self
    {
        if (!$this->testSubGroups->contains($testSubGroup)) {
            $this->testSubGroups[] = $testSubGroup;
            $testSubGroup->setTestGroup($this);
        }

        return $this;
    }

    public function removeTestSubGroup(TestSubGroup $testSubGroup): self
    {
        if ($this->testSubGroups->removeElement($testSubGroup)) {
            // set the owning side to null (unless already changed)
            if ($testSubGroup->getTestGroup() === $this) {
                $testSubGroup->setTestGroup(null);
            }
        }

        return $this;
    }
}
