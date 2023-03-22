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

$GLOBALS['TL_LANG']['MOD']['contaoThemesNet'][0] = 'contao-themes.net';
$GLOBALS['TL_LANG']['MOD']['thLicence'][0] = 'Theme Lizenz';

// theme helper tags
$GLOBALS['TL_LANG']['tl_article']['pdir_th_tag'] = ['Theme Helper Tag', 'Bitte wählen Sie einen Theme Helper Tag um den Inhalt dieses Artikels als Insert Tag zu nutzen.'];
$GLOBALS['TL_LANG']['tl_article']['pdir_th_domain'] = ['Seitenname', 'Bitte wählen Sie die entsprechende Seite (Seitenname des Webseiten-Startpunktes) aus um den Inhalt dieses Artikels als Insert Tag zu nutzen.'];

// theme desc & license
$GLOBALS['TL_LANG']['tl_theme']['pdir_th_description'] = ['Beschreibung', 'Die Theme Beschreibung wird durch die Theme Einstellungen vorgegeben.'];
$GLOBALS['TL_LANG']['tl_theme']['pdir_th_license_domain'] = ['Theme lizensiert für', 'Dieser Theme wurde für diese Domain kostenpflichtig lizensiert.'];
$GLOBALS['TL_LANG']['tl_theme']['pdir_th_license_text'] = ' // Copyright-Link darf nicht entfernt werden.';
$GLOBALS['TL_LANG']['tl_theme']['pdir_th_payed_license_text'] = ' // kostenpflichtig registriert für ';
$GLOBALS['TL_LANG']['tl_theme']['pdir_th_short_code'] = ['Theme Code', 'Theme code.'];

$GLOBALS['TL_LANG']['tl_theme']['buyTheme'] = 'Kostenpflichtige Lizenz kaufen.';
$GLOBALS['TL_LANG']['MSC']['buyThemeConfirm'] = 'Möchten Sie für diesen Theme eine kostenplichtige Lizenz erwerben?';
$GLOBALS['TL_LANG']['MSC']['buyThemeButtonTitle'] = 'Theme Lizenz kaufen';
$GLOBALS['TL_LANG']['MSC']['checkDomainButtonText'] = 'Theme Domain aktivieren';
$GLOBALS['TL_LANG']['MSC']['checkDomainButtonTitle'] = 'Hier können Sie eine Domainlizenz für das Theme aktivieren.';

$GLOBALS['TL_LANG']['MSC']['th_explanation'] = '<p><strong>Hier kannst du deine gekaufte Domain Lizenz an einen Theme binden.</strong></p><p>Bei der Überprüfung der Domain wird die IP des Server an pdir, dem Betreiber von contao-themes.net übertragen.<br>Die IP wird ausschließlich zu Registrierung und Überprüfung deiner Theme Lizenz verwendet.</p>';
$GLOBALS['TL_LANG']['MSC']['th_insert_domain'] = 'Bitte Domain angeben';
$GLOBALS['TL_LANG']['MSC']['th_domain_tip'] = 'Hier kannst du die Domain angeben. (Bsp. contao-themes.net oder meissen.online, ohne http(s)://)';
$GLOBALS['TL_LANG']['MSC']['th_button_check'] = 'Check Domain';

$GLOBALS['TL_LANG']['MSC']['th_readonly_message'] = 'Bitte bearbeiten Sie das Theme und tragen im Feld <strong>Theme Code</strong> den entsprechenden Theme Code ein.<br><br>MATE Theme: <strong>mate</strong><br>ODD Theme: <strong>odd</strong><br>NATURE Theme: <strong>nature</strong><br>0.1 Theme: <strong>0.1</strong><br>CONVERT Theme: <strong>convert</strong><br><br>Danach sollten Sie Ihre Domain registrieren können.<br><br>Detaillierte Informationen finden Sie auch auf:<a href="https://docs.contao-themes.net/#/" target="_blank" rel="noopener" style="color:orange;font-weight:700;">docs.contao-themes.net</a>.';
$GLOBALS['TL_LANG']['MSC']['th_domain_note'] = 'Bitte geben Sie die Domain <strong>ohne http(s):// und www</strong> ein, z. B. meinedomain.de. Subdomains müssen explizit angegeben werden, z. B. shop.meinedomain.de.';
