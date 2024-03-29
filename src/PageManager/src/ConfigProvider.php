<?php

declare(strict_types=1);

namespace PageManager;

use Axleus\Authorization\AuthorizedServiceDelegator;
use Laminas\I18n\Translator\Loader\PhpArray;

use function class_exists;

/**
 * The configuration provider for the PageManager module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    private array $settings;
    private bool $routeFlag;

    protected ?string $file = 'page-manager';

    public function __construct()
    {
        /**
         * @psalm-suppress UnresolvableInclude
         * @psalm-suppress MixedAssignment
         * */
        $this->settings = (new SettingsProvider)();

        if (class_exists(\Forum\SettingsProvider::class, false)) {
            // if the forum module is installed, respect its settings
            $forumSettings = include SettingsProvider::SETTINGS_PATH . \Forum\SettingsProvider::SETTINGS_FILE;
            $this->settings += $forumSettings;
        }

        /**
         * @psalm-suppress MixedAssignment
         * @psalm-suppress MixedArrayAccess
         * */
        $this->routeFlag = $this->settings['serve-forum-from-root'] ?? false;
    }

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
            'translator'   => $this->getTranslatorConfig(),
            SettingsProvider::class => $this->settings,
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
                AdminHandler\CreatePageHandler::class       => AdminHandler\CreatePageHandlerFactory::class,
                AdminMiddleware\CreatePageMiddleware::class => AdminMiddleware\CreatePageMiddlewareFactory::class,
                AdminMiddleware\DashBoardMiddleware::class  => AdminMiddleware\DashBoardMiddlewareFactory::class,
                Handler\PageHandler::class                  => Handler\PageHandlerFactory::class,
                Storage\PageRepository::class               => Storage\PageRepositoryFactory::class,
                Storage\SavePageCommandHandler::class       => Storage\SavePageCommandHandlerFactory::class,
            ],
            'delegators' => [
                AdminHandler\CreatePageHandler::class => [
                    AuthorizedServiceDelegator::class,
                ],
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
        $routes = [
            [
                'path'            => '/',
                'name'            => 'home',
                'middleware'      => Handler\PageHandler::class,
                'allowed_methods' => ['GET'],
            ],
            [
                'path'            => '/{title:[a-zA-Z-]+}', // + char must be present
                'name'            => 'page',
                'middleware'      => Handler\PageHandler::class,
                'allowed_methods' => ['GET'],
            ],
            [
                'path'            => '/admin/pagemanager',
                'name'            => 'admin.pagemanager.create',
                'middleware'      => [
                    AdminMiddleware\CreatePageMiddleware::class,
                    AdminHandler\CreatePageHandler::class
                ],
                'allowed_methods' => ['GET', 'POST'],
            ],
        ];
        return ! $this->routeFlag ? $routes : [];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'page-manager' => [__DIR__ . '/../templates/'],
            ],
        ];
    }
    public function getTranslatorConfig(): array
    {
        return [
            'translation_file_patterns' => [ // This is the only config that is needed for 1 translation per file
                [
                    'type'     => PhpArray::class,
                    'filename' => 'en_US.php',
                    'base_dir' => __DIR__ . '/../language',
                    'pattern'  => '%s.php',
                ],
            ],
            'translation_files' => [
                [
                    'type'        => 'PhpArray',
                    'filename'    => __DIR__ . '/../language/en_US.php',
                    'locale'      => 'en_US',
                    'text_domain' => 'default',
                ],
            ],
        ];
    }
}
