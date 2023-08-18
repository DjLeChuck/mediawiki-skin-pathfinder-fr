<?php

declare(strict_types=1);

namespace MediaWiki\Skins\Vector\Components\NavigationMenu;

use MediaWiki\Skins\Vector\Components\VectorComponent;

class MenuContainer implements VectorComponent
{
    /** @var array<MenuSubContainer> */
    private array $subContainers = [];
    /** @var array<MenuItem> */
    private array $items = [];

    public function __construct(
        private readonly string $title,
    ) {
    }

    public function addSubContainer(MenuSubContainer $subContainer): void
    {
        $this->subContainers[] = $subContainer;
    }

    public function addItem(MenuItem $item): void
    {
        $this->items[] = $item;
    }

    public function getTemplateData(): array
    {
        return [
            'title'         => $this->title,
            'items'         => array_map(static fn(VectorComponent $c) => $c->getTemplateData(), $this->items),
            'subContainers' => array_map(
                static fn(VectorComponent $c) => $c->getTemplateData(),
                $this->subContainers
            ),
        ];
    }
}
