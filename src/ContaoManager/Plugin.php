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
namespace Pdir\ThemeHelperBundle\ContaoManager;

use Pdir\ThemeHelperBundle\ThemeHelperBundle;
use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;

/**
 * Plugin for the Contao Manager.
 *
 * @author Mathias Arzberger <develop@pdir.de>
 */
class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(ThemeHelperBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
