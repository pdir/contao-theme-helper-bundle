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

/**
 * Backend Modules
 */
array_insert($GLOBALS['BE_MOD']['contaoThemesNet'], 1, [
    'thLicence' => [
        'callback'          => 'Pdir\\ThemeHelperBundle\\Backend\\Licence',
        'tables'            => [],
    ],
]);

/**
 * Register hooks
 */
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = ['theme_helper.listener.insert_tags', 'onReplaceInsertTags'];

/**
 * Javascript for Backend
 */
if (TL_MODE == 'BE')
{
    if (!isset($GLOBALS['TL_CSS']))
    {
        $GLOBALS['TL_CSS'] = [];
    }

    $GLOBALS['TL_CSS'][] =  'bundles/themehelper/sass/th_check_domain.scss||static';
}
