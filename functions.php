<?php

add_action('after_setup_theme', function () {
    add_theme_support('editor-styles');
    add_editor_style('build/theme.min.css');

    remove_theme_support('core-block-patterns');

    // add_theme_support('title-tag');
    // add_theme_support('post-thumbnails');
    // add_image_size('pageBanner', 1536, 450, true);

});


add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('johncarter_custom_styles', get_theme_file_uri('/build/theme.min.css'));
});

add_filter('body_class', function ($classes) {
    return array_merge($classes, ['font-sans']);
});

class JSXBlock
{
    function __construct($name, $renderCallback = null, $data = null)
    {
        $this->name = $name;
        $this->data = $data;
        $this->renderCallback = $renderCallback;
        add_action('init', [$this, 'onInit']);
    }

    function renderCallback($attributes, $content)
    {
        ob_start();
        require get_theme_file_path("/blocks/{$this->name}.php");
        return ob_get_clean();
    }

    function onInit()
    {
        wp_register_script($this->name, get_stylesheet_directory_uri() . "/build/{$this->name}.js", array('wp-blocks', 'wp-editor'));

        if ($this->data) {
            wp_localize_script($this->name, $this->name, $this->data);
        }

        $args = array(
            'editor_script' => $this->name
        );

        if ($this->renderCallback) {
            $args['render_callback'] = [$this, 'renderCallback'];
        }

        register_block_type("johncartercustom/{$this->name}", $args);
    }
}

class PlaceholderBlock
{
    function __construct($name)
    {
        $this->name = $name;
        add_action('init', [$this, 'onInit']);
    }

    function renderCallback()
    {
        ob_start();
        require get_theme_file_path("/blocks/{$this->name}.php");
        return ob_get_clean();
    }

    function onInit()
    {
        wp_register_script($this->name, get_stylesheet_directory_uri() . "/blocks/{$this->name}.js", array('wp-blocks', 'wp-editor'));

        register_block_type("johncartercustom/{$this->name}", array(
            'editor_script' => $this->name,
            'render_callback' => [$this, 'renderCallback']
        ));
    }
}

new PlaceholderBlock("header");
new PlaceholderBlock("footer");
