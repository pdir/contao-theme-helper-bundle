<?php

/*
 * Replace label function
 */
$GLOBALS['TL_DCA']['tl_theme']['list']['label']['label_callback'] = array('tl_theme_extended', 'addPreviewImageAndDesc');

/*
 * add fields to pallet
 */
$GLOBALS['TL_DCA']['tl_theme']['palettes']['default'] = str_replace
(
	',author',
	',author,pdir_th_license_domain',
	$GLOBALS['TL_DCA']['tl_theme']['palettes']['default']
);

/**
 * Add fields to tl_theme
 */
$GLOBALS['TL_DCA']['tl_theme']['fields']['pdir_th_description'] = array
(
	'label' => &$GLOBALS['TL_LANG']['tl_theme']['pdir_th_description'],
	'exclude' => true,
	'search' => false,
	'sorting' => false,
	'inputType' => 'textarea',
	'eval' => array('tl_class' => 'clr', 'readonly' => true),
	'sql' => "mediumtext NULL"
);

$GLOBALS['TL_DCA']['tl_theme']['fields']['pdir_th_license_domain'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_theme']['pdir_th_license_domain'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('tl_class' => 'w50', 'maxlength'=> 128, 'readonly' => true),
	'sql'                     => "varchar(128) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_theme']['fields']['pdir_th_short_code'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_theme']['pdir_th_short_code'],
    'exclude'                 => true,
    'inputType'               => 'text',
    'eval'                    => array('tl_class' => 'w50', 'maxlength'=> 32),
    'sql'                     => "varchar(32) NOT NULL default ''"
);

class tl_theme_extended extends tl_theme
{
	/**
	 * Add an image and a description to each record
	 *
	 * @param array $row
	 * @param string $label
	 *
	 * @return string
	 */
	public function addPreviewImageAndDesc($row, $label)
	{
        $themeUrl = 'https://contao-themes.net/';
        $themeShortCode = $row['pdir_th_short_code'];

		// add buy action if needed
		if ($row['pdir_th_description'] != '') {
		    if($themeShortCode != '')
		    {
		        $themeUrl .= 'buy-' . $row['pdir_th_short_code'] . '.html';
            }
			$label = '<span><a href="' . $themeUrl . '" target="_blank" rel="noopener"><img src="bundles/themehelper/img/buy_theme.png" ' .
                ' title="' . $GLOBALS['TL_LANG']['tl_theme']['buyTheme'] . '"' .
				' style="width:25px;margin: 10px 10px 10px 0;"></a></span>' . $label;
		}

		// add image
		$label = $this->addPreviewImage($row, $label);

		// add theme and license description
		if ($row['pdir_th_description'] != '')
		{
			// add info icon
			$html = '<i class="icon" onmouseover="document.getElementById(\'themeDesc\').style.display = \'block\'"'.
				' onmouseout="document.getElementById(\'themeDesc\').style.display = \'none\'"'.
				' style="color:#fff;border-radius:50%;font-weight:bold;padding:3px;border:1px solid #649d9a;background:#649d9a;margin-left:10px;">i</i>';

			// license status
			if($row['pdir_th_license_domain'] != '')
				$html .= $GLOBALS['TL_LANG']['tl_theme']['pdir_th_payed_license_text'] . $row['pdir_th_license_domain'] .'<br>';
			else
				$html .= $GLOBALS['TL_LANG']['tl_theme']['pdir_th_license_text'] . '<br>';

            $html .= '<i class="icon"'.
                ' title="'.$GLOBALS['TL_LANG']['MSC']['checkDomainButtonTitle'].'"'.
                ' style="font-style:normal;color:#fff;font-weight:bold;padding:5px;border:1px solid #649d9a;background:#649d9a;"'.
                ' onclick="Backend.getScrollOffset();Backend.openModalSelector({\'width\':768,\'title\':\'' . $GLOBALS['TL_LANG']['MSC']['checkDomainButtonText'] . '\',\'url\':\'contao?do=thLicence&shortCode='.$themeShortCode.'&popup=1&theme='.$row['id'].'\',\'id\':\'checkDomain\'});return false"'.
                '">'.$GLOBALS['TL_LANG']['MSC']['checkDomainButtonText'].'</i>';

			// desc
			$html .= '<div id="themeDesc" style="display:none;line-height:1.2em;margin-top:5px;">';
			$html .= \StringUtil::decodeEntities($row['pdir_th_description']);
			$html .= '</div>';
			$label = $label . $html;
		}

		return $label;
	}
}
