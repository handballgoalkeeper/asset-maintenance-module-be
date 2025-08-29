<?php

declare(strict_types=1);

namespace App\Helpers;

final class RoutesHelper
{
    private const string V1_ROUTING_FOLDER = 'v1';

    /** @var string[] */
    private const array V1_ROUTING_FILES = [
        'auth', 'vendors'
    ];

    /** @return array<string> */
    public static function buildRoutingFilesArray(): array
    {
        return array_map(
            callback: fn (string $routingFileName): string => self::getRoutingDirPath().'/'.$routingFileName.'.php',
            array: self::getRoutingArray(),
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

    private static function getRoutingArray(): array{
        return [
            ...array_map(
                callback: fn(string $filename) => self::V1_ROUTING_FOLDER. '/' .$filename,
                array: self::V1_ROUTING_FILES)
        ];
    }
}
