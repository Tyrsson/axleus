<?php

declare(strict_types=1);

namespace PageManager\Handler;

use League\Tactician\CommandBus;
use Mezzio\Template\TemplateRendererInterface;
use PageManager\Storage\PageEntity;
use PageManager\Storage\PageRepository;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function assert;

class PageHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $template = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;
        assert($template instanceof TemplateRendererInterface || null === $template);

        return new PageHandler(
            $template,
            $container->get(CommandBus::class),
            $container->get(PageRepository::class)
        );
    }
}
