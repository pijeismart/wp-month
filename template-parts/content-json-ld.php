<?php if ( is_singular( 'faq' ) ) : ?>
<script type="application/ld+json">
	{
	  "@context": "https://schema.org",
	  "@type": "FAQPage",
	  "mainEntity": [{
		"@type": "Question",
		"name": "<?php echo get_the_title(); ?>",
		"acceptedAnswer": {
		  "@type": "Answer",
		  "text": "
		    <?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'direct_answer',
					't'  => 'p',
					'tc' => 'faq-detail__answer',
					'o'  => 'f',
				)
			);
			?>
			"
		}
	  }]
	}
</script>
<?php endif; ?>
