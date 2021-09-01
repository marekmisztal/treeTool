<?php
declare(strict_types=1);

namespace App\Infrastructure\Saver;

use App\Domain\Saver\SaverInterface;

class JsonSaver implements SaverInterface
{
    private string $filePath;
    private string $jsonData;

    public function __construct(string $filePath, string $jsonData)
    {
        $this->filePath = $filePath;
        $this->jsonData = $jsonData;
    }

    public function saveJsonData(): void
    {
        file_put_contents($this->filePath, $this->jsonData);
    }
}