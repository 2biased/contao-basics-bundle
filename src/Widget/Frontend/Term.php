<?php

declare(strict_types=1);

/*
 * This file is part of Contao Basics Bundle.
 *
 * @author 2biased <2biased@proton.me>
 *
 * @license LGPL-3.0-or-later
 */

namespace TwoBiased\ContaoBasicsBundle\Widget\Frontend;

use Contao\StringUtil;
use Contao\Widget;

class Term extends Widget
{
    protected $blnSubmitInput = true;
    protected $blnForAttribute = true;
    protected $strTemplate = 'form_term';
    protected $strPrefix = 'widget widget-term';

    public function __set($strKey, $varValue): void
    {
        switch ($strKey) {
            case 'mandatory':
                if ($varValue) {
                    $this->arrAttributes['required'] = 'required';
                } else {
                    unset($this->arrAttributes['required']);
                }
                parent::__set($strKey, $varValue);
                break;

            case 'text':
                $this->text = StringUtil::encodeEmail($varValue);
                break;

            default:
                parent::__set($strKey, $varValue);
                break;
        }
    }

    public function isAccepted()
    {
        return empty($this->varValue) ? '' : ' checked';
    }

    public function generate()
    {
        return '';
    }
}
