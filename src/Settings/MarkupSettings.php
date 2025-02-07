<?php
/**
 * Виджет веб-приложения GearMagic.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

namespace Gm\Widget\Article\Settings;

use Gm;
use Gm\Panel\Widget\MarkupSettingsWindow;

/**
 * Интерфейс окна настроек разметки виджета.
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Gm\Widget\Article\Settings
 * @since 1.0
 */
class MarkupSettings extends MarkupSettingsWindow
{
    /**
     * {@inheritdoc}
     */
    protected function init(): void
    {
        parent::init();

        /** @var \Gm\Http\Request $request */
        $request = Gm::$app->request;

        $this->width = 720;
        $this->form->autoScroll = true;
        $this->form->defaults = [
            'labelWidth' => 360,
            'labelAlign' => 'right',
            'anchor'     => '100%'
        ];
        $this->form->items = [
            [
                'xtype'      => 'hidden',
                'name'       => 'id',
                'value'      => $request->post('id')
            ],
            [
                'xtype'      => 'textfield',
                'fieldLabel' => '#Template markup',
                'tooltip'    => '#In the specified template, the widget parameters are changed. You can make changes manually by opening the template for editing.',
                'name'       => 'calledFrom',
                'value'      => $request->post('calledFrom'),
                'maxLength'  => 50,
                'width'      => '100%',
                'readOnly'   => true,
                'allowBlank' => true
            ],
            [
                'xtype'      => 'checkbox',
                'ui'         => 'switch',
                'fieldLabel' => '#Show header',
                'name'       => 'showHeader',
                'value'      => $request->post('showHeader', false),
            ],
            [
                'xtype'      => 'checkbox',
                'ui'         => 'switch',
                'fieldLabel' => '#Show announcement image',
                'name'       => 'showImage',
                'value'      => $request->post('showImage', false),
            ],
            [
                'xtype'      => 'checkbox',
                'ui'         => 'switch',
                'fieldLabel' => '#Show content (components) before article text',
                'name'       => 'showTextBefore',
                'value'      => $request->post('showTextBefore', false),
            ],
            [
                'xtype'      => 'checkbox',
                'ui'         => 'switch',
                'fieldLabel' => '#Show content (components) after the article text',
                'name'       => 'showTextAfter',
                'value'      => $request->post('showTextAfter', false),
            ],
            [
                'xtype'      => 'checkbox',
                'ui'         => 'switch',
                'fieldLabel' => '#Show publication date',
                'name'       => 'showPublishedDate',
                'value'      => $request->post('showPublishedDate', false),
            ],
        ];
    }
}