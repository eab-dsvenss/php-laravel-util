<?php

use se\eab\php\laravel\util\misc\ArrayStringBuilder;

class ArrayStringBuilderTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testArrayToString()
    {

        $ab = ArrayStringBuilder::getInstance();

        $arrstr = <<<EOT
[
  "test",
  "jaha" => [
    "kanske" => "test",
    "blah",
  ],
]
EOT;
        $arr = [
            "test",
            "jaha" => [
                "kanske" => "test",
                "blah"
            ]
        ];

        $res = $ab->arrayToString($arr);
        codecept_debug($res);

        $this->assertEquals($arrstr, $res);
    }
}