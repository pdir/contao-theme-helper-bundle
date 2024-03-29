<?php

declare(strict_types=1);

/**
 * pdir theme helper bundle for Contao Open Source CMS
 *
 * Copyright (C) 2022 pdir GmbH / pdir / digital agentur <develop@pdir.de>
 *
 * @package    pdir/contao-theme-helper-bundle
 * @link       https://github.com/pdir/contao-theme-helper-bundle
 * @license    LGPL-3.0+
 * @author     Mathias Arzberger <develop@pdir.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Pdir\ThemeHelperBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
/**
 * Configures the ThemeHelper bundle.
 *
 * @author Mathias Arzberger <develop@pdir.de>
 */
class ThemeHelperBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
