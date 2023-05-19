<?php
declare(strict_types=1);

use Symfony\Config\TwigConfig;

return static function (TwigConfig $twig) {
    $twig->formThemes([
        'form/layout.html.twig',
        'form/fields.html.twig'
    ]);


};