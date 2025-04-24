<?php declare(strict_types = 1);

namespace Adbros\Exam\Import;

use Adbros\Exam\Enum\ImportTask;

final class ImporterManager
{
    /**
     * @param array<ImportTask, ImporterInterface> $importers
     */
    public function __construct(
        private array $importers
    ) {}

    public function run(string $type, string $file): void
    {
        $importer = $this->importers[$type] ?? null;

        if (!$importer) {
            throw new \InvalidArgumentException("Importer for '$type' not found.");
        }

        $importer->import($file);
    }
}
