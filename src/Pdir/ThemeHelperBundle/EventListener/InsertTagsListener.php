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
declare(strict_types=1);
namespace Pdir\Contao\ThemeHelperBundle\EventListener;

use Contao\CoreBundle\Framework\ContaoFrameworkInterface;
use Contao\Events;
use Contao\StringUtil;

/**
 * Handles insert tags for themes.
 *
 * @author     Mathias Arzberger <develop@pdir.de>
 */
class InsertTagsListener
{
    /**
     * @var ContaoFrameworkInterface
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
     *
     * @param ContaoFrameworkInterface $framework
     */
    public function __construct(ContaoFrameworkInterface $framework)
    {
        $this->framework = $framework;
    }
    /**
     * Replaces theme insert tags.
     *
     * @param string $tag
     *
     * @return string|false
     */
    public function onReplaceInsertTags($tag)
    {
        $elements = explode('::', $tag);
        $key = strtolower($elements[0]);
        if (in_array($key, $this->supportedTags, true)) {
            return $this->replaceThemeInsertTag($key, $elements[1], $elements[2]);
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
    private function replaceThemeInsertTag($tagType, $themeTag)
    {
        $this->framework->initialize();
        switch ($tagType) {
            // get article content by theme helper tag
            case 'content':
                /** @var ArticleModel $adapter */
                $adapter = $this->framework->getAdapter(ArticleModel::class);
                if (null === ($article = $adapter->findOneBy('pdir_th_tag', $themeTag))) {
                    return '';
                }
                return $this->generateArticleReplacement($article);
                break;
        }
        return false;
    }
    /**
     * Generates the article replacement string.
     *
     * @param ArticleModel $article
     *
     * @return string
     */
    private function generateArticleReplacement(ArticleModel $article)
    {
        /** @var Article $adapter */
        $adapter = $this->framework->getAdapter(Article::class);
        return $adapter->getArticle($article);
    }
}
