<?php

declare(strict_types=1);

/*
 * This file is part of Contao Basics Bundle.
 *
 * @author 2biased <2biased@proton.me>
 *
 * @license LGPL-3.0-or-later
 */

use Contao\Config;
use Contao\CoreBundle\DataContainer\PaletteManipulator;

/*
 * Palettes
 */
PaletteManipulator::create()
    ->addField('brand_logo', 'website_legend', PaletteManipulator::POSITION_PREPEND)
    ->applyToPalette('root', 'tl_page')
    ->applyToPalette('rootfallback', 'tl_page')
;

PaletteManipulator::create()
    ->addLegend('website_legend', 'meta_legend', PaletteManipulator::POSITION_AFTER)
    ->addField('brand_logo', 'website_legend', PaletteManipulator::POSITION_PREPEND)
    ->applyToPalette('regular', 'tl_page')
;

/*
 * Fields
 */
$GLOBALS['TL_DCA']['tl_page']['fields']['brand_logo'] = [
    'exclude' => true,
    'inputType' => 'fileTree',
    'eval' => ['filesOnly' => true, 'fieldType' => 'radio', 'extensions' => Config::get('validImageTypes'), 'tl_class' => 'clr'],
    'sql' => 'binary(16) NULL',
];
