<?php

namespace Mosaika\Remote_Requests\Utils;

use function Mosaika\Remote_Requests\API\get_user_gists_via_api;

defined( 'ABSPATH' ) || exit;

/**
 * Interroge l'API pour récupérer les Gists d'un utilisateur et les sauvegarde dans la base de données.
 *
 * @param string $username
 * @param integer $amount
 * @return void
 */
function save_user_gists( $username = '', $amount = 10 ) {
	$gists         = get_user_gists_via_api( $username, $amount );
	$option_name   = sprintf( 'msk_gists_%1$s_%2$d', sanitize_text_field( $username ), absint( $amount ) );
	$cleaned_gists = [];

	if ( ! empty( $gists ) ) {
		$cleaned_gists = array_map(
			function( $gist ) {
				return (object) [
					'id'          => sanitize_text_field( $gist->id ),
					'url'         => sanitize_url( $gist->url ),
					'description' => sanitize_textarea_field( $gist->description ),
					'files'       => array_map( 'sanitize_text_field', array_values( wp_list_pluck( $gist->files, 'filename' ) ) ),
					'created_at'  => strtotime( $gist->created_at ),
					'updated_at'  => strtotime( $gist->updated_at ),
				];
			},
			$gists
		);

		update_option( $option_name, $cleaned_gists, false );
		update_option( "{$option_name}_saved_at", time(), false );
	}

	return $cleaned_gists;
}

/**
 * Récupère la liste des Gists sauvegardés en base de données, ou appelle l'API pour les récupérer.
 *
 * @param string $username
 * @param integer $amount
 * @return void
 */
function get_user_gists( $username = '', $amount = 10 ) {
	$last_save = get_option( sprintf( 'msk_gists_%1$s_%2$d_saved_at', sanitize_text_field( $username ), absint( $amount ) ) );

	if ( empty( $last_save ) || ( time() - (int) $last_save ) > DAY_IN_SECONDS ) {
		return save_user_gists( $username, $amount );
	}

	return get_option( sprintf( 'msk_gists_%1$s_%2$d', sanitize_text_field( $username ), absint( $amount ) ) );
}
