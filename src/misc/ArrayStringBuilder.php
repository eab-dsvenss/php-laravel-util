<?php
/**
 * Created by IntelliJ IDEA.
 * User: dsvenss
 * Date: 2018-04-04
 * Time: 17:43
 */

namespace se\eab\php\laravel\util\misc;


class ArrayStringBuilder
{

    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new ArrayStringBuilder();
        }

        return self::$instance;
    }

    public function arrayToString(array $arr)
    {
        return $this->convertArrayToString($arr, "", 0);
    }

    private function convertArrayToString(array $arr, $str, $level, $noinitialindenation = false)
    {
        $indentation = $this->getIndentation($level);
        $nextindentation = $this->getIndentation(++$level);

        if ($noinitialindenation) {
            $str .= "[";

        } else {
            $str .= <<<EOT
{$indentation}[
EOT;
        }

        foreach ($arr as $key => $val) {
            if (!is_numeric($key)) {
                $str .= <<<EOT

{$nextindentation}"$key" => 
EOT;
            } else {
                $str .= <<<EOT

{$nextindentation}
EOT;
            }
            if (is_array($val)) {
                $str .= $this->convertArrayToString($val, "", $level, true) . ",";
            } else {
                $str .= "\"$val\",";
            }
        }

        $str .= <<<EOT

{$indentation}]
EOT;


        return $str;
    }

    private function getIndentation($level)
    {
        $indentation = "";
        for ($i = 0; $i < $level; $i++) {
            $indentation .= "  ";
        }

        return $indentation;
    }
}