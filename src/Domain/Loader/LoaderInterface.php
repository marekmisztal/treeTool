<?php
declare(strict_types=1);

namespace App\Domain\Loader;

interface LoaderInterface
{
    public function getJsonData(): array;
}