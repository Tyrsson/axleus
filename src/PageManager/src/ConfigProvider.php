<?php

declare(strict_types=1);

namespace PageManager;

/**
 * The configuration provider for the PageManager module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    private const SETTINGS_PATH = __DIR__ . '/../../../data/settings/forum.php';
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            'routes'       => $this->getRoutes(),
            'tactician'    => $this->getTacticianConfig(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'aliases' => [],
            'factories' => [
                Handler\PageHandler::class => Handler\PageHandlerFactory::class,
                Storage\PageRepository::class => Storage\PageRepositoryFactory::class,
                Storage\SavePageCommandHandler::class => Storage\SavePageCommandHandlerFactory::class,
            ],
        ];
    }

    public function getTacticianConfig(): array
    {
        return [
            'handler-map' => [
                Storage\SavePageCommand::class => Storage\SavePageCommandHandler::class,
            ],
        ];
    }

    public function getRoutes(): array
    {
        /** @var array<array-key, mixed> $settings*/
        $settings = require self::SETTINGS_PATH;
        /** @var bool|null */
        /** @psalm-suppress InvalidArrayOffset */
        $flag = $settings[\Forum\ConfigProvider::class]['serve-forum-from-root'] ?? null;

        $routes = [
            [
                'path'            => '/',
                'name'            => 'home',
                'middleware'      => Handler\PageHandler::class,
                'allowed_methods' => ['GET'],
            ],
            [
                'path'            => '/{title:[a-zA-Z]+}',
                'name'            => 'page',
                'middleware'      => Handler\PageHandler::class,
                'allowed_methods' => ['GET'],
            ],
        ];
        return ! $flag ? $routes : [];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'page-manager' => [__DIR__ . '/../templates/page-manager'],
            ],
        ];
    }
}
