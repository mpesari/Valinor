<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Core\Configuration\Option;
use Rector\Php74\Rector\LNumber\AddLiteralSeparatorToNumberRector;
use Rector\Set\ValueObject\LevelSetList;

return static function (RectorConfig $config): void {
    $config->paths([
        __FILE__,
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    $config->parameters()->set(Option::CACHE_DIR, 'var/cache/rector');

    $config->sets([
        LevelSetList::UP_TO_PHP_74,
    ]);

    $config->parallel();
    $config->skip([
        AddLiteralSeparatorToNumberRector::class,
    ]);
};
