<?php

$rules = [
    '@PSR2' => true,
    'elseif' => true,
    'braces' => [
        'allow_single_line_closure' => true,
        'position_after_anonymous_constructs' => 'same',
        'position_after_functions_and_oop_constructs' => 'next',
        'position_after_control_structures' => 'same',
    ],
    'array_indentation' => true,
    'array_syntax' => [
        'syntax' => 'short',
    ],
    'phpdoc_indent' => true,
    'no_extra_blank_lines' => ['extra'],
    'no_closing_tag' => true,
    'no_empty_statement' => true,
    'no_short_echo_tag' => true,
    'no_whitespace_before_comma_in_array' => true,
    'no_singleline_whitespace_before_semicolons' => true,
    'indentation_type' => true,
    'blank_line_after_namespace' => true,
    'blank_line_after_opening_tag' => true,
    'class_attributes_separation' => true,
    'single_blank_line_at_eof' => true,
    'compact_nullable_typehint' => true,
    'function_typehint_space' => true,
    'fully_qualified_strict_types' => true,
    'function_declaration' => true,
    'no_spaces_after_function_name' => true,
    'no_whitespace_before_comma_in_array' => true,
    'whitespace_after_comma_in_array' => true,
    'trim_array_spaces' => true,
    'no_leading_namespace_whitespace' => true,
    'single_line_after_imports' => true,
    'return_type_declaration' => true,
    'trailing_comma_in_multiline_array' => true,
    'binary_operator_spaces' => array(
        'align_double_arrow' => false,
        'align_equals' => false,
    ),
];

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
;

return PhpCsFixer\Config::create()
    ->setFinder($finder)
    ->setRiskyAllowed(true)
    ->setRules($rules)
    ->setUsingCache(true)
    ->setLineEnding("\n")
;
