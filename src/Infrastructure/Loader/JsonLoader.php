<?php
declare(strict_types=1);

namespace App\Infrastructure\Loader;

use App\Domain\Loader\LoaderInterface;

class JsonLoader implements LoaderInterface
{
    private array $jsonData;

    public function __construct(string $filePath)
    {
        if (!file_exists($filePath)) {
            throw new \Exception('File does not exist!');
        }
        $jsonDecoded = json_decode(file_get_contents($filePath), true);
        if (is_null($jsonDecoded)) {
            throw new \Exception('Invalid JSON!');
        }

        $this->jsonData = $jsonDecoded;
    }

    public function getJsonData(): array
    {
        return $this->jsonData;
    }
}