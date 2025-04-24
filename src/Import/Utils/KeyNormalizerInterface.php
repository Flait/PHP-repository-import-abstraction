<?php declare(strict_types = 1);

namespace Adbros\Exam\Import\Utils;

interface KeyNormalizerInterface
{
    /**
     * Normalize array keys (e.g. 'First-Name' → 'firstname')
     */
    public function normalize(array $row): array;
}
