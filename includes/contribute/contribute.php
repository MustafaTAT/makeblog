<?php

/**
 * Contribute!
 *
 * A class that will allow for forms to contribute posts.
 *
 * @since  Quantrons
 */

/**
 * The guts.
 *
 * This little guy controls and loads all that is Gigya.
 * The namespace for this class is Make because in the future this will be expanded to other make websites.
 *
 * @since  Quantrons
 */
class Make_Contribute {

	/**
	 * THE CONSTRUCT.
	 *
	 * All Hooks and Filter here.
	 * Anything else that needs to run when the class is instantiated, place them here.
	 * Maybe you'll get a cake if you do.
	 *
	 * @return  void
	 * @since  Quantrons
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'load_resources' ), 30 );

		// Process our ajax requests. We need ajax processing for both logged in and logged out users.
		// Since our login may be used by users logged into WordPress, we'll need the second option to run ajax requests.
		add_action( 'wp_ajax_nopriv_contribute_post', array( $this, 'contribute_post' ) );
		add_action( 'wp_ajax_contribute_post', array( $this, 'contribute_post' ) );

		// Add the steps ajax actions.
		add_action( 'wp_ajax_nopriv_add_steps', array( $this, 'add_steps' ) );
		add_action( 'wp_ajax_add_steps', array( $this, 'add_steps' ) );

		// Add the tools ajax actions.
		add_action( 'wp_ajax_nopriv_add_tools', array( $this, 'add_tools' ) );
		add_action( 'wp_ajax_add_tools', array( $this, 'add_tools' ) );

		// Add the parts ajax actions.
		add_action( 'wp_ajax_nopriv_add_parts', array( $this, 'add_parts' ) );
		add_action( 'wp_ajax_add_parts', array( $this, 'add_parts' ) );

		// Get the steps for a project.
		add_action( 'wp_ajax_nopriv_get_steps',  array( $this, 'get_steps' ) );
		add_action( 'wp_ajax_get_steps',  array( $this, 'get_steps' ) );

		// Get the steps for a project.
		add_action( 'wp_ajax_nopriv_get_steps_list',  array( $this, 'get_steps_list' ) );
		add_action( 'wp_ajax_get_steps_list',  array( $this, 'get_steps_list' ) );
	}

	/**
	 * Let's add all of our resouces to make our magic happen.
	 * Any scripts we should include in the footer or else things will conflict due to how we have to load the socialize API file... #facepalm
	 *
	 * @return  void
	 * @since  Quantrons
	 */
	public function load_resources() {

		// JavaScript
		wp_enqueue_script( 'parseley-js', get_stylesheet_directory_uri() . '/js/parsley.min.js', array( 'jquery' ), '2.0', true );
		wp_enqueue_script( 'bootstrap-file-input', get_stylesheet_directory_uri() . '/js/bootstrap.file-input.min.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'make-contribute', get_stylesheet_directory_uri() . '/includes/contribute/js/contribute.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'make-contrib-ui', get_stylesheet_directory_uri() . '/includes/contribute/js/contrib-ui.js', array( 'jquery' ), '1.0', true );
	}

	/**
	 * Uploads images and documents.
	 * @param  Integer $post_id The post ID we are adding the image to
	 * @param  Array   $files   An array of files being uploaded (captured via $_FILES)
	 * @return Array
	 */
	private function upload_files( $post_id, $files ) {

		if ( ! function_exists( 'wp_handle_upload' ) )
			require_once( ABSPATH . 'wp-admin/includes/file.php' );

		if ( ! function_exists( 'wp_crop_image' ) )
				require_once( ABSPATH . 'wp-admin/includes/image.php' );

		// And array of allowed file types to be uploaded
		$allowed_file_types = array(
			'jpg',
			'jpeg',
			'png',
			'gif',
		);

		// Setup the image array
		$images = array();

		// Loop through all of our uploaded files
		foreach ( $files as $name => $values ) {

			$file_type = wp_check_filetype( $values['name'] );
			// Ensure the file type being passed matches the field type (ie. photo uploads should only allow photos and documents as documents)
			if ( ! in_array( $file_type['ext'], $allowed_file_types ) )
				return;

			$overrides = array( 'test_form' => false );
			$file = wp_handle_upload( $values, $overrides );

			// Check if there were any errors
			if ( isset( $file['error'] ) ) {
				// TODO: update this to trigger a wp_error instead...
				return $results['error'] = $file['error'];
				exit();
			}

			$attachment = array(
				'guid' => $file['url'],
				'post_mime_type' => $file['type'],
				'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $values['name'] ) ),
				'post_content' => '',
				'post_status' => 'inherit'
			);
			$attachment_id = wp_insert_attachment( $attachment, $file['file'], $post_id );

			$attachment_data = wp_generate_attachment_metadata( $attachment_id, $values['name'] );

			wp_update_attachment_metadata( $attachment_id, $attachment_data );

			// Attach as a featured image if we are uploading the project photo
			if ( $name === 'file' )
				update_post_meta( $post_id, '_thumbnail_id', $attachment_id );

			// Get the upload directory
			$wp_upload_dir = wp_upload_dir();
			$thumb = image_make_intermediate_size( $file['file'], 500, 500 );

			// Due to legacy code, we need to pass two empty fields.
			// TODO: Update the image handling in make_magazine_projects_build_step_data() to allow a varying number of images, fixing the need to pass two empty values.
			$images[ sanitize_key( $name ) ] = array(
				esc_url( $file['url'] ),
				'',
				'',
			);
		}

		return $images;
	}


	/**
	 * Allows us to determine if the contributing author is a WordPress user or Guest Author based on the ID passed and return their username
	 * @return string | false
	 *
	 * @since  Robot House
	 */
	public function get_author_name( $id ) {
		// Gigya always passes IDs as long strings, if it's an integer, then we have a WP user
		if ( ctype_digit( $id ) ) { // Ensure the string contains only numbers.....
			$author_name = get_the_author_meta( 'user_login', absint( $id ) );

			return array( 'post_author' => $id, 'login_name' => $author_name );
		} else {
			global $make_gigya;

			// We'll need to check for this gigya user and return their information
			$guest_author = $make_gigya->search_for_maker_by_id( $id );

			if ( $guest_author ) {
				return array( 'login_name' => $guest_author[0]->post_name );
			} else {
				return false;
			}
		}
	}

	/**
	 * Build a row of photos based on uploaded images.
	 */
	public function image_rows( $id ) {
		$output = '';
		$media = get_attached_media( 'image', $id );
		$rows = array_chunk( $media, 4 );
		foreach ( $rows as $images ) {
			$output .= '<div class="row">';
			foreach ($images as $image) {
				$output .= '<div class="span2">';
				$output .= '<img src="' . esc_url( wpcom_vip_get_resized_remote_image_url( $image->guid, '130', '170' ) ) . '" alt="' . esc_attr( $image->post_title ) . '">';
				$output .= '</div>';
			}
			$output .= '</div>';
		}
		return $output;
	}

	/**
	 * Take the form data, and add a post/project.
	 *
	 * @return json
	 *
	 * @since  Quantrons
	 */
	public function contribute_post() {
		global $coauthors_plus;

		// Check our nonce and make sure it's correct
		if ( ! wp_verify_nonce( $_POST['contribute_post'], 'contribute_post_nonce' ) )
			die( 'We weren\'t able to verify that nonce...' );

		// Get the author ID
		$author_name = $this->get_author_name( $_POST['user_id'] );

		// Make sure an author was returned
		if ( ! $author_name )
			die( json_encode( 'ERROR: AUTHOR NOT FOUND' ) );

		$allowed_post_types = array(
			'post',
			'projects'
		);

		// Setup the post variables yo.
		$post = array(
			'post_status'	=> 'draft',
			'post_title'	=> ( isset( $_POST['post_title'] ) ) ? sanitize_text_field( $_POST['post_title'] ) : '',
			'post_name'		=> ( isset( $_POST['post_title'] ) ) ? sanitize_title( $_POST['post_title'] ) : '',
			'post_content'	=> ( isset( $_POST['post_content'] ) ) ? wp_kses_post( $_POST['post_content'] ) : '',
			'post_category'	=> ( isset( $_POST['cat'] ) ) ? array( absint( $_POST['cat'] ) ) : '',
			'post_type'		=> ( isset( $_POST['post_type'] ) && in_array( $_POST['post_type'], $allowed_post_types ) ) ? sanitize_text_field( $_POST['post_type'] ) : 'post',
			'post_author'	=> ( isset( $author_id['post_author'] ) ) ? absint( $author_id['post_author'] ) : 604631,
		);

		// Insert the post
		$pid = wp_insert_post( $post );

		// Add to CoAuthors Plus (for all users, not just Guest Authors)
		$author_set = $coauthors_plus->add_coauthors( absint( $pid ), array( $author_name['login_name'] ) );

		// Upload the files
		$this->upload_files( $pid, $_FILES );

		// Get the newly created post
		$post = get_post( $pid );

		$post->media = $this->image_rows( $pid );

		// Send our auto responders on save.
		$ar_nonce = wp_create_nonce( 'send-auto-responders' );
		$this->send_auto_responders( $post, $ar_nonce );

		// Send back the Post as JSON
		die( json_encode( $post ) );

	}

	/**
	 * Take the form data, and add a post/project.
	 *
	 * @return json
	 *
	 * @since  Quantrons
	 */
	public function add_steps() {

		////////////////////
		// Check our nonce and make sure it's correct
		if ( ! wp_verify_nonce( $_POST['contribute_steps_nonce'], 'contribute_steps_nonce' ) )
			die( 'We weren\'t able to verify that nonce...' );

		////////////////////
		// Upload the files
		$files = $this->upload_files( absint( $_POST['post_ID'] ), $_FILES );

		////////////////////
		// Merge the files array and the $_POST array.
		$merged = array_merge( $_POST, $files );

		//////////////////////////
		// STEPS
		$step_object = make_magazine_projects_build_step_data( $merged );

		// Update our post meta for Steps if any exist
		update_post_meta( absint( $_POST['post_ID'] ), 'Steps', $step_object );

		// Send back the
		die( json_encode( array( 'post_id' => $_POST['post_ID'] ) ) );

	}

	public function add_tools() {

		////////////////////
		// Check our nonce and make sure it's correct
		if ( ! wp_verify_nonce( $_POST['contribute_tools'], 'contribute_tools' ) )
			die( 'We weren\'t able to verify that nonce...' );

		////////////////////
		// Build the tools object
		$tools_object = make_magazine_projects_build_tools_data( $_POST );

		////////////////////
		// Update our post meta for Steps. Unlike Steps and Tools, we want one meta key.
		update_post_meta( absint( absint( $_POST['post_ID'] ) ), 'Tools', $tools_object );

		////////////////////
		// Let's get the tools out of the database.
		$tools = get_post_meta( absint( $_POST['post_ID'] ), 'Tools' );

		////////////////////
		// Send back the tools object
		die( make_projects_tools( $tools ) );

	}

	public function add_parts() {

		////////////////////
		// Check our nonce and make sure it's correct
		if ( ! wp_verify_nonce( $_POST['contribute_parts'], 'contribute_parts' ) )
			die( 'We weren\'t able to verify that nonce...' );

		///////////////////////
		// PARTS
		$parts = make_magazine_projects_build_parts_data( $_POST );

		$meta_obj = array();
		foreach ( $parts as $part ) {
			$meta_obj[] = add_post_meta( absint( $_POST['post_ID'] ), 'parts', $part );
		}

		$parts = get_post_meta( absint( $_POST['post_ID'] ), 'parts' );

		////////////////////
		// Send back the tools object
		die( make_projects_parts( $parts ) );

	}

	/**
	 * Get the steps HTML
	 */
	public function get_steps() {

		////////////////////
		// Check our nonce and make sure it's correct
		if ( ! wp_verify_nonce( $_POST['get_steps'], 'get_steps' ) )
			die( 'We weren\'t able to verify that nonce...' );

		///////////////////////
		// Get the steps.
		$steps = get_post_custom_values( 'Steps', absint( $_POST['post_ID'] ) );

		///////////////////////
		// HTMLify the steps.
		make_projects_steps( $steps );

		////////////////////
		// We are done here right?
		die();

	}

	/**
	 * Get the steps HTML
	 */
	public function get_steps_list() {

		////////////////////
		// Check our nonce and make sure it's correct
		if ( ! wp_verify_nonce( $_POST['get_steps'], 'get_steps' ) )
			die( 'We weren\'t able to verify that nonce...' );

		///////////////////////
		// Get the steps.
		$steps = get_post_custom_values( 'Steps', absint( $_POST['post_ID'] ) );

		///////////////////////
		// HTMLify the steps.
		make_projects_steps_list( $steps );

		////////////////////
		// Done here right?
		die();

	}


	/**
	 * Allows us to send emails to the editors and author on post completion and acceptance
	 * @return void
	 */
	private function send_auto_responders( $post, $nonce ) {

		// Check that a nonce is set and is valid
		if ( ! empty( $nonce ) && ! wp_verify_nonce( $nonce, 'send-auto-responders' ) )
			return 'Auto Responders not sent!';

		// Check if the post variable is an object or an integer. If it's an int, fetch the post object
		if ( is_object( $post ) ) {
			$post = $post;
		} elseif ( is_int( $post ) ) {
			$post = get_post( absint( $post ) );
		} else {
			$post = null;
		}

		if ( empty( $post ) )
			return null;

		// Ensure that we are only dealing with posts or projects
		if ( isset( $post->post_type ) && ! in_array( $post->post_type, array( 'post', 'projects' ) ) )
			return;

		// Get the author info
		$author = get_coauthors( absint( $post->ID ) );

		// Build the email object
		$email_obj = array(
			'post_title'	 => $post->post_title,
			'edit_slug'		 => admin_url( '/post.php?post=' . absint( $post->ID ) . '&action=edit' ),
			'post_type'		 => $post->post_type,
			'author_name'	 => $author[0]->data->display_name,
			'author_email' 	 => $author[0]->data->user_email,
			'author_profile' => home_url( '/author/' . $author[0]->data->user_nicename ),
			'post_date'		 => strtotime( $post->post_date ),
		);

		// add our emails to the obj
		$email_obj['email']['send_tos'] = array(
			'editors' => '',
			'author'  => $email_obj['author_email'],
		);

		// Prevent submissions in our testing environments
		if ( isset( $_SERVER['HTTP_HOST'] ) && in_array( $_SERVER['HTTP_HOST'], array( 'localhost', 'make.com', 'vip.dev', 'staging.makezine.com' ) ) )
			$email_obj['email']['send_tos']['editors'] = 'cgeissinger@makermedia.com';

		// Add a default from address
		$email_obj['email']['from'] = 'editors@makezine.com';

		// Add the subject
		$email_obj['email']['subjects'] = array(
			'editors' => 'New Submission to Make - ' . esc_html( $email_obj['post_title'] ),
			'author'  => 'Your Recent Submission to makezine.com - ' . esc_html( $email_obj['post_title'] ),
		);

		// Fetch the email templates
		$editor_path = __DIR__ . '/emails/notify-new-post.html';
		$author_path = __DIR__ . '/emails/applicant-receipt.html';

		// Prevent Path Traversal
		if ( strpos( $editor_path, '../' ) !== false || strpos( $editor_path, "..\\" ) !== false || strpos( $editor_path, '/..' ) !== false || strpos( $editor_path, '\..' ) !== false )
			return;

		if ( strpos( $author_path, '../' ) !== false || strpos( $author_path, "..\\" ) !== false || strpos( $author_path, '/..' ) !== false || strpos( $author_path, '\..' ) !== false )
			return;

		// Check if our templates exist
		if ( ! file_exists( $editor_path ) || ! file_exists( $author_path ) )
			return;

		// Get the contents of our email templates
		$editor_body = file_get_contents( $editor_path );
		$author_body = file_get_contents( $author_path );

		// Perform a search and replace on our HTML templates with actual data
		$find_and_replace = array(
			'$post_title' => esc_html( $email_obj['post_title'] ),
			'$the_permalink' => esc_url( $email_obj['edit_slug'] ),
			'$post_type' => esc_html( $email_obj['post_type'] ),
			'$post_author' => esc_html( ucwords( $email_obj['author_name'] ) ),
			'$author_email' => sanitize_email( $email_obj['author_email'] ),
			'$author_permalink' => esc_url( $email_obj['author_profile'] ),
			'$post_date' => date( 'D F d, Y h:i:s A' ),
		);
		$editor_message = force_balance_tags( str_replace( array_keys( $find_and_replace ), array_values( $find_and_replace ), $editor_body ) );
		$author_message = force_balance_tags( str_replace( array_keys( $find_and_replace ), array_values( $find_and_replace ), $author_body ) );

		// Send the emails!
		// @TODO: Update to send to wp_cron instead of just pushing emails. This will be more important when the flood gates open and more email is processed.
		wp_mail( sanitize_email( $email_obj['email']['send_tos']['editors'] ), esc_html( $email_obj['email']['subjects']['editors'] ), $editor_message, array( 'Content-Type: text/html', "From: {$email_obj['email']['from']}" ) );
		wp_mail( sanitize_email( $email_obj['email']['send_tos']['author'] ), esc_html( $email_obj['email']['subjects']['author'] ), $author_message, array( 'Content-Type: text/html', "From: {$email_obj['email']['from']}" ) );
	}

}

$make_contribute = new Make_Contribute();