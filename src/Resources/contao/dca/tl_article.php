<?php

/**
 * Add fields to tl_content
 */
$GLOBALS['TL_DCA']['tl_article']['palettes']['default'] = str_replace
(
    'customTpl',
    'customTpl,pdir_th_tag,pdir_th_domain',
    $GLOBALS['TL_DCA']['tl_article']['palettes']['default']
);

/**
 * Add fields to tl_article
 */
$GLOBALS['TL_DCA']['tl_article']['fields']['pdir_th_tag'] = array
(
    'label'         => &$GLOBALS['TL_LANG']['tl_article']['pdir_th_tag'],
    'inputType'     => 'select',
    'search'        => true,
    'options'       => $GLOBALS['tl_config']['theme_tags'],
    'reference'     => &$GLOBALS['TL_LANG']['tl_article']['th_tags'],
    'eval'          => array('mandatory'=>false, 'maxlength'=>64, 'tl_class'=>'w50 wizard'),
    'sql' => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_article']['fields']['pdir_th_domain'] = array
(
    'label'         => &$GLOBALS['TL_LANG']['tl_article']['pdir_th_domain'],
    'inputType'     => 'select',
    'search'        => true,
    'options_callback' => array('tl_article_themeHelper', 'findAllRootPages'),
    'reference'     => &$GLOBALS['TL_LANG']['tl_article']['th_tags'],
    'eval'          => array('mandatory'=>false, 'maxlength'=>64, 'tl_class'=>'w50 wizard', 'includeBlankOption' => true),
    'sql' => "varchar(64) NOT NULL default ''"
);

class tl_article_themeHelper extends Backend
{
    public static function findAllRootPages()
    {
        $t = 'tl_page';

        $arrColumns = array("$t.type=?");
        $arrValues = array('root');

        $arrOptions = array
        (
            'order'  => "$t.sorting ASC"
        );

        $objPages = PageModel::findBy($arrColumns, $arrValues, $arrOptions);

        $domains = array();
        while($objPages->next()) {
            if($objPages->current()->title != "")
                $domains[$objPages->current()->id] = $objPages->current()->title;
        }
        return $domains;
    }
}