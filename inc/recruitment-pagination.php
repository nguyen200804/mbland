<?php
/**
 * Link phan trang sach /tuyen-dung/page/N/ cho Page tinh dung template Tuyen dung.
 *
 * - Tu dong tao rewrite rule cho moi Page dang dung template tuyen dung (VI + EN).
 * - Tu dong flush rewrite khi danh sach rule thay doi (khong can vao Settings > Permalinks).
 * - Chan redirect_canonical lam mat /page/N/ tren Page tinh.
 *
 * @package HomeNest Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Cac template tuyen dung (duong dan tuong doi tu thu muc theme).
 *
 * @return string[]
 */
function mbland_recruitment_templates() {
	return array(
		'templates/template-recruitment.php',
		'templates/template-recruitment-en.php',
	);
}

/**
 * Lay URI (vd: 'tuyen-dung', 'career') cua cac Page dung template tuyen dung. Co cache bang transient.
 *
 * @return string[]
 */
function mbland_recruitment_page_uris() {
	$uris = get_transient( 'mbland_recruitment_page_uris' );
	if ( is_array( $uris ) ) {
		return $uris;
	}

	$ids = get_posts( array(
		'post_type'        => 'page',
		'post_status'      => 'publish',
		'numberposts'      => -1,
		'fields'           => 'ids',
		'suppress_filters' => true, // lay du cac ngon ngu (Polylang)
		'meta_query'       => array(
			array(
				'key'     => '_wp_page_template',
				'value'   => mbland_recruitment_templates(),
				'compare' => 'IN',
			),
		),
	) );

	$uris = array();
	foreach ( $ids as $id ) {
		$uri = get_page_uri( $id );
		if ( $uri ) {
			$uris[] = $uri;
		}
	}
	$uris = array_values( array_unique( $uris ) );

	set_transient( 'mbland_recruitment_page_uris', $uris, DAY_IN_SECONDS );
	return $uris;
}

// Xoa cache khi Page thay doi.
function mbland_recruitment_clear_uri_cache() {
	delete_transient( 'mbland_recruitment_page_uris' );
}
add_action( 'save_post_page', 'mbland_recruitment_clear_uri_cache' );
add_action( 'deleted_post', 'mbland_recruitment_clear_uri_cache' );
add_action( 'trashed_post', 'mbland_recruitment_clear_uri_cache' );

// Dang ky rewrite rule /<uri>/page/N/.
function mbland_recruitment_add_rewrite_rules() {
	$uris = mbland_recruitment_page_uris();

	foreach ( $uris as $uri ) {
		add_rewrite_rule(
			'^' . preg_quote( $uri, '/' ) . '/page/([0-9]+)/?$',
			'index.php?pagename=' . $uri . '&paged=$matches[1]',
			'top'
		);
	}

	// Tu dong flush khi tap rule thay doi.
	$hash = md5( wp_json_encode( $uris ) );
	if ( get_option( 'mbland_recruitment_rules_hash' ) !== $hash ) {
		flush_rewrite_rules( false );
		update_option( 'mbland_recruitment_rules_hash', $hash, false );
	}
}
add_action( 'init', 'mbland_recruitment_add_rewrite_rules', 99 );

// Khong de WordPress redirect /page/N/ ve trang goc tren Page tuyen dung.
function mbland_recruitment_disable_canonical( $redirect_url ) {
	if ( is_page() && get_query_var( 'paged' ) > 1 ) {
		$template = get_page_template_slug( get_queried_object_id() );
		if ( in_array( $template, mbland_recruitment_templates(), true ) ) {
			return false;
		}
	}
	return $redirect_url;
}
add_filter( 'redirect_canonical', 'mbland_recruitment_disable_canonical' );

/**
 * Bo loc dung ten tham so = slug taxonomy (vi-tri-ung-tuyen, noi-lam-viec, hinh-thuc-lam-viec).
 * Neu taxonomy bat query_var, WordPress se them tax_query vao main query cua Page => 404.
 * Go cac query var nay khoi main query cua Page; template van doc truc tiep tu $_GET.
 */
function mbland_recruitment_strip_tax_query_vars( $query_vars ) {
	if ( isset( $query_vars['pagename'] ) || isset( $query_vars['page_id'] ) ) {
		foreach ( array( 'vi-tri-ung-tuyen', 'noi-lam-viec', 'hinh-thuc-lam-viec' ) as $tax ) {
			unset( $query_vars[ $tax ] );
		}
	}
	return $query_vars;
}
add_filter( 'request', 'mbland_recruitment_strip_tax_query_vars' );
