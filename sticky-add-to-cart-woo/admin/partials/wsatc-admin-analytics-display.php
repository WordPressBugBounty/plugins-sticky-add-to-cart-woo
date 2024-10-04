<div class="wsatc-admin-analytics-wrapper">

		<?php do_action( 'wsatc_after_analytics_header' ); ?>

		<?php
		if ( ! wsatc_is_pro() ) {
				$dummy_output = '
								<div class="analytics-display-area wsatc-stats-tease" data-swal="true">
										<img src="' . WSATC_DIR_URL . 'assets/img/analytics-image.png" alt="Analytics Data">
										<div class="wsatc-stats-pro-tease">
												<a href="' . WSATC_PRO_LINK . '">
														<p>Get PRO to Unlock</p>
												</a>
										</div>
								</div>
						';
				echo $dummy_output;
		}
		?>
</div>