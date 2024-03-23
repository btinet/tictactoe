<?php

namespace Btinet\Tictactoe\Service;

use ReflectionClass;
use ReflectionException;

class Host
{

    /**
     * @param string $class
     * @param string $method
     * @param array|null $mandatory
     * @param null $anchor
     * @return string complex url generated from parameters.
     */
    public static function route(string $class, string $method, array $mandatory = null, $anchor = null): string
    {
        $path = "";

        try {
            $reflectionClass = new ReflectionClass($class);

            if (method_exists($class, $method)) {
                $className = strtolower(str_replace("Controller", "", $reflectionClass->getShortName()));

                $path .= "?controller=$className&method=$method";

                if ($mandatory) {
                    foreach ($mandatory as $name => $value) {
                        $path .= "&$name=$value";
                    }
                }
                if ($anchor) {
                    $path .= "#$anchor";
                }
            } else {
                // var_dump("Methode $method existiert nicht in $class.");
            }

            return self::getProtocol() . $_SERVER['HTTP_HOST'] . $path;
        } catch (ReflectionException $e) {
            // var_dump("Klasse existiert nicht");
        }
        return false;
    }

    /**
     * @param string|null $target
     * @return string simple href link
     */
    public static function link(string $target = null): string
    {
        return self::getProtocol() . $_SERVER['HTTP_HOST'] . DIRECTORY_SEPARATOR . $target;
    }

    /**
     *
     * @return string protocol and host.
     */
    private static function getProtocol(): string
    {
        return (! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    }

}