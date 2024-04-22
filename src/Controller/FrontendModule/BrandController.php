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
use Contao\CoreBundle\Image\Studio\Studio;
use Contao\CoreBundle\Routing\ContentUrlGenerator;
use Contao\CoreBundle\String\HtmlAttributes;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\ModuleModel;
use Contao\PageModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsFrontendModule(category: 'miscellaneous')]
class BrandController extends AbstractFrontendModuleController
{
    public function __construct(
        private readonly ContentUrlGenerator $urlGenerator,
        private readonly Studio $studio,
    ) {
    }

    protected function getResponse(FragmentTemplate $template, ModuleModel $model, Request $request): Response
    {
        $page = $this->getPageModel();

        if ($rootPage = PageModel::findFirstPublishedByPid($page->rootId)) {
            $href = $this->urlGenerator->generate($rootPage);
        } else {
            $href = $request->getUri();
        }

        $linkAttributes = (new HtmlAttributes())
            ->set('href', $href)
            ->setIfExists('title', $page->rootPageTitle ?: $page->rootTitle)
        ;

        $template->set('href', $href);
        $template->set('link_attributes', $linkAttributes);

        $figure = $this->studio
            ->createFigureBuilder()
            ->fromUuid($page->brand_logo ?: '')
            ->setSize($model->imgSize)
            ->setLinkAttributes($linkAttributes)
            ->buildIfResourceExists()
        ;

        if (null === $figure) {
            return new Response();
        }

        $template->set('image', $figure);

        return $template->getResponse();
    }
}
