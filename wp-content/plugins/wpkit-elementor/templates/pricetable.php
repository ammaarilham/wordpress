<?php
/*
 * Price Table Shortcode Template
 * @package WPKit For Elementor
 */

$table_name     			 =   $wke_data->name;
$price          			 =   $wke_data->price;
$button_text           =   $wke_data->button_text;
$button_link           =   $wke_data->button_link;
$content         			 =   $wke_data->content;
$featured				       =   $wke_data->featured;
$extra_class    			 =   $wke_data->extra_class;
$hover_animation       =   $wke_data->button_hover_animation;

$allow_HTML_tags = array(
    //formatting
    'strong' => array(),
    'em'     => array(),
    'b'      => array(),
    'i'      => array(),
    'ul'	 => array(),
    'li'	 => array(),
    'ol'	 => array(),
    'span'	 => array(),
    'blockquote' => array(),

    //links
    'a'     => array(
        'href' => array()
    )
);


$renderHTML='<div class="wke-price-table ' . esc_attr( $featured ) . ' ' . esc_attr( $extra_class ) . '">
   <header>  
     <h3>' . esc_html( $table_name ) . '</h3>';
     if( $price !== '' ) {  
        $renderHTML .= '<div class="price">' . esc_html( $price ) . '</div>';
     }
   $renderHTML .= '</header>
   <div class="price_content">' . do_shortcode( wp_kses( $content,$allow_HTML_tags ) ) . '</div>';
   
   if( $button_link['url'] !== '' ) {
   
     $target = $button_link['is_external'] ? 'target="_blank"' : '';
     
     $renderHTML.='<footer>
           <a href="' . esc_url($button_link['url']) . '" ' . $target . ' class="wke-price-table-button '. esc_attr( $hover_animation ) .'">' . esc_html( $button_text ) . '</a>
        </footer>';
   }
   
   $renderHTML.='</div>';

echo $renderHTML;