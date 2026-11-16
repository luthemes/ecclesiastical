<?php
/**
 * Checks the customizer settings and the settings page against a real site.
 *
 * Usage: php tests/admin-check.php /path/to/site
 *
 * @package Ecclesiastical
 */

$site = $argv[1] ?? '';

if ( ! $site || ! file_exists( "{$site}/wp-load.php" ) ) {
	fwrite( STDERR, "Usage: php tests/admin-check.php /path/to/site\n" );
	exit( 1 );
}

define('WP_ADMIN', true); $_SERVER['HTTP_HOST']='localhost'; $_SERVER['REQUEST_URI']='/wp-admin/themes.php';
require "{$site}/wp-load.php";
require_once ABSPATH.'wp-admin/includes/admin.php';
wp_set_current_user(1);
$GLOBALS['pagenow']='themes.php';
// Customizer
require_once ABSPATH.WPINC.'/class-wp-customize-manager.php';
$m = new WP_Customize_Manager(['theme'=>'ecclesiastical']);
do_action('customize_register', $m);
foreach (['global_layout','theme_content_feature_image','theme_footer_powered_by','theme_footer_custom_credit'] as $id) {
  $s=$m->get_setting($id); $c=$m->get_control($id);
  printf("%-30s setting=%s control=%s default=%s\n",$id,$s?'ok':'MISSING',$c?get_class($c):'MISSING',$s?substr(strip_tags((string)$s->default),0,40):'');
}
echo "sanitize bad layout -> ", $m->get_setting('global_layout')->sanitize('bogus'), "\n";
echo "sanitize good layout -> ", $m->get_setting('global_layout')->sanitize('right-sidebar'), "\n";
echo "panels: ", implode(',', array_keys($m->panels())), "\n";
// Settings page
do_action('admin_menu'); do_action('admin_init');
$page = Backdrop\App::resolve(Ecclesiastical\Settings\Admin\OptionsPage::class);
foreach (['general','themes','plugins'] as $v) {
  $_GET['view']=$v; $_GET['page']='ecclesiastical-settings';
  $view=$page->currentView(); $page->load();
  ob_start(); $page->template(); $html=ob_get_clean();
  printf("view %-8s len=%d heading=%s\n",$v,strlen($html), preg_match('/wp-heading-inline">Ecclesiastical Settings/',$html)?'ok':'MISSING');
}
$_GET['view']='general'; $page->load(); ob_start(); $page->template(); $g=ob_get_clean();
foreach (['disable_emoji','disable_toolbar','disable_wp_embed','error_page'] as $f) echo "  field $f: ", strpos($g,"ecclesiastical_settings[$f]")!==false?'ok':'MISSING', "\n";
$_GET['view']='themes'; ob_start(); $page->template(); $t=ob_get_clean(); echo "themes card for active theme: ", strpos($t,'Active:')!==false?'ok':'MISSING', "\n";
