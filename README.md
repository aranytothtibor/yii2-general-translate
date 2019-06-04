# Yii2 general multilanguage component

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]

**This is an experimental project far from done**

General multilanguage managemenet for Yii 2

## Introduction

This modul tries to give a general multilanguage solution for existing projects.

## Installation

Via [Composer](http://getcomposer.org/download/)

```
composer require aranytoth/yii2-general-translate
```
Or manually add to composer.json

```
"aranytoth/yii2-general-translate": "dev-master"
```

## Migration

Run the following command in Terminal for database migration:

```
yii migrate --migrationPath=@aranytoth/Yii2GeneralTranslate/migrations
```

## Configuration

YiiGeneralTranslate registers it's own module to http://your-site/translate. If you want to register manually, set 'createLangModule' => false in your params.php.
Default translate module can't be reach in advanced template's frontend.

## Usage

Current languages can be create/edit at translate/language. You can enable/disable/edit existing languages or create new.

If you like to enable multilanguage on your model:

1. change your model class extend from \yii\db\ActiveRecord to \aranytoth\Yii2GeneralTranslate\models\LangModel
2. Place aranytoth\Yii2GeneralTranslate\components\LangWidget::widget(['model' => $model]) widget to create / update form. This enables a buttons with active languages







