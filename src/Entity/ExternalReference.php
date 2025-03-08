<?php

declare(strict_types=1);

namespace Magicbart\ExternalReferenceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\UniqueConstraint(name: 'external_reference_uniq', columns: ['entity_name', 'entity_id', 'target'])]
class ExternalReference
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 50, nullable: false)]
    private string $entityName;

    #[Assert\NotBlank]
    #[ORM\Column(nullable: false)]
    private int $entityId;

    #[Assert\NotBlank]
    #[ORM\Column(length: 255, nullable: false)]
    private string $target;

    #[Assert\NotBlank]
    #[ORM\Column(nullable: false)]
    private string $externalId;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getEntityName(): string
    {
        return $this->entityName;
    }

    public function setEntityName(string $entityName): void
    {
        $this->entityName = $entityName;
    }

    public function getEntityId(): int
    {
        return $this->entityId;
    }

    public function setEntityId(int $entityId): void
    {
        $this->entityId = $entityId;
    }


    public function getTarget(): string
    {
        return $this->target;
    }

    public function setTarget(string $target): void
    {
        $this->target = $target;
    }

    public function getExternalId(): string
    {
        return $this->externalId;
    }

    public function setExternalId(string $externalId): void
    {
        $this->externalId = $externalId;
    }

    public function __toString()
    {
        return sprintf(
            '%s[#]%s[#]%s',
            $this->getEntityName(),
            $this->getEntityId(),
            $this->getTarget()
        );
    }
}
