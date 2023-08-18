<?php

declare(strict_types=1);

namespace MediaWiki\Skins\Vector\Components;

use Title;

class VectorComponentNsSelector implements VectorComponent
{
    /** @var array<int, array{id: int, label: string}> */
    private static array $ns = [
        [
            'id'    => NS_MAIN,
            'label' => '&lt;root&gt;',
        ],
        [
            'id'    => NS_ADJ,
            'label' => 'ADJ',
        ],
        [
            'id'    => NS_AVENTURES,
            'label' => 'Aventures',
        ],
        [
            'id'    => NS_GOLARION,
            'label' => 'Golarion',
        ],
        [
            'id'    => NS_PATHFINDER_RPG,
            'label' => 'Pathfinder-RPG',
        ],
        [
            'id'    => NS_PATHFINDER2,
            'label' => 'Pathfinder2',
        ],
        [
            'id'    => NS_RESSOURCES,
            'label' => 'Ressources',
        ],
        [
            'id'    => NS_STARFINDER,
            'label' => 'Starfinder',
        ],
    ];

    public function __construct(
        private readonly int $currentNs,
    ) {
    }

    public function getTemplateData(): array
    {
        $templateData = [];

        foreach (static::$ns as $nsData) {
            $templateData[] = [
                ...$nsData,
                'url'      => $this->getUrl($nsData),
                'selected' => $this->currentNs === $nsData['id'] ? ' selected' : '',
            ];
        }

        return $templateData;
    }

    private function getUrl(array $data): string
    {
        $text = NS_MAIN === $data['id']
            ? 'Accueil'
            : $data['label'] . ':Accueil';

        return Title::newFromText($text)?->getLocalURL() ?? '#';
    }
}
