<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('var')
;

return (new PhpCsFixer\Config())
    ->setRules([
        'yoda_style' => false,
        '@Symfony' => true,
    ])
    ->setFinder($finder)
;
