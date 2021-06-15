<?php


namespace Tests\Unit\Admin\Supports;

use App\Admin\Supports\Tree;
use PHPUnit\Framework\TestCase;


class TreeTest extends TestCase
{

    public function testToTreeList(){
        $badItems = [
            [
                'id' => 0,
                'p_id' => 1,
                'name' => "技术部",
            ],
            [
                'id' => 1,
                'p_id' => 2,
                'name' => "A项目组",
            ],
            [
                'id' => 2,
                'p_id' => 0,
                'name' => "B项目组",
            ],
        ];
        try{
            $items = (new Tree($badItems))->toTreeList(collect());
            var_dump($items);
        }catch (\Exception $exception){
            $this->assertTrue(strpos($exception->getMessage(), "环形") !== false, "[{$exception->getMessage()}]");
        }

        $rightItems = [
            [
                'id' => 1,
                'p_id' => 2,
                'name' => "技术部",
            ],
            [
                'id' => 2,
                'p_id' => 1,
                'name' => "A项目组",
            ],
            [
                'id' => 3,
                'p_id' => 1,
                'name' => "B项目组",
            ],
            [
                'id' => 4,
                'p_id' => 2,
                'name' => "后勤部",
            ],
            [
                'id' => 5,
                'p_id' => 4,
                'name' => "张三",
            ],
            [
                'id' => 6,
                'p_id' => 4,
                'name' => "李四",
            ],
            [
                'id' => 7,
                'p_id' => 3,
                'name' => "B项目组 - PHP",
            ],
            [
                'id' => 8,
                'p_id' => 6,
                'name' => "李四 的 助理",
            ],
        ];
    }

}