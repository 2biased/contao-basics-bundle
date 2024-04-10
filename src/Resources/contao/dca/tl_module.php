<?php

declare(strict_types=1);

/*
 * This file is part of Contao Basics Bundle.
 *
 * @author 2biased <2biased@proton.me>
 *
 * @license LGPL-3.0-or-later
 */

$GLOBALS['TL_DCA']['tl_module']['palettes']['brand'] = '{title_legend},name,type;{config_legend},imgSize;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID';
$GLOBALS['TL_DCA']['tl_module']['palettes']['container'] = '{title_legend},name,type;{config_legend},modules;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID';

$GLOBALS['TL_DCA']['tl_module']['fields']['modules'] = [
    'exclude' => true,
    'label' => &$GLOBALS['TL_LANG']['tl_module']['modules'],
    'exclude' => true,
    'inputType' => 'multiColumnEditor',
    'eval' => [
        'tl_class' => 'long clr',
        'multiColumnEditor' => [
            'minRowCount' => 1,
            'sortable' => true,
            'fields' => [
                'item' => [
                    'label' => &$GLOBALS['TL_LANG']['tl_module']['modules_item'],
                    'inputType' => 'select',
                    'eval' => ['mandatory' => true, 'groupStyle' => 'width: 50%', 'includeBlankOption' => true, 'chosen' => true, 'maxlength' => 255],
                ],
                'alias' => [
                    'label' => &$GLOBALS['TL_LANG']['tl_module']['modules_alias'],
                    'inputType' => 'text',
                    'eval' => ['groupStyle' => 'width: 150px', 'rgxp' => 'alias', 'maxlength' => 255],
                ],
            ],
        ],
    ],
    'sql' => 'blob NULL',
];
