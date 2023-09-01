<?php
if ( is_singular( 'faq' ) ) :
	$direct_answer = get_field( 'direct_answer' );
	$json_ld       = array(
		'@context'   => 'https://schema.org',
		'@type'      => 'FAQPage',
		'mainEntity' => array(
			'@type'          => 'Question',
			'name'           => get_the_title(),
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => $direct_answer,
			),
		),
	);
	?>
	<script type="application/ld+json">
		<?php echo json_encode( $json_ld, JSON_UNESCAPED_UNICODE ); ?>
	</script>
<?php endif; ?>
