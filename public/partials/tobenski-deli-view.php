<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://github.com/tobenski/
 * @since      1.0.0
 *
 * @package    Tobenski_Deli
 * @subpackage Tobenski_Deli/public/partials
 */
?>


<section class="flex flex-wrap w-full max-w-full pt-12 pb-6 md:max-w-screen-sm lg:max-w-screen-md xl:max-w-screen-lg 2xl:max-w-screen-xl">
        <!-- MENU CARD-->
        <div class="card card-full">
            <div class="card-image">            
                <img src="<?php the_field('tobenski_deli_image', 'option') ?>">
            </div>                
            <div class="card-content">
                <div class="card-header">
                    <h4 class="text-center"><?php the_field('tobenski_deli_description_header', 'option'); ?></h4>
                </div>
                <p><?php the_field('tobenski_deli_description', 'option'); ?></p>
            </div>            
        </div>
    </section>

    <section class="flex flex-wrap w-full max-w-full pt-6 pb-16 md:max-w-screen-sm lg:max-w-screen-md xl:max-w-screen-lg 2xl:max-w-screen-xl">
      <?php 
      $args = array(
          'post_type' => 'deli',
          'posts_per_page' => 1,
        );
        $query = new WP_Query($args);
                
        if ($query->have_posts()){
          while($query->have_posts()) {
            $query->the_post();
      ?>
        <!-- MENU CARD-->
        <div class="card card-full">
            <div class="card-image">
                <img src="<?php the_post_thumbnail_url(); ?>" >
            </div>
            <div class="card-content">
                <div class="card-header">
                    <h4><?php the_title(); ?></h4>
                </div>
                <p>
                    <?php the_field('deli_menu'); ?>
                </p>  
            </div>            
        </div>
               
      <?php } wp_reset_postdata(  );
        }else {
          ?>
            <p class="flex flex-col">
              <span>Ingen Deli menu Oprettet</span>
              <a href="/wp-admin/edit.php?post_type=deli" class="btn btn-primary mt-8" target="_blank">Opret en</a>
            </p>
          <?php
        }
      ?>
    </section>
