<?php

namespace MediaWiki\Skins\Vector\ResourceLoader;

use MediaWiki\MainConfigNames;
use MediaWiki\ResourceLoader as RL;

class VectorResourceLoaderUserStylesModule extends RL\UserStylesModule
{
    /**
     * @inheritDoc
     */
    protected function getPages(RL\Context $context)
    {
        $user = $context->getUserObj();
        $pages = [];
        $config = $this->getConfig();
        if ($config->get('PathfinderFRShareUserScripts') &&
            $config->get(MainConfigNames::AllowUserCss) &&
            $user->isRegistered()
        ) {
            $userPage = $user->getUserPage()->getPrefixedDBkey();
            $pages["$userPage/pathfinder-fr.css"] = ['type' => 'style'];
        }

        return $pages;
    }
}
