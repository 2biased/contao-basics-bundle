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
use Contao\CoreBundle\ServiceAnnotation\FrontendModule;
use Contao\Environment;
use Contao\FilesModel;
use Contao\ModuleModel;
use Contao\PageModel;
use Contao\System;
use Contao\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @FrontendModule(category="miscellaneous")
 */
class BrandController extends AbstractFrontendModuleController
{
    protected function getResponse(Template $template, ModuleModel $model, Request $request): Response|null
    {
        $page = $this->getPageModel();

        if (($logo = FilesModel::findByUuid($page->brand_logo)) !== null && file_exists(System::getContainer()->getParameter('kernel.project_dir').'/'.$logo->path)) {
            $figure = System::getContainer()
                ->get('contao.image.studio')
                ->createFigureBuilder()
                ->from($logo)
                ->setSize($model->imgSize)
                ->buildIfResourceExists()
            ;

            if (null !== $figure) {
                $figure->applyLegacyTemplateData($template);
            } else {
                return new Response();
            }
        } else {
            return new Response();
        }

        if ($homePage = PageModel::findFirstPublishedByPid($page->rootId)) {
            $href = $homePage->getFrontendUrl();
        } else {
            $href = Environment::get('url');
        }

        $template->href = $href ?: '/';
        $template->linkTitle = $page->rootPageTitle ?: $page->rootTitle;

        return $template->getResponse();
    }
}
