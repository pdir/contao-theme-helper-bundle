<?php

declare(strict_types=1);

/**
 * Theme Helper Bundle for Contao Open Source CMS
 *
 * Copyright (C) 2022 pdir GmbH // pdir / digital agentur <https://pdir.de>
 *
 * @package    pdir/contao-theme-helper-bundle
 * @link       https://github.com/pdir/contao-theme-helper-bundle
 * @license    LGPL-3.0+
 * @author     Mathias Arzberger <develop@pdir.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Pdir\ThemeHelperBundle\Backend;

use Contao\BackendModule;
use Contao\Environment;
use Contao\Input;
use Contao\ThemeModel;
use Contao\System;

class Licence extends BackendModule
{
    protected string $strTemplate = 'be_th_check_domain';

    /**
     * Generate the module
     */
    protected function compile()
    {
        $this->Template->explanation = $GLOBALS['TL_LANG']['MSC']['th_explanation'];
        $this->Template->domainLabel = $GLOBALS['TL_LANG']['MSC']['th_insert_domain'];
        $this->Template->domainTip = $GLOBALS['TL_LANG']['MSC']['th_domain_tip'];
        $this->Template->buttonCheck = $GLOBALS['TL_LANG']['MSC']['th_button_check'];
        $this->Template->shortCode = Input::get('shortCode') ? : Input::post('shortCode');
        $this->Template->theme = Input::get('theme');
        $this->Template->message = null;
        $this->Template->requestToken = System::getContainer()->get('contao.csrf.token_manager')->getDefaultTokenValue();

        switch (Input::get('act')) {
            case 'checkDomain':
                // make request to pdir api
                $url = 'https://pdir.de/api/themes?';

                $params = [
                    'domain' => Input::post('domain'),
                    'ip' => Environment::get('server'),
                ];

                $url .= \http_build_query($params);

                $ch = \curl_init($url);
                \curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept:application/json, Content-Type:application/json']);
                \curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                \curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                // response
                $response = \json_decode(\curl_exec($ch), true);

                if(isset($response['message']) && Input::post('theme'))
                {
                    // Domain is registered
                    if($response['message'] == 'Domain registered' && $response['domain'])
                    {
                        /** @var ThemeModel $objTheme */
                        $objTheme = ThemeModel::findById(Input::post('theme'));
                        $objTheme->pdir_th_license_domain = $response['domain'];
                        $objTheme->save();
                    }


                    $this->Template->message = $response['message'];
                    break;
                }

                break;
            default:
                if(!Input::get('shortCode'))
                {
                    $this->Template->readonly = true;
                }

        }
    }
}
