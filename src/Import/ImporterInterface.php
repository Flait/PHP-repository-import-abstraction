<?php declare(strict_types = 1);

namespace Adbros\Exam\Import;

interface ImporterInterface
{
    public function import(string $filePath): void;
}
