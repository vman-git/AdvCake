<?php
require 'StringManipulation.php';
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
class StringManipulationTest extends TestCase
{
    private $manipulator;
 
    protected function setUp(): void
    {
        $this->manipulator = new StringManipulation();
    }
 
    protected function tearDown(): void
    {
        $this->manipulator = NULL;
    }

    public static function stringProvider()
    {
        return [
            ["Тевирп! Онвад ен ьсиледив.", "Привет! Давно не виделись."],
            ["Foo!", "Oof!"],
            ["Тест! !!", "Тсет! !!"],
            ["Тест!.!!", "Тсет!.!!"],
            ["", ""],
            ["  ! '", "  ! '"],
            [" ", " "],
            ["Hello,  word!","Olleh,  drow!"]
        ];
    }

    #[DataProvider('stringProvider')]
    public function testRevertCharacters($expected, $stringSample)
    {
        $result = $this->manipulator->revertCharacters($stringSample);
        $this->assertSame($expected, $result);
    }
}

