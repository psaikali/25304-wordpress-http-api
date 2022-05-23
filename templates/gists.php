<?php

defined( 'ABSPATH' ) || exit;

?>

<ol class="gists">
	<?php foreach ( $gists as $gist ) {
		printf(
			'<li>
				<a href="%1$s">
					<h6>%2$s</h6>
					<p class="meta"><small>%4$s</small></p>
					<blockquote>%3$s</blockquote>
				</a>
			</li>',
			esc_url( $gist->url ),
			sanitize_text_field( implode( ', ', $gist->files ) ),
			sanitize_textarea_field( $gist->description ),
			sprintf( 'Créé le %1$s, mis à jour le %2$s', wp_date( 'd/m/Y', $gist->created_at ), wp_date( 'd/m/Y', $gist->updated_at ) )
		);
	} ?>
</ol>
