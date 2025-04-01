<?php
/**
 * The template for displaying all single posts.
 * Also used in the Customizer preview
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage ExS
 * @since 0.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( have_posts() ) :

	/* Start the Loop */
	while ( have_posts() ) :
		the_post();
		$exs_special_category_slug = exs_get_post_special_category_slug();
		$exs_post_type             = get_post_type();

		if ( ! empty( $exs_special_category_slug ) ) :
			?>
			<div id="layout" class="layout-<?php echo esc_attr( $exs_special_category_slug ); ?>">
				<?php
				get_template_part( 'template-parts/post/special/content-single', $exs_special_category_slug );
				?>
			</div><!-- #layout -->
		<?php

		elseif ( 'elementor_library' === $exs_post_type ) :
			the_content();
		//since 2.3.0 - new Customizer option for Custom Post Types - use blank HTML markup
		elseif ( 'post' !== $exs_post_type && exs_option( 'cpt_' . $exs_post_type . '_layout_single' ) ) :
			get_template_part( 'template-parts/cpt/' . exs_option( 'cpt_' . $exs_post_type . '_layout_single' ) );
		//if post not in special categories - load default layout
		else :
			$exs_layout = exs_get_post_layout();
			?>
			<div id="layout" class="layout-<?php echo esc_attr( $exs_layout ); ?>">
				<?php
				get_template_part( 'template-parts/post/content-single', $exs_layout );
				?>
			</div><!-- #layout -->
		<?php

		endif; //no special_post

	endwhile; // End of the loop.

else :

	// If no content, include the "No posts found" template.
	get_template_part( 'template-parts/content', 'none' );

endif; //have_posts
