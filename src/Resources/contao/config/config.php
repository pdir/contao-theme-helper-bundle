<?php

/**
 * Theme Helper Bundle for Contao Open Source CMS
 *
 * Copyright (C) 2017 pdir / digital agentur <develop@pdir.de>
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
 * Register hooks
 */
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('theme_helper.listener.insert_tags', 'onReplaceInsertTags');
