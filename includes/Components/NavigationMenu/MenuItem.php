<?php

declare(strict_types=1);

namespace MediaWiki\Skins\Vector\Components\NavigationMenu;

use MediaWiki\Skins\Vector\Components\VectorComponent;
use Title;

class MenuItem implements VectorComponent
{
    public function __construct(
        private readonly string $label,
        private readonly string $text,
        private readonly ?string $title = null,
        private readonly ?string $class = null,
    ) {
    }

    public function getTemplateData(): array
    {
        return [
            'label' => $this->label,
            'href'  => str_starts_with($this->text, 'http') ? $this->text : $this->getLink($this->text),
            'title' => $this->title,
            'class' => $this->class,
        ];
    }

    private function getLink(string $text): string
    {
        return Title::newFromText($text)?->getLocalURL() ?? '#';
    }
}
