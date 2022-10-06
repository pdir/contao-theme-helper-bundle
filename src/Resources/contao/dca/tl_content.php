<?php

use Pdir\ThemeHelperBundle\EventListener\ContentFieldPermissionsListener;

$GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = [ContentFieldPermissionsListener::class, '__invoke'];
