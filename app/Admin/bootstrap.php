<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

use Encore\Admin\Form;
use App\Admin\Form\Field\Select;
use App\Admin\Form\Field\DisplayImage;
use App\Admin\Form\Field\DisplayValue;

Encore\Admin\Form::forget(['map', 'editor']);
Form::extend('select', Select::class);
Form::extend('displayimage', DisplayImage::class);
Form::extend('displayvalue', DisplayValue::class);
