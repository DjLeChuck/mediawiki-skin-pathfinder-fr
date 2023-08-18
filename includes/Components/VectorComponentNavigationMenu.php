<?php

declare(strict_types=1);

namespace MediaWiki\Skins\Vector\Components;

use MediaWiki\Skins\Vector\Components\NavigationMenu\MenuContainer;
use MediaWiki\Skins\Vector\Components\NavigationMenu\MenuItem;
use MediaWiki\Skins\Vector\Components\NavigationMenu\MenuSubContainer;

class VectorComponentNavigationMenu implements VectorComponent
{
    public function getTemplateData(): array
    {
        // Navigation
        $navContainer = new MenuContainer('Navigation');
        $navContainer->addItem(new MenuItem('Accueil du site', 'Accueil'));
        $navContainer->addItem(
            new MenuItem('Serveur Discord', 'https://t.co/euqukfofhL?amp=1', class: 'discord-menu-entry')
        );
        $navContainer->addItem(new MenuItem('Partenaires', 'Liens'));

        // Sous-sections
        $navContainer->addSubContainer($this->getPathfinderRpgEntry());
        $navContainer->addSubContainer($this->getPathfinder2Entry());
        $navContainer->addSubContainer($this->getGolarionEntry());
        $navContainer->addSubContainer($this->getRessourcesEntry());
        $navContainer->addSubContainer($this->getAventuresEntry());
        $navContainer->addSubContainer($this->getStarfinderEntry());

        // Aides et guides
        $guidesContainer = new MenuContainer('Aides et guides');
        $guidesContainer->addItem(new MenuItem('Guide de création', 'Création'));
        $guidesContainer->addItem(new MenuItem('Sources/Projets d’intégrations', 'PF:Temp'));

        return [$navContainer->getTemplateData(), $guidesContainer->getTemplateData()];
    }

    private function getPathfinderRpgEntry(): MenuSubContainer
    {
        $menu = new MenuSubContainer('Wiki Pathfinder-RPG', 'Tout sur les règles officielles de Pathfinder');
        $menu->addItem(new MenuItem('Accueil', 'PF:Accueil', 'Bienvenue sur le Wiki Pathfinder-JdR'));
        $menu->addItem(new MenuItem('Aides de jeu', 'PF:Aides_de_jeu', 'Aides de jeu pour Pathfinder-RPG'));
        $menu->addItem(
            new MenuItem('Bestiaire', 'PF:Liste_alphabétique_des_monstres', 'Liste alphabétique des monstres')
        );
        $menu->addItem(new MenuItem('Livres', 'PF:Publications', 'Publications relatives à Pathfinder RPG'));
        $menu->addItem(new MenuItem('FAQ', 'PF:FAQ', 'FAQ non officielle'));
        $menu->addItem(new MenuItem('Glossaires', 'PF:Glossaire', 'Glossaire anglais/français'));

        return $menu;
    }

    private function getPathfinder2Entry(): MenuSubContainer
    {
        $menu = new MenuSubContainer('Wiki Pathfinder 2', 'Ressources pour la version 2 de Pathfinder.');
        $menu->addItem(new MenuItem('Accueil', 'PF2:Accueil', 'Wiki de ressources pour Pathfinder 2'));
        $menu->addItem(new MenuItem('Aides de jeu', 'PF2:ADJ', 'Aides de jeu pour Pathfinder 2 (Règles)'));
        $menu->addItem(new MenuItem('Campagnes', 'PF2:AP', 'Aventures officielles pour Pathfinder 2 (campagnes)'));
        $menu->addItem(
            new MenuItem('PF Society', 'PF2:PFS', 'Pathfinder Society / Campagne organisée pour Pathfinder 2')
        );
        $menu->addItem(
            new MenuItem('Autres sorties', 'PF2:Publications', 'Publications pour Pathfinder 2 (livres de base)')
        );
        $menu->addItem(new MenuItem('Créations', 'PF2:FAN', 'Créations de fans pour Pathfinder 2'));

        return $menu;
    }

    private function getGolarionEntry(): MenuSubContainer
    {
        $menu = new MenuSubContainer('Wiki Golarion', 'Tout sur le monde de Golarion.');
        $menu->addItem(new MenuItem('Accueil', 'GOL:Accueil', 'Bienvenue sur le Wiki Golarion'));
        $menu->addItem(new MenuItem('Aides de jeu', 'GOL:Aides_de_jeu', 'Aides de jeu sur Golarion'));
        $menu->addItem(new MenuItem('Wayfinder', 'GOL:Wayfinder', 'Wayfinder'));
        $menu->addItem(new MenuItem('Livres', 'GOL:Publications', 'Publications sur le monde de Golarion'));
        $menu->addItem(new MenuItem('Dieux', 'GOL:Religions_et_philosophies', 'Religions et philosophies'));
        $menu->addItem(new MenuItem('Romans', 'GOL:Romans', 'Romans se déroulant sur Golarion'));
        $menu->addItem(new MenuItem('Un jour sur Golarion', 'GOL:JourGolarion', 'Un jour sur Golarion', 'col-12'));

        return $menu;
    }

    private function getRessourcesEntry(): MenuSubContainer
    {
        $menu = new MenuSubContainer('Wiki Ressources', 'Aides informatiques, règles maison…');
        $menu->addItem(new MenuItem('Accueil', 'RS:Accueil', 'Bienvenue sur le Wiki Ressources'));

        return $menu;
    }

    private function getAventuresEntry(): MenuSubContainer
    {
        $menu = new MenuSubContainer('Wiki Aventures', 'Aides de jeu et outils pour les MJ.');
        $menu->addItem(new MenuItem('Accueil', 'AV:Accueil', 'Bienvenue sur le Wiki Aventures'));
        $menu->addItem(
            new MenuItem('PF Society', 'AV:Présentation_Pathfinder_Society', 'Présentation de la Pathfinder Society')
        );
        $menu->addItem(new MenuItem('Campagnes', 'AV:Campagnes', 'Campagnes officielles (Adventure Paths)'));
        $menu->addItem(new MenuItem('Aventures', 'AV:Aventures_de_fans', 'Aventures créées par les fans'));
        $menu->addItem(new MenuItem('Modules', 'AV:Présentation_Modules', 'Présentation des modules'));
        $menu->addItem(new MenuItem('PNJ', 'AV:Liste_PNJ', 'Les PNJs par FP'));

        return $menu;
    }

    private function getStarfinderEntry(): MenuSubContainer
    {
        $menu = new MenuSubContainer('Wiki Starfinder');
        $menu->addItem(new MenuItem('Accueil', 'SF:Accueil', 'Wiki du Jeu de rôle Starfinder'));
        $menu->addItem(new MenuItem('Aides de jeu', 'SF:ADJ', 'Aides de jeux pour StarFinder'));

        return $menu;
    }
}
