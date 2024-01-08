<?php
/*
 * weDocs Search Elementor Template
 * @package WPKit For Elementor
 */

$dropdown = $wke_data->dropdown;
$button_text = $wke_data->button_text;
$search_field_placeholder = $wke_data->search_field_placeholder;

$dropdown_args = [
    'post_type'         => 'docs',
    'echo'              => 0,
    'depth'             => 1,
    'show_option_none'  => esc_html__( 'All Docs', 'wpkit-elementor' ),
    'option_none_value' => 'all',
    'name'              => 'search_in_doc',
];

if ( $dropdown && isset( $_GET['search_in_doc'] ) && 'all' != $_GET['search_in_doc'] ) {
    $dropdown_args['selected'] = (int) $_GET['search_in_doc'];
}

$renderHTML = '<div class="wke-wedocs-search">
    <form role="search" method="get" action="' . esc_url( home_url( '/' ) ) . '">
        <div class="wedocs-search-input">
            <span class="screen-reader-text">' . esc_attr_x( 'Search for:', 'label', 'wpkit-elementor' ) . '</span>
            <input type="search" class="search-field" placeholder="' . esc_attr( $search_field_placeholder ) . '" value="' . get_search_query() . '" name="s" title="' . esc_attr_x( 'Search for:', 'label', 'wpkit-elementor' ) . '" />
            <input type="hidden" name="post_type" value="docs" />
        </div>';
        
        if( $dropdown ) {
            $renderHTML .= '<div class="wedocs-search-in">
                    ' . wp_dropdown_pages( $dropdown_args ) . '
                    </div>';
        }
        
$renderHTML .= '<div>
            <input type="submit" class="search-submit" value="' . esc_attr( $button_text ) . '" />
        </div>
    </form>
</div>';

echo $renderHTML;