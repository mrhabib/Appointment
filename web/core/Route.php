<?php

namespace Core;

use Core\URI;
use DI\Container;

class Route
{

    public static function get(string $matchURI, string $controller, string $method)
    {
        self::request('GET', $matchURI, $controller, $method);

    }

    public static function post(string $matchURI, string $controller, string $method)
    {
        self::request('POST', $matchURI, $controller, $method);
    }

    private static function request($matchRequestMethod, string $matchURI, string $controller, string $method)
    {
        if (self::checkMatch($matchRequestMethod, $matchURI)) {
            $arguments = self::extractArguments($matchURI);
            self::callMethod($controller, $method, $arguments);
        }
    }

    private static function checkMatch(string $matchRequestMethod, string $matchURI): bool
    {
        if (!self::checkRequestMethod($matchRequestMethod)) {
            return false;
        }

        $requestURIElements = URI::getInstance()->getURIs();
        $matchURIElements = explode('/', $matchURI);

        if (count($requestURIElements) != count($matchURIElements)) {
            return false;
        } else {
            foreach ($requestURIElements as $requestURIElementKey => $requestURIElement) {
                $matchURIElement = $matchURIElements[$requestURIElementKey];

                if (!str_starts_with($matchURIElement, ':') && $matchURIElement != $requestURIElement) {
                    return false;
                }
            }
        }

        return true;
    }

    private static function callMethod(string $controller, string $method, array $arguments): void
    {
        //using PHP-DI Container for Dependency Injection with Auto wiring
        $container = new Container();
        $controller = $container->get($controller);

        $controller->$method(...$arguments);
    }

    private static function extractArguments(string $matchURI): array
    {
        $arguments = [];

        $requestURIElements = URI::getInstance()->getURIs();
        $matchURIElements = explode('/', $matchURI);

        foreach ($requestURIElements as $requestURIElementKey => $requestURIElement) {
            $matchURIElement = $matchURIElements[$requestURIElementKey];

            if (str_starts_with($matchURIElement, ':')) {
                $arguments[] = $requestURIElement;
            }
        }

        return $arguments;
    }

    public static function checkRequestMethod(string $expectedRequestMethod)
    {
        return $expectedRequestMethod == $_SERVER["REQUEST_METHOD"];
    }
}