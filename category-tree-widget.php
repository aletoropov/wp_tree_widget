<?php

/**
 * Plugin Name: Виджет "Дерево Категорий"
 * Plugin URI: https://ale-studio.ru/
 * Description: Добавляет виджет категорий в виде дерева
 * Version: 1.0.1
 * Author: Александр Торопов
*/

require __DIR__ . '/Category_Tree_Widget.php';

/**
 * Регистрируем виджет дерево категорий
 */
add_action( 'widgets_init', function() {
        register_widget( 'Category_Tree_Widget' );
    } 
);

/*
 * Подключаем js-файл, который будет изначально скрывать все дочерние
 * категории и показывать их по клику на родительской категории
 */
add_action(
    'wp_enqueue_scripts',
    function () {
        wp_enqueue_script(
            'category-tree-widget-script', // будет зарегистрирован под этим именем
            plugin_dir_url(__FILE__) . 'category-tree-widget.js',
            [ // должен быть подключен после jquery
                'jquery',
            ],
            null, // версии нет, поэтому null
            true // подключаем перед закрывающим тегом body
        );
    }
);

/**
 * Подключение CSS файла стилей виджена
 */
add_action( 'wp_enqueue_scripts', function() {
        wp_enqueue_style( 'category-tree-widget-style', plugin_dir_url(__FILE__) . 'style.css', '1.0.0' );
    }
);