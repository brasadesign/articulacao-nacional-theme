<?php
/**
 * Front-end post form.
 *
 * @package P2
 */
?>
<script type="text/javascript">
/* <![CDATA[ */
	jQuery(document).ready(function($) {
		$('#post_format').val($('#post-types a.selected').attr('id'));
		$('#post-types a').click(function(e) {
			$('.post-input').hide();
			$('#post-types a').removeClass('selected');
			$(this).addClass('selected');
			if ($(this).attr('id') == 'post') {
				$('#posttitle').val("<?php echo esc_js( __('Título da postagem', 'p2') ); ?>");
			} else {
				$('#posttitle').val('');
			}
			$('#postbox-type-' + $(this).attr('id')).show();
			$('#post_format').val($(this).attr('id'));
			return false;
		});
	});
/* ]]> */
</script>

<?php $post_format = isset( $_GET['p'] ) ? $_GET['p'] : 'post'; ?>
<div id="postbox">
		<div class="avatar">
			<?php echo get_avatar( get_current_user_id(), 48 ); ?>
		</div>

		<div id="poststuff" class="inputarea">

			<form id="new_post" name="new_post" method="post" action="<?php echo site_url(); ?>/">
				<?php if ( 'status' == $post_format || empty( $post_format ) ) : ?>
				<label for="posttext" id="post-prompt">
					<?php p2_user_prompt(); ?>
				</label>
				<?php endif; ?>

				<div id="postbox-type-post" class="post-input <?php if ( 'post' == $post_format || 'standard' == $post_format ) echo ' selected'; ?>">
				<h2>Escreva aqui!!</h2>
				<p><strong>Título</p></strong>
					<input type="text" name="posttitle" id="posttitle" value=""
						onfocus="this.value=(this.value=='<?php echo esc_js( __( 'Título da postagem', 'p2' ) ); ?>') ? '' : this.value;"
						onblur="this.value=(this.value=='') ? '<?php echo esc_js( __( 'Título da postagem', 'p2' ) ); ?>' : this.value;" />
				</div>
				<?php if ( current_user_can( 'upload_files' ) ): ?>				
				<div id="media-buttons" class="hide-if-no-js">
					<?php p2_media_buttons(); ?>
				</div>

			<span class="media-description">Inserir Imagem</span>

				<?php endif; ?>
				<textarea class="expand70-200" name="posttext" id="posttext" rows="4" cols="60"></textarea>
				<label class="post-error" for="posttext" id="posttext_error"></label>
				<div class="postrow">
					<input id="tags" name="tags" type="text" autocomplete="off"
						value="<?php esc_attr_e( 'Tags', 'p2' ); ?>"
						onfocus="this.value=(this.value=='<?php echo esc_js( __( 'Tags', 'p2' ) ); ?>') ? '' : this.value;"
						onblur="this.value=(this.value=='') ? '<?php echo esc_js( __( 'Tags', 'p2' ) ); ?>' : this.value;" />
					<input id="submit" type="submit" value="<?php esc_attr_e( 'Postar', 'p2' ); ?>" />
				</div>
				<input type="hidden" name="post_format" id="post_format" value="post" />
				<span class="progress spinner-post-new" id="ajaxActivity"></span>

				<?php do_action( 'p2_post_form' ); ?>

				<input type="hidden" name="action" value="post" />
				<?php wp_nonce_field( 'new-post' ); ?>
			</form>

		</div>

		<div class="clear"></div>

</div> <!-- // postbox -->
