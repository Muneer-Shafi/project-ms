<?php

declare(strict_types=1);

use Symfony\Config\TwigConfig;

return static function (TwigConfig $twig) {
    $twig->formThemes([
        'form/theme.html.twig'
        // 'bootstrap_5_layout.html.twig',
        //        'bootstrap_5_horizontal_layout.html.twig'
    ]);
};
