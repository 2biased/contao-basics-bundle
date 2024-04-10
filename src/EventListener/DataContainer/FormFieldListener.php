<?php

declare(strict_types=1);

/*
 * This file is part of Contao Basics Bundle.
 *
 * @author 2biased <2biased@proton.me>
 *
 * @license LGPL-3.0-or-later
 */

namespace TwoBiased\ContaoBasicsBundle\EventListener\DataContainer;

use Contao\CoreBundle\ServiceAnnotation\Callback;
use Contao\DataContainer;
use Contao\FormFieldModel;

class FormFieldListener
{
    /**
     * @Callback(table="tl_form_field", target="config.onload")
     */
    public function adjustDcaByType(DataContainer $dc = null): void
    {
        if (($objField = FormFieldModel::findByPk($dc->id)) !== null) {
            switch ($objField->type) {
                case 'term':
                    $GLOBALS['TL_DCA']['tl_form_field']['fields']['text']['eval']['rte'] = 'tinyLabel';
                    break;
            }
        }
    }
}
