<?php
# user/plugins/twig-z/twig-z.php

namespace Grav\Plugin;

use Grav\Common\Plugin;
use Grav\Common\Grav;

class TwigZPlugin extends Plugin
{
    
    public static function getSubscribedEvents(): array
    {
        return [
            'onTwigInitialized' => [['onTwigInitialized', 0]],
        ];
    }
    
    /**
     * Détermine le chemin d'un composant selon la logique Zpip
     *
     * @param string $pageTemplate Le nom du template actuel (ex: 'item')
     * @param string $target Le fichier cible (ex: 'sidebar.html.twig')
     * @return string|bool Le chemin du template trouvé ou false
     */
    public static function z($pageTemplate, $target) {
        // Récupération correcte du locator de Grav
        $locator = Grav::instance()['locator'];
        
        // 1. Premier choix : z/[nom_du_template]/[target]
        $specificPath = "z/{$pageTemplate}/{$target}";
        if ($locator->findResource("theme://templates/{$specificPath}")) {
            return $specificPath;
        }
        
        // 2. Fallback de secours : z/dist/[target]
        $fallbackPath = "z/_all/{$target}";
        if ($locator->findResource("theme://templates/{$fallbackPath}")) {
            return $fallbackPath;
        }
        
        return false;
    }
    
    public function onTwigInitialized(): void
    {
        $f = new \Twig\TwigFunction(
            'z', 
            [self::class, 'z']
        );
        $this->grav['twig']->twig->addFunction($f);
    }
    
}
