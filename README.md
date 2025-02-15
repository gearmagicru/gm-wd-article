# <img src="https://raw.githubusercontent.com/gearmagicru/gm-wd-article/refs/heads/master/assets/images/icon.svg" width="64px" height="64px" align="absmiddle"> Виджет "Материал"

[![Latest Stable Version](https://img.shields.io/packagist/v/gearmagicru/gm-wd-article.svg)](https://packagist.org/packages/gearmagicru/gm-wd-article)
[![Total Downloads](https://img.shields.io/packagist/dt/gearmagicru/gm-wd-article.svg)](https://packagist.org/packages/gearmagicru/gm-wd-article)
[![Author](https://img.shields.io/badge/author-anton.tivonenko@gmail.com-blue.svg)](mailto:anton.tivonenko@gmail)
[![Source Code](https://img.shields.io/badge/source-gearmagicru/gm--wd--article-blue.svg)](https://github.com/gearmagicru/gm-wd-article)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](https://github.com/gearmagicru/gm-wd-article/blob/master/LICENSE)
![Component type: widget](https://img.shields.io/badge/component%20type-widget-green.svg)
![Component ID: gm-wd-article](https://img.shields.io/badge/component%20id-gm.wd.article-green.svg)
![php 8.2+](https://img.shields.io/badge/php-min%208.2-red.svg)

Виджет предназначен для вывода материала (статьи) из базы данных.

## Пример применения
### с менеджером виджетов:
```
$articles = Gm::$app->widgets->get(
    'gm.wd.article', 
    [
        'showHeader' => false, 
        'viewFile' => '/articles/default.phtml'
    ]
);
$articles->run();
```
### в шаблоне:
```
echo $this->widget(
    'gm.wd.article', [
    [
        'showHeader' => false, 
        'viewFile' => '/articles/default.phtml'
    ]
]);
```
### с namespace:
```
use Gm\Widget\Article\Widget as Article;
echo Article::widget(
    'gm.wd.article', [
    [
        'showHeader' => false, 
        'viewFile' => '/articles/default.phtml'
    ]
);
```
если namespace ранее не добавлен в PSR, необходимо выполнить:
```
Gm::$loader->addPsr4('Gm\Widget\Article\\', Gm::$app->modulePath . '/gm/gm.wd.article/src');
```

## Установка

Для добавления виджета в ваш проект, вы можете просто выполнить команду ниже:

```
$ composer require gearmagicru/gm-wd-article
```

или добавить в файл composer.json вашего проекта:
```
"require": {
    "gearmagicru/gm-wd-article": "*"
}
```

После добавления виджета в проект, воспользуйтесь Панелью управления GM Panel для установки его в редакцию вашего веб-приложения.
