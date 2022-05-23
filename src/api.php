<?php

namespace Mosaika\Remote_Requests\API;

defined( 'ABSPATH' ) || exit;

/**
 * Récupère les X derniers Gists d'un utilisateur GitHub spécifique.
 *
 * @param string $username
 * @param integer $amount
 * @return array
 */
function get_user_gists_via_api( $username = '', $amount = 10 ) {
	$gists = [];

	$response = wp_remote_request(
		sprintf( 'https://api.github.com/users/%1$s/gists?per_page=%2$s', sanitize_text_field( $username ), absint( $amount ) ),
		[
			'timeout' => 15,
			'method'  => 'GET',
		]
	);

	if ( (int) wp_remote_retrieve_response_code( $response ) === 200 ) {
		$gists = json_decode( wp_remote_retrieve_body( $response ) );
	}

	return $gists;
}
