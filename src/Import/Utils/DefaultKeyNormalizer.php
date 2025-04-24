<?php declare(strict_types = 1);

namespace Adbros\Exam\Import\Utils;

final class DefaultKeyNormalizer implements KeyNormalizerInterface
{
    public function normalize(array $row): array
    {
        $normalized = [];

        foreach ($row as $key => $value) {
            $normalizedKey = strtolower(str_replace(['-', '_', ' '], '', $key));
            $normalized[$normalizedKey] = $value;
        }

        return $normalized;
    }
}
