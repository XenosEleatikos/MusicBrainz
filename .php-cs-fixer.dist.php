<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__);

return (new PhpCsFixer\Config())
    ->setRules([
        '@PER-CS' => true,
        '@PHP83Migration' => true,
        'nullable_type_declaration_for_default_null_value' => true,
        'declare_strict_types' => true,
        'native_function_invocation' => true,
        'no_unused_imports' => true,
        'global_namespace_import' => [
            'import_classes' => true,
            'import_functions' => true,
            'import_constants' => true,
        ],
        'no_extra_blank_lines' => ['tokens' => ['use']]
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder);
