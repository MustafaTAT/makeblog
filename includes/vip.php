<?php

require_once( WP_CONTENT_DIR . '/themes/vip/plugins/vip-init.php' );

if ( function_exists( 'wpcom_vip_enable_opengraph' ) ) {
	wpcom_vip_enable_opengraph();
}

if ( function_exists( 'vip_contrib_add_upload_cap' ) ) {
	vip_contrib_add_upload_cap();
}

if ( function_exists( 'wpcom_vip_sharing_twitter_via' ) ) {
	wpcom_vip_sharing_twitter_via( 'make' );
}

wpcom_vip_load_plugin( 'breadcrumb-navxt' );
wpcom_vip_load_plugin( 'wp-help' );
wpcom_vip_load_plugin( 'recent-comments' );
wpcom_vip_load_plugin( 'easy-custom-fields' );
wpcom_vip_load_plugin( 'edit-flow' );
wpcom_vip_load_plugin( 'wp-page-numbers' );
wpcom_vip_load_plugin( 'lazy-load' );
wpcom_vip_load_plugin( 'get-the-image' );
wpcom_vip_load_plugin( 'storify' );
wpcom_vip_load_plugin( 'cheezcap' );
wpcom_vip_load_plugin( 'add-meta-tags-mod' );
wpcom_vip_load_plugin( 'wpcom-thumbnail-editor' );
wpcom_vip_load_plugin( 'wp-frontend-uploader' );
wpcom_vip_load_plugin( 'multiple-post-thumbnails' );
wpcom_vip_load_plugin( 'taxonomy-images' );
wpcom_vip_load_plugin( 'simply-show-ids' );
//wpcom_vip_load_plugin( 'wpcom-related-posts' );
wpcom_vip_load_plugin( 'view-all-posts-pages' );
wpcom_vip_load_plugin( 'co-authors-plus' );

if (is_page('contribute')) {
	wpcom_vip_load_plugin( 'wp-frontend-uploader' );	
}

if ( ! jetpack_is_mobile() ) {
	wpcom_vip_load_plugin( 'facebook' );
}

/**
 * Redirects to handle legacy URL structure from old site
 */
if ( function_exists( 'vip_regex_redirects' ) ) {
	$redirects = array(
		'|^/archive/([0-9]{4})/([0-9]{2})/([^/]+)\.html|' => '|/$1/$2/$3/|', // MT articles
		'|^/([0-9]+)\.html$|' => '|/$1/|', // MT page structure - just redirect to postname and WordPress will resolve
		'|^/archive/category/([a-zA-Z_]+)|' => '|/category/$1/|', // MT category
		'|^/archive/category/([a-zA-Z_]+)/index.xml$|' => '|/category/$1/feed/', // MT category feed
		'|^/archive/category/([a-zA-Z_]+)/feed|' => '|/category/$1/feed/', // Old WordPress Podcast feeds
		'|^/archive/category/([a-zA-Z]+)/([0-9]+)\.html$|' => '|/category/$1/page/$2/', // MT paginated category structure
		'|^/([0-9]{2})/([^/]+)/?$|' => 'http://archive.makezine.com|/$1/$2|',
	);
	vip_regex_redirects( $redirects );
}
if ( function_exists( 'vip_redirects' ) ) {
	vip_redirects( array(
		'/index.xml'         => 'http://blog.makezine.com/feed/', // really old feeds
		'/feed/rss'          => 'http://blog.makezine.com/feed/', // really old feeds
		'/podcast'           => 'http://blog.makezine.com/video/', // Old podcast => video
		//'/home-page-include' => 'http://makezine.com/', // Old podcast => video
		'/2008/01/15/weekend-projects/' => 'http://blog.makezine.com/weekend-projects/' // Weekend Projects
	) );
}

if ( function_exists( 'vip_redirects' ) ) {
	$redirects = array(
		'/subscribe' 				=> 'https://readerservices.makezine.com/MK/MKSubnew1.aspx?PC=MK',
		'/renew'					=> 'https://readerservices.makezine.com/mk/subinfo.aspx?pc=mk',
		'/paybill'					=> 'https://readerservices.makezine.com/mk/subinfo.aspx?pc=mk',
		'/account'					=> 'https://readerservices.makezine.com/mk/subinfo.aspx?pc=mk',
		'/premier'					=> 'https://readerservices.makezine.com/mk/subinfo.aspx?pc=mk',
		'/coolgifts'				=> 'https://readerservices.makezine.com/backissue/subbi.aspx?PC=MK&AN=&Zp=&PK=',
		'/gift'						=> 'https://readerservices.makezine.com/mk/SubGiftSplash.aspx',
		'/04/strobe/indstrobe.mov'	=> 'http://downloads.oreilly.com/make/04/indstrobe.mov',
		'/04/flash/caps.mov'		=> 'http://downloads.oreilly.com/make/04/caps.mov',
		'/save'						=> 'https://readerservices.makezine.com//MK/Subnew.aspx?PC=MK&PK=0EBSPL',
		'/offer'					=> 'https://readerservices.makezine.com/MK/MKSubnew1.aspx?PC=MK',
		'/bonus'					=> 'https://readerservices.makezine.com/MK/MKSubnew1.aspx?PC=MK',
		'/talk'						=> 'http://forums.makezine.com/',
		'/fair'						=> 'http://makezine.com/faire/',
		'/faire'					=> 'http://makerfaire.com/',
		'/makerfaire'				=> 'http://makerfaire.com/',
		'/06/legosoccer/focal'		=> 'http://digital.ni.com/public.nsf/allkb/29D716D6F4F1FBC386256AE700727AF6',
		'/suboffer'					=> 'https://readerservices.makezine.com/MK/MKSubnew1.aspx?PC=MK',
		'/weekendprojects'			=> 'http://blog.makezine.com/the-weekend-projects/',
		'/sff'						=> 'http://store.makezine.com/ProductDetails.asp?ProductCode=0596529201',
		'/pdf'						=> 'http://www.makezine.com/blog/archive/make_pdf/',
		'/store'					=> 'http://makershed.com/',
		'/3D'						=> 'http://www.makezine.com/3d',
		'/elementsofhumanity'		=> 'http://elementsofhumanity.com/',
		'/pub/au/Terrie_Miller'		=> 'http://makezine.com/pub/au/Terrie_Schweitzer',
		'/GO/HIW'					=> 'http://makezine.com/hardware-innovation-workshop/',
		'/3Dspecial'				=> 'https://readerservices.makezine.com/MK/subscribe.aspx?PC=MK&PK=M25SCHO',
		'/tellus/survey'			=> 'http://www.opinionpath.net/mke/cgi-bin/ciwweb.pl?studyname=mke',
		'/mf2012'					=> 'https://readerservices.makezine.com/mk/subinfo.aspx?PC=MK&PK=M25MFIS&DO=R',
		'/v/31'						=> 'http://makezine.com/31/',
		'/craft/blog'				=> 'http://blog.makezine.com/craftzine/',
		'/move'						=> 'https://pubservice.com/SubGiftv2.aspx?PC=MK&PK=M2XBUS',
		'/241'						=> 'https://www.pubservice.com/subgiftcombo.aspx?PC=MK&PK=42M241',
		'/holidaygift'				=> 'https://pubservice.com/Subgiftcombo.aspx?PC=MK&PK=429HOL9',
		'/bogo'						=> 'https://www.pubservice.com/subgiftcombo.aspx?PC=MK&PK=42BBN03',
		'/PM241'					=> 'https://pubservice.com/Subgiftcombo.aspx?PC=MK&PK=42MPM24',
		'/3Dfree'					=> 'https://readerservices.makezine.com/mk/subscribe.aspx?PC=MK&PK=B31BLB',
		'/3Dbonus'					=> 'https://readerservices.makezine.com/mk/subscribe.aspx?PC=MK&PK=B31BIN',
		'/33'						=> 'http://blog.makezine.com/volume/make-33/',
		'/5issues'					=> 'https://readerservices.makezine.com/mk/subscribe.aspx?PC=MK&PK=M34AIR',
		'/3DPDF'					=> 'https://readerservices.makezine.com/mk/subscribe.aspx?PC=MK&PK=M35SIP',
		'/3dpdf'					=> 'https://readerservices.makezine.com/mk/subscribe.aspx?PC=MK&PK=M35SIP',
		'/magazine'					=> 'http://makezine.com/volume/make-34/',
		'/34'						=> 'http://makezine.com/volume/make-34/',
		'/maker-projects'			=> 'http://makezine.com/maker-projects/',
		'/01'						=> 'http://archive.makezine.com/01/',
		'/02'						=> 'http://archive.makezine.com/02/',
		'/03'						=> 'http://archive.makezine.com/03/',
		'/04'						=> 'http://archive.makezine.com/04/',
		'/05'						=> 'http://archive.makezine.com/05/',
		'/06'						=> 'http://archive.makezine.com/06/',
		'/07'						=> 'http://archive.makezine.com/07/',
		'/08'						=> 'http://archive.makezine.com/08/',
		'/09'						=> 'http://archive.makezine.com/09/',
		'/10'						=> 'http://archive.makezine.com/10/',
		'/11'						=> 'http://archive.makezine.com/11/',
		'/12'						=> 'http://archive.makezine.com/12/',
		'/13'						=> 'http://archive.makezine.com/13/',
		'/14'						=> 'http://archive.makezine.com/14/',
		'/15'						=> 'http://archive.makezine.com/15/',
		'/16'						=> 'http://archive.makezine.com/16/',
		'/17'						=> 'http://archive.makezine.com/17/',
		'/18'						=> 'http://archive.makezine.com/18/',
		'/19'						=> 'http://archive.makezine.com/19/',
		'/20'						=> 'http://archive.makezine.com/20/',
		'/21'						=> 'http://archive.makezine.com/21/',
		'/22'						=> 'http://archive.makezine.com/22/',
		'/23'						=> 'http://archive.makezine.com/23/',
		'/24'						=> 'http://archive.makezine.com/24/',
		'/25'						=> 'http://archive.makezine.com/25/',
		'/26'						=> 'http://archive.makezine.com/26/',
		'/27'						=> 'http://archive.makezine.com/27/',
		'/28'						=> 'http://archive.makezine.com/28/',
		'/29'						=> 'http://archive.makezine.com/29/',
		'/30'						=> 'http://archive.makezine.com/30/',
		'/31'						=> 'http://archive.makezine.com/31/',
		'/32'						=> 'http://archive.makezine.com/32/',
		'/faq/index.html'			=> 'http://makezine.com/faq/',
		'/community/index.html'		=> 'http://archive.makezine.com/community/index.html',
		'/help/index.html'			=> 'http://archive.makezine.com/help/index.html',
		'/hardware-innovation-workshop/videos.html'	=> 'http://archive.makezine.com/hardware-innovation-workshop/videos.html',
		'/magazine/newsletter/makerpro' => 'http://archive.makezine.com/magazine/newsletter/makerpro/index.html',
		'/groups'					=> 'http://archive.makezine.com/groups/',
		'/make-newsletter'			=> 'http://makezine.com/newsletter/',
	);
	vip_redirects( $redirects );
}

/**
 * Handle URLs with underscores in the post_name. Turn:
 *      http://blog.makezine.com/2009/01/toolbox_from_miserable_old_box_to_w/
 * into:
 *      http://blog.makezine.com/2009/01/toolbox-from-miserable-old-box-to-w/
 * We could do this with regex but the regex approach is much more gnarly
 * @see http://vip-support.automattic.com/tickets/4424
 */
if ( false !== strpos( $_SERVER['REQUEST_URI'], '_' ) )
	add_action( 'template_redirect', 'makeblog_redirect_urls_with_underscores' );
function makeblog_redirect_urls_with_underscores( ) {
	if ( !is_404() )
		return;
	$new_uri = str_replace( '_', '-', $_SERVER['REQUEST_URI'] );
	$new_url = home_url( $new_uri );
	wp_safe_redirect( $new_url );
	exit;
}

/**
 * For pre-VIP launch URLs, modify the permalink within the_content so the share buttons
 * utilitize the old URL structure. Only modify it temporarily though, and remove after finished
 */
add_filter( 'the_content', 'makeblog_add_permalink_filter' );
function makeblog_add_permalink_filter( $the_content ) {
	global $post;

	if ( $post->ID <= 171681 ) {
		add_filter( 'post_link', 'makeblog_filter_the_content_permalink', 10, 2 );
		add_filter( 'pre_get_shortlink', 'makeblog_filter_the_content_shortlink', 10, 2 );
	}
	
	return $the_content;
}
add_filter( 'the_content', 'makeblog_remove_permalink_filter', 1000 );
function makeblog_remove_permalink_filter( $the_content ) {
	
	remove_filter( 'post_link', 'makeblog_filter_the_content_permalink' );
	remove_filter( 'pre_get_shortlink', 'makeblog_filter_the_content_shortlink' );
	return $the_content;
}
function makeblog_filter_the_content_permalink( $permalink, $post ) {

	// Replace the /yyyy/mm/dd/ structure with /archive/yyyy/mm/
	$old_date_struct = date( '/Y/m/d/', strtotime( $post->post_date ) );
	$new_date_struct = date( '/Y/m/', strtotime( $post->post_date ) );
	$new_date_struct = '/archive' . $new_date_struct;
	$permalink = str_replace( $old_date_struct, $new_date_struct, $permalink );

	// Remove the trailing slash and append .html
	$permalink = rtrim( $permalink, '/' );
	$permalink .= '.html';	
	return $permalink;
}
function makeblog_filter_the_content_shortlink( $ret, $post_id ) {

	$permalink = get_permalink( $post_id );
	return $permalink;
}

vip_main_feed_redirect( 'http://feeds.feedburner.com/makezineonline' );


add_action( 'init', function() {
    if ( 0 === strpos( $_SERVER['REQUEST_URI'], '/pub/' ) ) {
        wp_redirect( esc_url_raw( 'http://archive.makezine.com' . $_SERVER['REQUEST_URI'] ) );
        exit;
    }
} );