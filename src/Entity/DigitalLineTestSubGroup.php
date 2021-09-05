<?php

namespace App\Entity;

use App\Repository\DigitalLineTestSubGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DigitalLineTestSubGroupRepository::class)
 */
class DigitalLineTestSubGroup
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
     * @ORM\OneToMany(targetEntity=DigitalLineTest::class, mappedBy="digitalLineTestSubGroup", orphanRemoval=true)
     */
    private $digitalLineTests;

    /**
     * @ORM\ManyToOne(targetEntity=DigitalLineTestGroup::class, inversedBy="digitalLineTestSubGroups", fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     */
    private $digitalLineTestGroup;

    public function __construct()
    {
        $this->digitalLineTests = new ArrayCollection();
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
     * @return Collection|DigitalLineTest[]
     */
    public function getDigitalLineTests(): Collection
    {
        return $this->digitalLineTests;
    }

    public function addDigitalLineTest(DigitalLineTest $digitalLineTest): self
    {
        if (!$this->digitalLineTests->contains($digitalLineTest)) {
            $this->digitalLineTests[] = $digitalLineTest;
            $digitalLineTest->setDigitalLineTestSubGroup($this);
        }

        return $this;
    }

    public function removeDigitalLineTest(DigitalLineTest $digitalLineTest): self
    {
        if ($this->digitalLineTests->removeElement($digitalLineTest)) {
            // set the owning side to null (unless already changed)
            if ($digitalLineTest->getDigitalLineTestSubGroup() === $this) {
                $digitalLineTest->setDigitalLineTestSubGroup(null);
            }
        }

        return $this;
    }

    public function getDigitalLineTestGroup(): ?DigitalLineTestGroup
    {
        return $this->digitalLineTestGroup;
    }

    public function setDigitalLineTestGroup(?DigitalLineTestGroup $digitalLineTestGroup): self
    {
        $this->digitalLineTestGroup = $digitalLineTestGroup;

        return $this;
    }
}
