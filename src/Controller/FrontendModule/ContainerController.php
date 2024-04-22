<?php

declare(strict_types=1);

/*
 * This file is part of Contao Basics Bundle.
 *
 * @author 2biased <2biased@proton.me>
 *
 * @license LGPL-3.0-or-later
 */

namespace TwoBiased\ContaoBasicsBundle\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\ModuleModel;
use Contao\StringUtil;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsFrontendModule(category: 'miscellaneous')]
class ContainerController extends AbstractFrontendModuleController
{
    protected function getResponse(FragmentTemplate $template, ModuleModel $model, Request $request): Response
    {
        $modules = array_reduce(StringUtil::deserialize($model->modules, true), static fn ($carry, array $module) => array_merge($carry, [$module['alias'] => $module['item']]), []);

        if (empty($modules)) {
            return new Response();
        }

        $template->set('modules', $modules);

        return $template->getResponse();
    }
}
