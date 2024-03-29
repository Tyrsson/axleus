<?php

declare(strict_types=1);

namespace Forum;

use Axleus\SettingsProvider as Provider;

final class SettingsProvider extends Provider
{
    public const SETTINGS_FILE = 'forum.php';
    protected ?string $file = self::SETTINGS_FILE;

    public function __invoke(): array
    {
        $settings = parent::__invoke();
        return $settings;
    }
}
