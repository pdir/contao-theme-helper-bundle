<?php

declare(strict_types=1);

/**
 * Theme Helper Bundle for Contao Open Source CMS
 *
 * Copyright (C) 2022 pdir GmbH / pdir / digital agentur <develop@pdir.de>
 *
 * @package    pdir/contao-theme-helper-bundle
 * @link       https://github.com/pdir/contao-theme-helper-bundle
 * @license    LGPL-3.0+
 * @author     Mathias Arzberger <develop@pdir.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Pdir\ThemeHelperBundle\EventListener;

use Contao\Backend;
use Contao\BackendUser;
use Contao\ContentModel;
use Contao\CoreBundle\ServiceAnnotation\Callback;
use Contao\DataContainer;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * @Callback(table="tl_article", target="config.onload")
 */
class ArticleFieldPermissionsListener extends Backend
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        $this->import(BackendUser::class, 'User');
    }

    public function __invoke(DataContainer $dc = null): void
    {
        if (null === $dc || !$dc->id || 'edit' !== $this->requestStack->getCurrentRequest()->query->get('act')) {
            return;
        }

        if ($this->User->isAdmin) {
            return;
        }

        if (null === $this->User->pdirThemeHelperArticleFields) {
            return;
        }

        // Check user permissions
        if (null !== $this->User->pdirThemeHelperArticleFields) {
            foreach($this->User->pdirThemeHelperArticleFields as $field) {
                unset($GLOBALS['TL_DCA']['tl_article']['fields'][$field]);
            }
        }
    }
}
