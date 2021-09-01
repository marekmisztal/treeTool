<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Infrastructure\Loader\JsonLoader;

class JsonLoaderTest extends TestCase
{
    const PATH_TO_DATA = __DIR__ . '/../../../_data/';

    public function test_validateFileExists_shouldThrowException()
    {
        $this->expectException(\Exception::class);

        $nonExistingFile = 'qwert/qwe/qw.json';
        $loader = new JsonLoader($nonExistingFile);
    }

    public function test_validateJson_shouldThrowException()
    {
        $this->expectException(\Exception::class);

        $jsonFile = self::PATH_TO_DATA . 'invalid.json';
        $loader = new JsonLoader($jsonFile);
    }
}