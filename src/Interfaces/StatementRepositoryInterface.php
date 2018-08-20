<?php

declare(strict_types = 1);

namespace Caju\Finance\Interfaces;

interface StatementRepositoryInterface
{
    public function all(string $dateStart, string $dateEnd, int $userId): array;
}