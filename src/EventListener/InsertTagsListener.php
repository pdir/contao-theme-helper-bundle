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

namespace Pdir\ThemeHelperBundle\EventListener;

use Contao\ArticleModel;
use Contao\ContentElement;
use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\CoreBundle\ServiceAnnotation\Hook;

/**
 * Handles insert tags for themes.
 *
 * @Hook("replaceInsertTags")
 *
 * @author     Mathias Arzberger <develop@pdir.de>
 */
class InsertTagsListener
{
    /**
     * @var ContaoFramework
     */
    private $framework;

    /**
     * @var array
     */
    private $supportedTags = [
        'theme',
    ];

    /**
     * Constructor.
     */
    public function __construct(ContaoFramework $framework)
    {
        $this->framework = $framework;
    }

    public function __invoke(string $insertTag, bool $useCache, string $cachedValue, array $flags, array $tags, array $cache, int $_rit, int $_cnt)
    {
        $elements = explode('::', $insertTag);
        $key = strtolower($elements[0]);

        if (\in_array($key, $this->supportedTags, true)) {
            return $this->replaceThemeInsertTag($elements[1], $elements[2]);
        }

        return false;
    }

    /**
     * Replaces an event-related insert tag.
     *
     * @param string $tagType
     * @param string $themeTag
     *
     * @return string
     */
    private function replaceThemeInsertTag($tagType, $themeTag): bool|string
    {
        $rootPageId = $GLOBALS['objPage']->trail[0];

        $this->framework->initialize();

        switch ($tagType) {
            // get article content by theme helper tag
            case 'content':
                /** @var ArticleModel $adapter */
                $adapter = $this->framework->getAdapter(ArticleModel::class);
                //echo $themeTag."<br>"; echo $rootPageTitle."<br>";
                if (null === ($article = $adapter->findOneBy(['tl_article.pdir_th_tag=?', 'tl_article.pdir_th_domain=?'], [$themeTag, $rootPageId]))) {
                    if (null === ($article = $adapter->findOneBy('pdir_th_tag', $themeTag))) {
                        return '';
                    }
                }

                return $this->generateArticleReplacement($article);
        }

        return false;
    }

    /**
     * Generates the article replacement string.
     *
     * @return string
     */
    private function generateArticleReplacement(ArticleModel $article)
    {
        $adapter = $this->framework->getAdapter(ContentElement::class);

        return $adapter->getArticle($article);
    }
}
