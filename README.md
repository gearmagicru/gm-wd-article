# Виджет "Статья" веб-приложения GearMagic

Виджет предназначен для вывода статьи из базы данных.

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
