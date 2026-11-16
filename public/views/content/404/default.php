<?php
/**
 * ecclesiastical ( content-404.php )
 *
 * @package   ecclesiastical
 * @copyright Copyright (C) 2019-2021. Benjamin Lu
 * @license   GNU General Public License v2 or later ( https://www.gnu.org/licenses/gpl-2.0.html )
 * @author    Benjamin Lu ( https://getbenonit.com )
 */
?>
<?php $ecclesiastical_error = new Ecclesiastical\Template\ErrorPage(); ?>
<?php $ecclesiastical_error->setup(); ?>
<article id="post-0" <?php post_class( 'post' ); ?>>
	<header class="entry__header">
		<h1 class="entry__title"><?php $ecclesiastical_error->displayTitle(); ?></h1>
	</header>
	<div class="entry__content">
		<?php $ecclesiastical_error->displayContent(); ?>
	</div>
</article>
<?php $ecclesiastical_error->reset(); ?>
