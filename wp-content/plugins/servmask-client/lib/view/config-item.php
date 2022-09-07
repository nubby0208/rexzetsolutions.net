<tr class="<?php echo (int) $is_good ? 'positive' : 'negative'; ?>">
	<td> <?php echo $name; ?> </td>
	<td>
		<?php
		if ( is_array( $value ) ) :
			foreach ( $value as $data_key => $data_info ) :
				foreach ( $data_info as $key => $val ) :
					$data = explode( ' - ', $val );
					echo $val . '<br />';

					$name = '[]';
					if ( count( $data ) >= 2 ) {
						$name = ' - ' . $data[0];
					}
					?>
			<input type="hidden" name="<?php echo $data_key . $name; ?>" value="<?php echo isset( $data[1] ) ? $data[1] : $data[0]; ?>" />
					<?php
				endforeach;
			endforeach;
			else :
				echo $value;
				?>
		<input type="hidden" name="<?php echo $name; ?>" value="<?php echo $value; ?>" />
				<?php
		endif;
			?>
	</td>
</tr>

