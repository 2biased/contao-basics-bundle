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

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;
use Contao\ModuleModel;

class ModuleListener
{
    #[AsCallback(table: 'tl_module', target: 'fields.modules.eval.multiColumnEditor.fields.item.options')]
    public function getModules(DataContainer $dc): array
    {
        $arrModules = [];

        if (($objModules = ModuleModel::findByPid($dc->activeRecord->pid, ['order' => 'name ASC'])) !== null) {
            while ($objModules->next()) {
                if ($dc->activeRecord->id === $objModules->id) {
                    continue;
                }

                $arrModules[$objModules->id] = sprintf(
                    '%s [%s]',
                    $objModules->name,
                    isset($GLOBALS['TL_LANG']['FMD'][$objModules->type]) ? $GLOBALS['TL_LANG']['FMD'][$objModules->type][0] : $objModules->type,
                );
            }
        }

        return $arrModules;
    }
}
