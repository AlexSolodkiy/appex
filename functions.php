<?php

add_action( 'wp_enqueue_scripts', 'add_scripts' );

function add_scripts() {
    wp_enqueue_style( 'theme-style', get_stylesheet_uri() );
    wp_enqueue_style( 'main-style', get_template_directory_uri() . '/styles/style.css' );
    wp_enqueue_script( 
        'main-js', 
        get_template_directory_uri() . '/js/index.js', 
        time(),  
        true   
    );
}

add_action( 'after_setup_theme', 'menu_setup' );

function menu_setup() {
 
    register_nav_menus( array(
        'header_menu' => 'Меню в шапке',
    ) );
}


use Carbon_Fields\Container;
use Carbon_Fields\Field;

require_once __DIR__ . '/vendor/autoload.php';


add_action( 'after_setup_theme', function () {
    \Carbon_Fields\Carbon_Fields::boot();
});



add_action( 'carbon_fields_register_fields', 'crb_attach_home_page_options' );
function crb_attach_home_page_options() {
    Container::make( 'post_meta', 'Контент страницы' )
        ->where( 'post_type', '=', 'page' )
        ->where( 'post_id', '=', get_option( 'page_on_front' ) ) 
        ->add_fields( array(
           
            Field::make( 'separator', 'crb_hero_sep', 'Hero Секция' ),
            Field::make( 'file', 'crb_hero_video', 'Фоновое видео' )->set_type( 'video' ),
           
            Field::make( 'separator', 'crb_adv_sep', 'Преимущества' ),
            Field::make( 'text', 'crb_advantages_title', 'Заголовок' ),
            Field::make( 'complex', 'crb_advantages', 'Карточки преимуществ' )
                ->add_fields( array(
                    Field::make( 'image', 'icon', 'Иконка (SVG)' )->set_value_type( 'url' ),
                    Field::make( 'text', 'title', 'Заголовок' ),
                    Field::make( 'textarea', 'desc', 'Описание' )->set_rows( 2 ),
                    Field::make( 'text', 'link', 'Ссылка' ),
                ) )->set_layout( 'tabbed-horizontal' )
        ) );
}