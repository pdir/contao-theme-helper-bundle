<?php

$GLOBALS['TL_DCA']['tl_user']['palettes']['extend'] = str_replace('formp;', 'formp;{pdir_theme_helper_legend},pdirThemeHelperArticleFields,pdirThemeHelperContentElementFields;', $GLOBALS['TL_DCA']['tl_user']['palettes']['extend']);
$GLOBALS['TL_DCA']['tl_user']['palettes']['custom'] = str_replace('formp;', 'formp;{pdir_theme_helper_legend},pdirThemeHelperArticleFields,pdirThemeHelperContentElementFields;', $GLOBALS['TL_DCA']['tl_user']['palettes']['custom']);

$GLOBALS['TL_DCA']['tl_user']['fields']['pdirThemeHelperArticleFields'] = [
    'exclude' => true,
    'inputType' => 'checkbox',
    'options' => ['article' => ['pdir_th_tag', 'pdir_th_domain']],
    'reference' => &$GLOBALS['TL_LANG']['tl_user']['pdirThemeHelperArticleFieldsValues'],
    'eval' => ['multiple' => true],
    'sql' => "blob NULL",
];

$GLOBALS['TL_DCA']['tl_user']['fields']['pdirThemeHelperContentElementFields'] = [
    'exclude' => true,
    'inputType' => 'checkbox',
    'options_callback' => function() {
        $groups = [];
        foreach ($GLOBALS['TL_CTE'] as $k => $v) {
            foreach (array_keys($v) as $kk) {
                $groups[$k][] = $kk;
            }
        }
        return $groups;
    },
    'reference' => &$GLOBALS['TL_LANG']['CTE'],
    'eval' => ['multiple' => true],
    'sql' => "blob NULL",
];
