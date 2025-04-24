<?php declare(strict_types = 1);

namespace Adbros\Exam\Import\Csv;

use Adbros\Exam\Model\Repository;
use Adbros\Exam\Import\ImporterInterface;
use Adbros\Exam\Import\Utils\KeyNormalizerInterface;
use Adbros\Exam\Import\GenericEntityMapper;

final class CsvImporter implements ImporterInterface
{
    public function __construct(
        private Repository $repository,
        private GenericEntityMapper $mapper,
        private KeyNormalizerInterface $normalizer
    ) {}


    public function import(string $filePath): void
    {
        $handle = fopen($filePath, 'r');
        if (!$handle) {
            throw new \RuntimeException("Cannot open file: $filePath");
        }

        $header = fgetcsv($handle);
        while (($row = fgetcsv($handle)) !== false) {
            $rowAssoc = array_combine($header, $row);
            $normalizedRow = $this->normalizer->normalize($rowAssoc);

            $email = $normalizedRow['email'] ?? null;

            if (!$email || $this->repository->getByEmail($email)) {
                continue;
            }

            $user = $this->mapper->map($normalizedRow);
            $this->repository->persist($user);
        }

        fclose($handle);
    }
}
