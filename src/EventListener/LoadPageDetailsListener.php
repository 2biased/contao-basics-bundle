<?php

declare(strict_types=1);

/*
 * This file is part of Contao Basics Bundle.
 *
 * @author 2biased <2biased@proton.me>
 *
 * @license LGPL-3.0-or-later
 */

namespace TwoBiased\ContaoBasicsBundle\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\PageModel;

#[AsHook('loadPageDetails')]
class LoadPageDetailsListener
{
    public function __invoke(array $parentModels, PageModel $page): void
    {
        $page->cssClass = trim($page->cssClass.' '.str_replace('/', '-', $page->alias));

        if (!$page->brand_logo) {
            foreach ($parentModels as $parent) {
                if ($parent->brand_logo) {
                    $page->brand_logo = $parent->brand_logo;
                    break;
                }
            }
        }
    }
}
