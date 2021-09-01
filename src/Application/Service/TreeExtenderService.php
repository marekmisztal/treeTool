<?php
declare(strict_types=1);

namespace App\Application\Service;

use App\Domain\Loader\LoaderInterface;

class TreeExtenderService
{
    private LoaderInterface $treeLoader;
    private LoaderInterface $listLoader;
    private array $newTree;

    public function __construct(LoaderInterface $treeLoader, LoaderInterface $listLoader)
    {
        $this->treeLoader = $treeLoader;
        $this->listLoader = $listLoader;
    }

    public function fillTree(): void
    {
        $newTree = $this->treeLoader->getJsonData();
        $list = $this->getCategoryNames($this->listLoader->getJsonData());

        $this->newTree = $this->fillTreeRecursively($newTree, $list);
    }

    public function getNewTree(): array
    {
        return $this->newTree;
    }

    private function fillTreeRecursively(array $newTree, array $list): array
    {
        foreach ($newTree as $key => $item) {
            if (array_key_exists((int)$item['id'], $list)) {
                $newTree[$key]['name'] = $list[(int)$item['id']];
            }
            if (array_key_exists('children', $item) and !empty($item['children'])) {
                $newTree[$key]['children'] = $this->fillTreeRecursively($newTree[$key]['children'], $list);
            }
        }
        return $newTree;
    }

    private function getCategoryNames(array $list): array
    {
        $newList = [];
        foreach ($list as $category) {
            if (
                !array_key_exists('category_id', $category) or
                !isset($category['translations']['pl_PL']['name'])
            ) {
                throw new \Exception('Invalid JSON list');
            }
            $newList[(int)$category['category_id']] = $category['translations']['pl_PL']['name'];
        }
        return $newList;
    }
}