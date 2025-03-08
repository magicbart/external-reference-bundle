<?php

declare(strict_types=1);

namespace Magicbart\ExternalReferenceBundle\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Magicbart\ExternalReferenceBundle\Entity\ExternalReference;
use Magicbart\ExternalReferenceBundle\Exception\NotFoundExternalReferenceException;

readonly class ExternalReferenceManager
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function exists(string $entityName, int $entityId, string $target): bool
    {
        $externalReference = $this->get($entityName, $entityId, $target);
        return $externalReference !== null;
    }


    /**
     * @param string $entityName
     * @param int $entityId
     * @param string $target
     * @return ExternalReference|null
     */
    public function get(string $entityName, int $entityId, string $target): ?ExternalReference
    {
        return $this->em->getRepository(ExternalReference::class)->findOneBy(
            [
                'entityId' => $entityId,
                'entityName' => $entityName,
                'target' => $target
            ]
        );
    }

    /**
     * @param string $entityName
     * @param int $entityId
     * @param string|int $externalId
     * @param string $target
     * @return void
     */
    public function add(string $entityName, int $entityId, string|int $externalId, string $target): void
    {
        $externalReference = new ExternalReference();
        $externalReference->setEntityName($entityName);
        $externalReference->setEntityId($entityId);
        $externalReference->setExternalId((string) $externalId);
        $externalReference->setTarget($target);
        $this->em->persist($externalReference);
        $this->em->flush();
    }

    /**
     * @throws NotFoundExternalReferenceException
     */
    public function getExternalId(string $entityName, int $entityId, string $target): string
    {
        $reference = $this->get(
            $entityName,
            $entityId,
            $target
        );

        if (null === $reference) {
            throw new NotFoundExternalReferenceException(
                sprintf(
                    'External %s not found with id "%d" and target "%s"',
                    $entityName,
                    $entityId,
                    $target
                )
            );
        }
        return $reference->getExternalId();
    }
}
