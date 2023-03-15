<?php

declare(strict_types=1);

/*
 * theme components bundle for Contao Open Source CMS
 *
 * Copyright (C) 2023 pdir / digital agentur <develop@pdir.de>
 *
 * @package    contao-themes-net/theme-components-bundle
 * @link       https://github.com/contao-themes-net/theme-components-bundle
 * @license    LGPL-3.0+
 * @author     pdir GmbH <develop@pdir.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Pdir\ThemeHelperBundle\Backend;

use Contao\BackendModule;
use Contao\Environment;
use Contao\Input;
use Contao\System;
use Contao\ThemeModel;
use Symfony\Component\HttpClient\HttpClient;

class Licence extends BackendModule
{
    protected $strTemplate = 'be_th_check_domain';

    /**
     * Generate the module.
     */
    protected function compile(): void
    {
        $this->Template->explanation = $GLOBALS['TL_LANG']['MSC']['th_explanation'];
        $this->Template->domainLabel = $GLOBALS['TL_LANG']['MSC']['th_insert_domain'];
        $this->Template->domainTip = $GLOBALS['TL_LANG']['MSC']['th_domain_tip'];
        $this->Template->buttonCheck = $GLOBALS['TL_LANG']['MSC']['th_button_check'];
        $this->Template->shortCode = Input::get('shortCode') ?: Input::post('shortCode');
        $this->Template->theme = Input::get('theme') ?: Input::post('theme');
        $this->Template->message = null;
        $this->Template->requestToken = System::getContainer()->get('contao.csrf.token_manager')->getDefaultTokenValue();
        $this->Template->reloadPage = false;

        switch (Input::get('act')) {
            case 'checkDomain':
                // make request to pdir api

                $options = [
                    'base_uri' => 'https://pdir.de/api/',
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ],
                ];

                $queryParams = [
                    'domain' => Input::post('domain'),
                    'ip' => Environment::get('server'),
                ];

                $url = 'themes?';

                $client = HttpClient::create($options);

                // engage
                $response = $client->request('GET', $url, ['query' => $queryParams]);
                // gets the HTTP status code of the response
                $statusCode = $response->getStatusCode();

                if (200 !== $statusCode) {
                    $this->Template->message = $statusCode." [HTTP Status $statusCode]";
                    break;
                }

                // get response as json
                $content = $response->toArray();

                if (isset($content['message']) && Input::post('theme')) {
                    // Domain is registered
                    if ('Domain registered' === $content['message'] && $content['domain']) {
                        /** @var ThemeModel $objTheme */
                        $objTheme = ThemeModel::findById(Input::post('theme'));
                        $objTheme->pdir_th_license_domain = $content['domain'];
                        $objTheme->save();

                        $this->Template->reloadPage = true;
                    }

                    $this->Template->message = $content['message'];
                    break;
                }

                break;

            default:
                if (!Input::get('shortCode')) {
                    $this->Template->readonly = true;
                }
        }
    }
}
