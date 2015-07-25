<?php
/**
 *
 */

get_header(); ?>
<div class="clear"></div>
<link rel="stylesheet" id="animate" href="<?php echo get_stylesheet_directory_uri() ?>/css/animate.css" type="text/css" media="all">
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.3/angular.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/js/ng-appartments-search.js"></script>
</header> <!-- / END HOME SECTION  -->
<div id="content" class="site-content">
<?php while ( have_posts() ) : the_post();
		if (has_post_thumbnail( $post->ID ) ){
		    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
		}
		?>
             <div class="building-cover" style="background-image: url('<?php echo $image[0]; ?>');">
                <div class="container">
                    <h1 class="intro-text"><?php the_title()?></h1>
                </div>
            </div>
<div class="container">
<div class="content-left-wrap col-md-12">
	<div id="primary" class="content-area">
		<main id="main" class="site-main single-building" role="main">

            <div class="appartments-search" ng-app="appartmentsApp" ng-controller="AppartmentSearchCtrl as vm">
            <h3>Les appartements de l'immeuble <b><?php the_title()?></b> : </h3>
                <span>Filtrer par : </span>
                <div class="btn-group" role="group" aria-label="...">
                  <button type="button" class="btn btn-default btn-success" ng-click="vm.filter = 'disponible'">Disponibles</button>
                  <button type="button" class="btn btn-default btn-info" ng-click="vm.filter = 'lou'">Loués</button>
                  <button type="button" class="btn btn-default" ng-click="vm.filter = 'tous'">Tous</button>
                </div>
                <span>Trier par :</span>
                <div class="result" location-status-filter filter="{{vm.filter}}">
                    <?php
                        $appartments = get_post_meta($post->ID, "appartements", false)[0];
                        foreach ($appartments as $appartmentId){
                            $id = (int)$appartmentId;
                            $appartment = get_post($id);
                            $occuped = get_post_meta($id, "loue", true)[0];
                            $appartmentImg = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'single-post-thumbnail' )[0];
                            if ($appartmentImg == "")
                                $appartmentImg = get_template_directory_uri() . "/images/no-image.png";
                            if ($occuped == 1)
                                $dispoText = "loué jusqu'au 01/01/2016";
                             else
                                $dispoText = "disponible";

                            $attachments = get_children(array('post_parent'=>$id));
                            $nbImg = count($attachments);
                            ?>
                            <div class="appartment-thumb col-md-3 animated" ng-class="{'rollIn' : true}">
                            <a href="<?php get_permalink() ?>">
                                <div class="appartment-cover" style="background-image: url('<?php echo $appartmentImg ?>')">
                                    <span class="label <?php echo ($occuped == 1) ? "label-info" : "label-success" ?> free-building-badge"><?php echo $dispoText ?></span>
                                </div>
                            <div class="appartment-infos">
				                <div class="row first-row">
                                   <div class="col-xs-4">
							                <i class="fa fa-camera"></i> <?php echo $nbImg ?>
					                </div>
				                </div>
                                <div class="row second-row">
                                    <div class="col-xs-6">
                                        <p class="offer-type"><?php echo $appartment->post_title?></p>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <p class="offer-price">159 000 €</p>
                                    </div>
                                </div>
                                <div class="row third-row">
                                    <div class="col-xs-12">
                                        <p class="offer-locality">
                                            NANTES (44300)                        </p>
                                    </div>
                                </div>
                                <div class="row forth-row">
                                    <div class="col-xs-12">
                                        <p class="offer-features">
                                        <span class="offer-area-number">41</span> m² environ
                                        <span class="offer-rooms-number">2</span> pièces</p>
                                    </div>
                                </div>
                                </div>
                                </a>
                            </div>
                        <?php }
                    ?>
                </div>
            </div>
				 <?php
			endwhile; // end of the loop. ?>
		</main><!-- #main -->
	</div><!-- #primary -->
</div>

</div>
<?php get_footer(); ?>