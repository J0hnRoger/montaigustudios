<?php
/**
    Register Appartement Post Type
**/
function appartement_post_type() {

	$labels = array(
		'name'                => _x( 'Appartement', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Appartement', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Appartements', 'text_domain' ),
		'name_admin_bar'      => __( 'Post Type', 'text_domain' ),
		'parent_item_colon'   => __( 'Appartement parent :', 'text_domain' ),
		'all_items'           => __( 'Tous les appartement', 'text_domain' ),
		'add_new_item'        => __( 'Ajouter un nouvel appartement', 'text_domain' ),
		'add_new'             => __( 'Nouvel Appartement', 'text_domain' ),
		'new_item'            => __( 'Nouvel Appartement', 'text_domain' ),
		'edit_item'           => __( 'Editer l\'appartement', 'text_domain' ),
		'update_item'         => __( 'Mettre à jour l\'appartement', 'text_domain' ),
		'view_item'           => __( 'Détails de l\'appartement', 'text_domain' ),
		'search_items'        => __( 'Rechercher un appartement', 'text_domain' ),
		'not_found'           => __( 'Aucun appartement trouvé', 'text_domain' ),
		'not_found_in_trash'  => __( 'Aucun appartement trouvé dans la corbeille', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'appartement', 'text_domain' ),
		'description'         => __( 'Page de description d\'un appartement', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'custom-fields', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 10,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'appartement', $args );
}

// Hook into the 'init' action
add_action( 'init', 'appartement_post_type', 0 );
?>