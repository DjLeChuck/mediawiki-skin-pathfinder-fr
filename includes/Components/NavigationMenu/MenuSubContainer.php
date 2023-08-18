<?php

declare(strict_types=1);

namespace MediaWiki\Skins\Vector\Components\NavigationMenu;

use MediaWiki\Skins\Vector\Components\VectorComponent;

class MenuSubContainer implements VectorComponent
{
    /** @var array<MenuItem> */
    private array $items = [];

    public function __construct(
        private readonly string $title,
        private readonly ?string $subTitle = null,
    ) {
    }

    public function addItem(MenuItem $item): void
    {
        $this->items[] = $item;
    }

    public function getTemplateData(): array
    {
        return [
            'title'    => $this->title,
            'subtitle' => $this->subTitle,
            'items'    => array_map(static fn(VectorComponent $c) => $c->getTemplateData(), $this->items),
        ];
    }
}
