<?php
/**
 * Виджет веб-приложения GearMagic.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

namespace Gm\Widget\Article;

use Gm;
use Gm\Helper\Str;
use Gm\Site\Data\Model\Article;
use Gm\View\WidgetResourceTrait;
use Gm\View\MarkupViewInterface;

/**
 * Виджет "Статья" предназначен для отображения статьи сайта с указанными параметрами.
 * 
 * Пример использования с менеджером виджетов:
 * ```php
 * $articles = Gm::$app->widgets->get('gm.wd.article', ['showHeader' => false, 'viewFile' => '/articles/default.phtml']);
 * $articles->run();
 * ```
 * 
 * Пример использования в шаблоне:
 * ```php
 * echo $this->widget('gm.wd.article', [
 *     'showHeader' => false,
 *     'viewFile'   => '/articles/default.phtml'
 * ]);
 * ```
 * 
 * Пример использования с namespace:
 * ```php
 * use Gm\Widget\Article\Widget as Article;
 * 
 * echo Article::widget(['showHeader' => 'false', 'viewFile' => '/articles/default.phtml']);
 * ```
 * если namespace ранее не добавлен в PSR, необходимо выполнить:
 * ```php
 * Gm::$loader->addPsr4('Gm\Widget\Article\\', Gm::$app->modulePath . '/gm/gm.wd.article/src');
 * ```
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Gm\Widget\Article
 * @since 1.0
 */
class Widget extends \Gm\View\Widget implements MarkupViewInterface
{
    use WidgetResourceTrait;

    /**
     * Материал.
     * 
     * @see Widget::init()
     * 
     * @var Article|null
     */
    public ?Article $article = null;

    /**
     * Файл шаблона материала.
     * 
     * @var string
     */
    public string $viewFile = '/articles/default.phtml';

    /**
     * Показать заголовок.
     * 
     * @var bool
     */
    public bool $showHeader = true;

    /**
     * Показать изображение анонса в статье.
     * 
     * @var bool
     */
    public bool $showImage = true;

    /**
     * Показать содержимое (компонентов) перед текстом статьи.
     * 
     * @var bool
     */
    public bool $showTextBefore = true;

    /**
     * Показать содержимое (компонентов) после текста статьи.
     * 
     * @var bool
     */
    public bool $showTextAfter = true;

    /**
     * Показать дату публикации.
     * 
     * @var bool
     */
    public bool $showPublishedDate = true;

    /**
     * {@inheritdoc}
     */
    public function init(): void
    {
        // если приминяется разметка представления
        if (Gm::$app->isViewMarkup()) {
            $this->initTranslations();
        }
        // если материал не указан в параметрах виджета, значит
        // статья текущая
        if ($this->article === null) {
            $this->article = Gm::$app->page->getArticle() ?: null;
        }
    }

    /**
     * Возвращает заголовок виджета для разметки.
     * 
     * @return string
     */
    public function getTitle(): string
    {
        if (empty($this->article)) {
            return $this->t('{name}');
        }

        $title = $this->article->header ?: $this->article->title;
        if (empty($title)) {
            return $this->t('{name}');
        }
        return $this->t('Site article "{0}"', [Str::ellipsis($title, 0, 23)]);
    }

    /**
     * {@inheritdoc}
     */
    public function getMarkupOptions(array $options = []): array
    {
        // если статья не указана или отсутствует
        if (empty($this->article)) return [];

        $title = $this->getTitle();
        return [
            'component'  => 'widget',
            'uniqueId'   => $this->id,
            'dataId'     => 0,
            'registryId' => $this->registry['id'] ?? '',
            'title'      => $title,
            'control'    => [
                'text'  => $title, 
                'route' => '@backend/articles/form/view/' . $this->article->id . '?type=' . $this->article->typeId,
                'icon'  => $this->getAssetsUrl() . '/images/icon_small.svg'
            ],
            'menu' => [
                [
                    'text'  => $this->t('All articles'), 
                    'route' => '@backend/articles',
                    'icon'  => $this->getAssetsUrl() . '/images/icon-item-articles.svg'
                ],
                [
                    'text'  => $this->t('Edit article'), 
                    'route' => '@backend/articles/form/view/' . $this->article->id . '?type=' . $this->article->typeId,
                    'icon'  => $this->getAssetsUrl() . '/images/icon-item-article_edit.svg'
                ],
                ['text' => '-'],
                [
                    'text'  => $this->t('Add article'),
                    'route' => '@backend/articles/form',
                    'icon'  => $this->getAssetsUrl() . '/images/icon-item-article_add.svg'
                ],
                [
                    'type'    => 'request',
                    'text'    => $this->t('Delete article'), 
                    'route'   => '@backend/articles/form/delete/' . $this->article->id . '?type=' . $this->article->typeId,
                    'confirm' => $this->t('Are you sure you want to delete the article?'),
                    'icon'    => $this->getAssetsUrl() . '/images/icon-item-article_delete.svg'
                ],
                ['text' => '-'],
                [
                    'text'   => $this->t('Markup settings'),
                    'route'  => '@backend/site-markup/settings/view/' . ($this->registry['rowId'] ?? 0),
                    'params' => [
                        'id'                => $this->id,
                        'calledFrom'        => $this->calledFromViewFile,
                        'showHeader'        => $this->showHeader,
                        'showImage'         => $this->showImage,
                        'showTextBefore'    => $this->showTextBefore,
                        'showTextAfter'     => $this->showTextAfter,
                        'showPublishedDate' => $this->showPublishedDate,
                    ],
                    'iconCls' => 'gm-markup__icon-markup-settings'
                ]
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function run(): mixed
    {
        if ($this->article === null) return '';

        Gm::$app->doEvent('article:onRender', [$this->article]);

        // атрибуты статьи в шаблоне
        $params = $this->article->getAttributes();
        // если текст материала имеет шорткоды
        if ($this->article->hasShortcode()) {
            $params['text'] = Gm::$app->shortcodes->process($params['text']);
        }

        $params['article']           = $this->article;
        $params['showHeader']        = $this->showHeader;
        $params['showImage']         = $this->showImage;
        $params['showTextBefore']    = $this->showTextBefore;
        $params['showTextAfter']     = $this->showTextAfter;
        $params['showPublishedDate'] = $this->showPublishedDate;
        $params['textAfter']         = $this->article->textAfter;
        $params['textBefore']        = $this->article->textBefore;
        $params['fields']            = $this->article->fields;
        $params['field']             = function (string $name, $default = null) {
            return $this->article->getField($name, $default);
        };
        return $this->render($this->article->template, $params);
    }
}