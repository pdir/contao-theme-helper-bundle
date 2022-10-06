<?php

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
declare(strict_types=1);

namespace Pdir\ThemeHelperBundle\EventListener;

use Contao\Backend;
use Contao\ContentModel;
use Contao\DataContainer;
use Contao\Input;

class ArticleFieldPermissionsListener extends Backend
{
    public function __construct()
    {
        $this->import('BackendUser', 'User');
    }

    public function __invoke(DataContainer $dc = null)
    {
        if (null === $dc || !$dc->id || Input::get('act') !== 'edit') {
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
