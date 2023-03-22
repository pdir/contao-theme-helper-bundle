<?php

$GLOBALS['TL_DCA']['tl_user_group']['palettes']['default'] = str_replace('formp;', 'formp;{pdir_theme_helper_legend},pdirThemeHelperArticleFields,pdirThemeHelperContentElementFields;', $GLOBALS['TL_DCA']['tl_user_group']['palettes']['default']);

$GLOBALS['TL_DCA']['tl_user_group']['fields']['pdirThemeHelperArticleFields'] = [
    'exclude' => true,
    'inputType' => 'checkbox',
    'options' => ['pdir_th_tag', 'pdir_th_domain'],
    'reference' => &$GLOBALS['TL_LANG']['tl_user_group']['pdirThemeHelperArticleFieldsValues'],
    'eval' => ['multiple' => true],
    'sql' => "blob NULL",
];

$GLOBALS['TL_DCA']['tl_user_group']['fields']['pdirThemeHelperContentElementFields'] = [
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
