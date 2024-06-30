jQuery(document).ready(function($) {
    jQuery('#category-tree-widget ul').hide();
    jQuery('#category-tree-widget li a').on('click', function(event) {
        /*
         * Если у этого элемента дерева есть дочерние узлы и они в данный момент
         * свернуты, то по ссылке переходить не надо, а надо их просто показать.
         */
        let closed = jQuery(this).next().is('ul') && !jQuery(this).next().is(':visible')
        if (closed) {
            event.preventDefault();
            jQuery(this).next().slideDown('normal');
        }
    });
});