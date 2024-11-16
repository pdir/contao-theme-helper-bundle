<?php

/**
 * Theme Helper Bundle for Contao Open Source CMS
 *
 * Copyright (C) 2019 pdir GmbH // pdir / digital agentur <develop@pdir.de>
 *
 * @package    pdir/contao-theme-helper-bundle
 * @link       https://github.com/pdir/contao-theme-helper-bundle
 * @license    LGPL-3.0+
 * @author     Mathias Arzberger <develop@pdir.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Contao\System;
use Symfony\Component\HttpFoundation\Request;

/**
 * Backend Modules
 */
if (!isset($GLOBALS['BE_MOD']['contaoThemesNet'])) {
    $GLOBALS['BE_MOD']['contaoThemesNet'] = [];
}

$GLOBALS['BE_MOD']['contaoThemesNet']['thLicence'] = [
    'callback' => 'Pdir\\ThemeHelperBundle\\Backend\\Licence',
    'tables'  => [],
];

/**
 * Register hooks
 */
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = ['theme_helper.listener.insert_tags', 'onReplaceInsertTags'];

/**
 * Javascript for Backend
 */
if (System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest(System::getContainer()->get('request_stack')->getCurrentRequest() ?? Request::create('')))
{
    if (!isset($GLOBALS['TL_CSS']))
    {
        $GLOBALS['TL_CSS'] = [];
    }

    $GLOBALS['TL_CSS'][] =  'bundles/themehelper/sass/th_check_domain.css||static';
}
