<?php
/*
Plugin Name: Liftor
Plugin URI: https://www.facebook.com/groups/lifterlmsvip
Description: Enable the theme builder of Elementor for lesson post type in LifterLMS + adding shortcodes for lesson nav, back to course elements & video embed.
Author: Saeed Masri
Version: 1.0.0
Author URI: https://profiles.wordpress.org/sallory85/
License: GPL2
*/

add_filter( 'lifterlms_register_post_type_lesson', 'liftor_allow_course_and_lesson_search' );

add_filter( 'lifterlms_register_post_type_course', 'liftor_allow_course_and_lesson_search' );

function liftor_allow_course_and_lesson_search( $args ) {
    $args[ 'exclude_from_search' ] = false;
    return $args;  
}

function liftor_add_lessons_to_elementor( $post_types ) {
    $obj = get_post_type_object( 'lesson' );
    $post_types[ 'lesson' ] = $obj->label;
    return $post_types;
}

add_filter( 'elementor_pro/utils/get_public_post_types', 'liftor_add_lessons_to_elementor' );

function liftor_nav_shortcode( $atts, $content ) {
    ob_start();
    lifterlms_template_lesson_navigation();
    return ob_get_clean();
}
add_shortcode( 'liftor_nav', 'liftor_nav_shortcode' );

function liftor_back_shortcode( $atts, $content ) {
    ob_start();
    lifterlms_template_single_parent_course();
    return ob_get_clean();
}
add_shortcode( 'liftor_back', 'liftor_back_shortcode' );

function liftor_video_shortcode( $atts, $content ) {
    ob_start();
    lifterlms_template_single_lesson_video();
    return ob_get_clean();
}
add_shortcode( 'liftor_video', 'liftor_video_shortcode' );