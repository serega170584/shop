<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use App\Repository\DigitalLineTestRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DigitalLineTestGroupRepository::class)
 */
class DigitalLineTestGroup
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
     * @ORM\OneToMany(targetEntity=DigitalLineTestSubGroup::class, mappedBy="digitalLineTestGroup", orphanRemoval=true)
     */
    private $digitalLineTestSubGroups;

    public function __construct()
    {
        $this->digitalLineTestSubGroups = new ArrayCollection();
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
     * @return Collection|DigitalLineTestSubGroup[]
     */
    public function getDigitalLineTestSubGroups(): Collection
    {
        return $this->digitalLineTestSubGroups;
    }

    public function getFiltered(DigitalLineTest $test)
    {
        $id = $test->getDigitalLineTestSubGroup()->getId();
        $criteria = Criteria::create()->andWhere(Criteria::expr()->eq('id', $id));
        return $this->digitalLineTestSubGroups->matching($criteria);
    }

    public function addDigitalLineTestSubGroup(DigitalLineTestSubGroup $digitalLineTestSubGroup): self
    {
        if (!$this->digitalLineTestSubGroups->contains($digitalLineTestSubGroup)) {
            $this->digitalLineTestSubGroups[] = $digitalLineTestSubGroup;
            $digitalLineTestSubGroup->setDigitalLineTestGroup($this);
        }

        return $this;
    }

    public function removeDigitalLineTestSubGroup(DigitalLineTestSubGroup $digitalLineTestSubGroup): self
    {
        if ($this->digitalLineTestSubGroups->removeElement($digitalLineTestSubGroup)) {
            // set the owning side to null (unless already changed)
            if ($digitalLineTestSubGroup->getDigitalLineTestGroup() === $this) {
                $digitalLineTestSubGroup->setDigitalLineTestGroup(null);
            }
        }

        return $this;
    }
}
