<?php
/**
 * Default header template
 *
 * @package   Ecclesiastical
 * @author    Benjamin Lu ( benlumia007@gmail.com )
 * @copyright Copyright (C) 2016-2021. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/ecclesiastical
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="profile" href="https://gmpg.org/xfn/11" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="container" class="site-container">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'ecclesiastical' ) ?></a>
	<header id="masthead" class="site-header">
		<div class="site-header__container">
			<div class="site-header__branding">
				<?php Backdrop\Site\display_title( [ 'class' => 'site-header__title' ] ); ?>
				<?php Backdrop\Site\display_description( [ 'class' => 'site-header__description' ] ); ?>
			</div>
			<?php Ecclesiastical\display_menu( 'primary' ); ?>
		</div>
	</header>
	<?php the_custom_header_markup(); ?>