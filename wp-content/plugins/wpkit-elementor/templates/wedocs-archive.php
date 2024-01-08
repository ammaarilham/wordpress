<?php
/*
 * weDocs Archive Elementor Template
 * @package WPKit For Elementor
 */

$defaults = [
    'col'     => $wke_data->columns,
    'include' => 'any',
    'exclude' => '',
    'items'   => $wke_data->number,
    'more'    => esc_html( $wke_data->more_text ),
];

$args = [];
$args = wp_parse_args( $args, $defaults );
$docs = [];

$parent_args = [
    'post_type'   => 'docs',
    'parent'      => 0,
    'sort_column' => 'menu_order',
];

if ( 'any' != $args['include'] ) {
    $parent_args['include'] = $args['include'];
}

if ( !empty( $args['exclude'] ) ) {
    $parent_args['exclude'] = $args['exclude'];
}

$parent_docs = get_pages( $parent_args );

// arrange the docs
if ( $parent_docs ) {
    foreach ( $parent_docs as $root ) {
        $sections = get_children( [
            'post_parent'    => $root->ID,
            'post_type'      => 'docs',
            'post_status'    => 'publish',
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
            'numberposts'    => (int) $args['items'],
        ] );

        $docs[] = [
            'doc'      => $root,
            'sections' => $sections,
        ];
    }
}

if ( $docs ):
?>

<div class="wedocs-archive-wrap">
    <ul class="wedocs-docs-list col-<?php echo (int) $args['col']; ?>">

        <?php foreach ( $docs as $main_doc ) { ?>
            <li class="wedocs-docs-single">
                <h3><?php echo $main_doc['doc']->post_title; ?></h3>

                <?php if ( $main_doc['sections'] ) { ?>

                    <div class="inside">
                        <ul class="wedocs-doc-sections">
                            <?php foreach ( $main_doc['sections'] as $section ) { ?>
                                <li><a href="<?php echo get_permalink( $section->ID ); ?>"><?php echo $section->post_title; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>

                <?php } ?>

                <div class="wedocs-doc-link">
                    <a href="<?php echo get_permalink( $main_doc['doc']->ID ); ?>"><?php echo $args['more']; ?></a>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>

<?php endif;