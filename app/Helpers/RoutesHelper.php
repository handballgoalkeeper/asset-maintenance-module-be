<?php

declare(strict_types=1);

namespace App\Helpers;

final class RoutesHelper
{
    /** @var string[] */
    private const array ROUTING_FILES_ARRAY = [
        'v1/auth',
    ];

    /** @return array<string> */
    public static function buildRoutingFilesArray(): array
    {
        return array_map(
            callback: fn (string $routingFileName): string => self::getRoutingDirPath().'/'.$routingFileName.'.php',
            array: self::ROUTING_FILES_ARRAY,
        );
    }

    private static function getRoutingDirPath(): string
    {
        return self::getBaseRoutingDirectory().'/api';
    }

    private static function getBaseRoutingDirectory(): string
    {
        return __DIR__.'/../../routes';
    }
}
