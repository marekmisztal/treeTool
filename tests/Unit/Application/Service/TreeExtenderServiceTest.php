<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Application\Service\TreeExtenderService;
use App\Infrastructure\Loader\JsonLoader;

class TreeExtenderServiceTest extends TestCase
{
    const PATH_TO_DATA = __DIR__ . '/../../../_data/';

    public function test_validateList_shouldThrowException()
    {
        $this->expectException(\Exception::class);

        $service = new TreeExtenderService(
            new JsonLoader(self::PATH_TO_DATA . 'tree.json'),
            new JsonLoader(self::PATH_TO_DATA . 'invalidList.json')
        );
        $service->fillTree();
    }

    public function test_checkFillingTree_shouldFill4Names()
    {
        $service = new TreeExtenderService(
            new JsonLoader(self::PATH_TO_DATA . 'tree.json'),
            new JsonLoader(self::PATH_TO_DATA . 'list.json')
        );
        $service->fillTree();

        $result = $service->getNewTree();

        $categoryName01 = $result[0]['name'];
        $this->assertEquals('Kategoria 01', $categoryName01);

        $categoryName05 = $result[0]['children'][2]['children'][0]['name'];
        $this->assertEquals('Kategoria 05', $categoryName05);

        $categoryName10 = $result[0]['children'][2]['children'][0]['children'][3]['children']
                                 [0]['name'];
        $this->assertEquals('Kategoria 10', $categoryName10);

        $categoryName15 = $result[0]['children'][2]['children'][0]['children'][3]['children']
                                 [0]['children'][0]['children'][0]['children'][1]['children']
                                 [0]['children'][0]['name'];
        $this->assertEquals('Kategoria 15', $categoryName15);
    }
}