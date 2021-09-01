<?php
declare(strict_types=1);

namespace App\Domain\Saver;

interface SaverInterface
{
    public function saveJsonData(): void;
}