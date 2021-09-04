<?php

namespace App\Entity;

use App\Repository\DigitalLineTestRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DigitalLineTestRepository::class)
 */
class DigitalLineTest
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
     * @ORM\ManyToOne(targetEntity=DigitalLineTestSubGroup::class, inversedBy="digitalLineTests")
     * @ORM\JoinColumn(nullable=false)
     */
    private $digitalLineTestSubGroup;

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

    public function getDigitalLineTestSubGroup(): ?DigitalLineTestSubGroup
    {
        return $this->digitalLineTestSubGroup;
    }

    public function setDigitalLineTestSubGroup(?DigitalLineTestSubGroup $digitalLineTestSubGroup): self
    {
        $this->digitalLineTestSubGroup = $digitalLineTestSubGroup;

        return $this;
    }
}
