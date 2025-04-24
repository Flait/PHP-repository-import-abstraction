<?php declare(strict_types = 1);

namespace Adbros\Exam\Import;

use Adbros\Exam\Model\Entity;

final class GenericEntityMapper
{
    /**
     * @param class-string<Entity> $entityClass
     * @param array<string, string> $fieldMap Zdrojový název => název atributu entity
     */
    public function __construct(
        private string $entityClass,
        private array $fieldMap = [],
    ) {}

    public function map(array $row): Entity
    {
        $entity = new $this->entityClass();

        foreach ($row as $key => $value) {
            $attribute = $this->fieldMap[$key] ?? $key;
            $setter = 'set' . ucfirst($attribute);

            if (method_exists($entity, $setter)) {
                $entity->$setter($value);
            }
        }

        return $entity;
    }
}
