<?php
/**
 * Default footer template
 *
 * @package   Ecclesiastical
 * @author    Benjamin Lu ( benlumia007@gmail.com )
 * @copyright Copyright (C) 2016-2021. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/ecclesiastical
 */
?>
	<footer id="colophon" class="site-footer">
		<?php Ecclesiastical\display_menu( 'secondary' ); ?>
		<div class="site-info">
			<?php Ecclesiastical\Template\Footer::displayCredit(); ?>
		</div>
		<?php Ecclesiastical\display_menu( 'social' ); ?>
	</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>