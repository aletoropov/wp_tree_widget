<?php 

/**
 * Widget меню категорий
 * 
 * @package WordPress 
 * @author Toropov Alexandr <toropovsite@yandex.ru> 
 */

class Category_Tree_Widget extends WP_Widget {

    /**
     * Создание виджета
     */
    public function __construct()
    {
        parent::__construct(
            'category_tree_widget',
            'Дерево категорий',
            ['description' => 'Сворачиваемое меню категорий']
        );

    }

    /**
     * Метод выводит каегории блога в общедоступной части сайта
     *
     * @param [type] $args
     * @param [type] $instance
     * @return void
     */
    public function widget($args, $instance)
    {
        // к заголовку применяем фильтр
        $title = apply_filters( 'widget_title', $instance['title'] );

        echo $args['before_widget'];

        // выводим заголовок виджета
        if ( ! empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        // выводим дерево категорий
        echo '<ul id="category-tree-widget">', PHP_EOL;
        wp_list_categories( 
            apply_filters(
                'widget_categories_args',
                ['title_li' => ''],
                $instance
            )
        ); 
        echo '</ul>', PHP_EOL;

        echo $args['after_widget'];

    }

    /**
     * Форма настроек виджета в панеле управления
     *
     * @param array $instance
     * @return void
     */
    public function form($instance)
    {
        $title = '';
        if ( isset( $instance['title'] ) ) {
            $title = $instance['title'];
        }

        // заголовок виджета
        $id = $this->get_field_id( 'title' );
        $name = $this->get_field_id ( 'name' );
        $value = esc_attr( $title );
        ?>
        <p>
            <label for="<?= $id; ?>"><?php _e( 'Заголовок:' ); ?></label>
            <input type="text" class="widefat" id="<?= $id; ?>" name="<?= $name; ?>" value="<?= $value; ?>" />
        </p>
        <?php
    }

    /**
     * Сохранение настроек виджета в панели управления
     *
     * @param string $new_instance
     * @param string $old_instance
     * @return array
     */
    public function update($new_instance, $old_instance)
    {
        $instance['title'] = ! empty($new_instance['title']) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }

}