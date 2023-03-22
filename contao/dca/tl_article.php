<?php

declare(strict_types=1);

/*
 * Theme Helper Bundle for Contao Open Source CMS
 *
 * Copyright (C) 2023 pdir GmbH / pdir / digital agentur <develop@pdir.de>
 *
 * @package    pdir/contao-theme-helper-bundle
 * @link       https://github.com/pdir/contao-theme-helper-bundle
 * @license    LGPL-3.0+
 * @author     Mathias Arzberger <develop@pdir.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Contao\Backend;
use Contao\PageModel;

/*
 * Add fields to tl_content
 */
$GLOBALS['TL_DCA']['tl_article']['palettes']['default'] = str_replace(
    'customTpl',
    'customTpl,pdir_th_tag,pdir_th_domain',
    $GLOBALS['TL_DCA']['tl_article']['palettes']['default']
);

/*
 * Add fields to tl_article
 */
$GLOBALS['TL_DCA']['tl_article']['fields']['pdir_th_tag'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_article']['pdir_th_tag'],
    'inputType' => 'select',
    'search' => true,
    'options' => $GLOBALS['tl_config']['theme_tags'] ?? [],
    'reference' => &$GLOBALS['TL_LANG']['tl_article']['th_tags'],
    'eval' => ['mandatory' => false, 'maxlength' => 64, 'tl_class' => 'w50 wizard'],
    'sql' => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_article']['fields']['pdir_th_domain'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_article']['pdir_th_domain'],
    'inputType' => 'select',
    'search' => true,
    'options_callback' => ['tl_article_themeHelper', 'findAllRootPages'],
    'reference' => &$GLOBALS['TL_LANG']['tl_article']['th_tags'],
    'eval' => ['mandatory' => false, 'maxlength' => 64, 'tl_class' => 'w50 wizard', 'includeBlankOption' => true],
    'sql' => "varchar(64) NOT NULL default ''",
];

class tl_article_themeHelper extends Backend
{
    public static function findAllRootPages()
    {
        $t = 'tl_page';

        $arrColumns = ["$t.type=?"];
        $arrValues = ['root'];

        $arrOptions = [
            'order' => "$t.sorting ASC",
        ];

        $objPages = PageModel::findBy($arrColumns, $arrValues, $arrOptions);

        $domains = [];

        while ($objPages->next()) {
            if ('' !== $objPages->current()->title) {
                $domains[$objPages->current()->id] = $objPages->current()->title;
            }
        }

        return $domains;
    }
}
