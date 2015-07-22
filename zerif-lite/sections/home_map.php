<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 22/07/2015
 * Time: 10:17
 */
?>

<section class="focus" id="focus">
<div class="container">
	<!-- SECTION HEADER -->
	<div class="section-header">
		<!-- SECTION TITLE -->
		<?php
		$zerif_ourfocus_title = get_theme_mod('zerif_ourfocus_title',__('FEATURES','zerif-lite'));

		if( !empty($zerif_ourfocus_title) ):
            echo '<h2 class="dark-text">'.__($zerif_ourfocus_title,'zerif-lite').'</h2>';
        endif;
		?>
<?php

$zerif_ourfocus_subtitle = get_theme_mod('zerif_ourfocus_subtitle',__('What makes this single-page WordPress theme unique.','zerif-lite'));

if( !empty($zerif_ourfocus_subtitle) ):
    echo '<h6>'.__($zerif_ourfocus_subtitle,'zerif-lite').'</h6>';
endif;

?>
</div>
<div class="row">
    <?php

    if ( is_active_sidebar( 'sidebar-ourfocus' ) ) :
        dynamic_sidebar( 'sidebar-ourfocus' );
    else:
        //Get all immeubles
        wp_reset_postdata();
        $immeubles = new WP_Query('post_type=immeuble');
        ?>
        <div id="home_building_map" style="width: 100%;height: 600px;"></div>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDa-xgf-9n3amo3Mvw0RHf7UfwljKqAn4M"></script>
        <script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerwithlabel/src/markerwithlabel.js"></script>
        <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() ?>/js/home_building_map.js"></script>
        <script>
            MStudioMaps.init('home_building_map', 46.9751523,-1.3110344);
            MStudioMaps.addMarker(46.9797758,-1.3121039, "ISLT");
            MStudioMaps.addMarker(46.9797758,-1.3121039, "Lycée Jeanne d'arc");
            MStudioMaps.addMarker(46.9712835,-1.3000014, "Lycée Léonard de Vinci");
            MStudioMaps.addMarker(46.9801252,-1.3087837, "sup SANTÉ ANIMALE groupETABLIERES");
            MStudioMaps.addMarker(46.9791938,-1.3153203, "SNCF Gare Sécurité");

        <?php
            while ( $immeubles->have_posts() ) {
                $immeubles->the_post();
                $post_id = $immeubles->post->ID;
                $freeAppartments = 0;
                $appartments =  get_post_meta($post_id, "appartements", false)[0];
                //Calculate free appartments for each building.
                foreach ($appartments as $appartmentId){
                    $id = (int)$appartmentId;
                    $occuped = get_post_meta($id, "loue", true)[0];
                    if ($occuped != "1")
                        $freeAppartments++;
                }

                $adress = get_post_meta($post_id, "adresse", false);
                $lat = $adress[0]["lat"];
                $lng = $adress[0]["lng"];
                $intitule = ((int)$freeAppartments > 1) ? " restants" : " restant";
                $freeAppartments = $freeAppartments . $intitule;

                echo 'MStudioMaps.addMarkerWithLabel('.$lat.', '.$lng.', "'.get_the_title().'", "'.get_permalink().'", \''.get_the_post_thumbnail().'\', "'. $freeAppartments .'");';
            };?>
        </script>
    <?php endif;
        wp_reset_postdata();
        ?>
</div>
</div> <!-- / END CONTAINER -->
</section>  <!-- / END HOME MAP SECTION -->