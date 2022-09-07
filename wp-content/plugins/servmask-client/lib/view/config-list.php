<br />
<div class="ui">
	<div class="ui active inverted dimmer">
		<div class="ui text loader" style="top: 20%">Loading</div>
	</div>
	<p>
		<form
			method="post"
			target="_blank"
			action="<?php echo esc_url( admin_url( 'admin-post.php?action=smc_export_pdf' ) ); ?>"
			class="ui form">
			<table class="ui single line celled table" style="width: auto; max-width: 100%;">
				<thead>
					<tr>
						<th>Option</th>
						<th>Value</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ( $configs as $config ) {
						$config->html();
					}
					?>
				</tbody>
			</table>
			<button type="submit" class="ui primary button" name="smc_backups" style="padding: 0 10px;">
				Save as pdf
			</button>
			<?php if ( $debug_log && isset( $_GET['debug_log'] ) ) : ?>
				<button type="button" class="ui primary button" name="smc_error" style="padding: 0 10px;">
					<a
					href="<?php echo $debug_log; ?>"
					type="application/octet-stream"
					download
					style="color: #fff">Download debug log file</a>
				</button>
			<?php endif; ?>
			<?php if ( $error_log && isset( $_GET['error_log'] ) ) : ?>
				<button type="button" class="ui primary button" name="smc_error" style="padding: 0 10px;">
					<a
					href="<?php echo $error_log; ?>"
					type="application/octet-stream"
					download
					style="color: #fff">Download error log file</a>
				</button>
			<?php endif; ?>
		</form>
	</p>
</div>


