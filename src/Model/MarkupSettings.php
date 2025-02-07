<?php
/**
 * Виджет веб-приложения GearMagic.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

namespace Gm\Widget\Article\Model;

use Gm;
use Gm\Panel\Data\Model\WidgetMarkupSettingsModel;

/**
 * Настройка разметки виджета.
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Gm\Widget\Article\Model
 * @since 1.0
 */
class MarkupSettings extends WidgetMarkupSettingsModel
{
    /**
     * {@inheritdoc}
     */
    public function maskedAttributes(): array
    {
        return [
            'showHeader'        => 'showHeader', // показать заголовок
            'showImage'         => 'showImage', // показать изображение анонса в статье
            'showTextBefore'    => 'showTextBefore', // показать содержимое (компонентов) перед текстом статьи
            'showTextAfter'     => 'showTextAfter', // показать содержимое (компонентов) после текста статьи
            'showPublishedDate' => 'showPublishedDate', // показать дату публикации
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function formatterRules(): array
    {
        return [
            [
                ['showHeader', 'showImage', 'showTextBefore', 'showTextAfter', 'showPublishedDate'], 
                'logic' => [true, false]
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function beforeUpdate(array &$params): void
    {
        // т.к. по умолчанию у виджета свойства имееют значения `true`, 
        // то нет смысла указывать их в параметрах
        if ($params['showHeader'] === true) {
            unset($params['showHeader']);
        }
        if ($params['showImage'] === true) {
            unset($params['showImage']);
        }
        if ($params['showTextBefore'] === true) {
            unset($params['showTextBefore']);
        }
        if ($params['showTextAfter'] === true) {
            unset($params['showTextAfter']);
        }
        if ($params['showPublishedDate'] === true) {
            unset($params['showPublishedDate']);
        }
    }
}