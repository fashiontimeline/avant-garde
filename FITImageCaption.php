<?php

// Grab the n10s admin styling and add the js script file
add_action( 'admin_enqueue_scripts', 'fit_enqueue_admin_style' );

function fit_enqueue_admin_style() {
	wp_register_style( 'fit_admin_style', get_stylesheet_directory_uri() . '/custom-modules/fit-image-caption-admin.css' );
	wp_enqueue_style( 'fit_admin_style' );
}

class ET_Builder_Module_Image_FIT extends ET_Builder_Module {
	function init() {
		$this->name       = esc_html__( 'FIT Image/Caption', 'et_builder' );
		$this->slug       = 'et_pb_image_fit';
		$this->vb_support = 'off';
		
	}

	function get_fields() {
		$fields = array(
			'src' => array(
				'label'              => esc_html__( 'Image To Use', 'et_builder' ),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__( 'Select From Library', 'et_builder' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'et_builder' ),
				'update_text'        => esc_attr__( 'Set As Image', 'et_builder' ),
				'description'        => esc_html__( 'Select your desired image from the Media Library or Upload a file. Remember to name your images with the exact year (if known) or approximate century, then the artist/designer last name or short version of your post title, and then the figure number. Examples: 1884Sargent1.jpg; 14thdoublet3.jpg; 2003Cavalli2.jpg', 'et_builder' ),
			),
			'fig_number' => array(
				'label'           => esc_html__( 'Figure Number*', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => 'THIS IS A REQUIRED FIELD. Enter the figure number here. Enter ONLY A NUMBER. Remember to number all figures sequentially, in the order the images are discussed. Example: 1',
			),
			'artist_name' => array(
				'label'           => esc_html__( 'Artist/Designer Name*', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => 'THIS IS A REQUIRED FIELD. Enter the name of the artist or designer here. First name then Last name.  Remember to include any accented characters, if relevant. If an artwork’s creator is unknown, enter: Artist unknown. If a garment’s creator is unknown, enter: Designer unknown. Examples: Édouard Manet; Roberto Cavalli; John Singer Sargent; Designer unknown; Artist unknown; Maker unknown',
			),
			'nationality' => array(
				'label'           => esc_html__( 'Nationality', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => 'Enter the nationality of the artist/designer here, if known. Please capitalize. Examples: American; French; German',
			),
			'life_dates' => array(
				'label'           => esc_html__( 'Life Dates', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => 'Enter the artist/designer’s life dates here, if known. Year born-Year died (if appropriate). Enter ONLY NUMBERS. Examples: 1832-1883; 18??-1904; 1941-',
			),
			'title_description' => array(
				'label'           => esc_html__( 'Title/Description*', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => 'THIS IS A REQUIRED FIELD. Enter the artwork title, periodical title, or museum description here. Examples: Madame X (Virginie Gautreau); Luncheon on the Grass; La Mode illustrée; Evening dress',
			),
			'date_season' => array(
				'label'           => esc_html__( 'Date/Season*', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => 'THIS IS A REQUIRED FIELD. Enter the year the work was created or the season and year, if part of a designer’s collection. If a periodical, include volume number, issue number and (Month Year). Remember to convert all Roman numerals (VII) to Arabic numerals (7). Examples: 1884; 1842-56; Spring/Summer 2003; vol. 4, no. 12 (July 1863)',
			),
			'medium_materials' => array(
				'label'           => esc_html__( 'Medium/Materials', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => 'Enter the medium or materials used in this work here. Please capitalize only the first word. Examples: Oil on canvas; Silk and muslin; Carte-de-visite photograph',
			),
			'dimensions_cm' => array(
				'label'           => esc_html__( 'Dimensions (cm)', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => 'Enter the dimensions of the work in centimeters (height x width). Please include a space between the numbers and the lower case x between them. Remember to include cm at the end. No period after cm. Example: 127 x 181.5 cm',
			),
			'dimensions_inch' => array(
				'label'           => esc_html__( 'Dimensions (inches)', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => 'Enter the dimensions of the work in inches (height x width). Please include a space between the numbers and the lower case x between them. Remember to include in at the end. No period after in. Example: 50 x 36 in',
			),
			'museum_collection' => array(
				'label'           => esc_html__( 'Museum/Collection', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter the official name of the museum or collection that owns this work here. If the owner is unknown, enter Private Collection. Please capitalize. Examples: The Metropolitan Museum of Art; Museum of Modern Art; Private Collection', 'et_builder' ),
			),
			'museum_collection_city' => array(
				'label'           => esc_html__( 'Museum/Collection City', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter the location (city) of the museum or collection. If in a Private Collection, leave blank. Please capitalize. Examples: New York; Paris; London', 'et_builder' ),
			),
			'accession_number' => array(
				'label'           => esc_html__( 'Accession Number', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter the museum’s accession number here, if available. This number is unique to each work and reveals when a work entered a museum’s collection. Examples:  16.53; 2004.86; RF 3760', 'et_builder' ),
			),
			'credit_line' => array(
				'label'           => esc_html__( 'Credit Line', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => 'Enter the official museum credit line here, if available. This thanks the donor or fund that made the acquisition possible. Examples: Arthur Hoppock Hearn Fund, 1916; Gift of Mrs. Francis Ormond; Gift of the Brooklyn Museum, 2009',
			),
			'image_source' => array(
				'label'           => esc_html__( 'Image Source Name*', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => 'THIS IS A REQUIRED FIELD. Enter the name of the website where you found this image. Please capitalize. If you created this image yourself, enter your name or Author, if you are the author of the page it appears on. Examples: The Metropolitan Museum of Art; Wikimedia; Pinterest; Google Books; Author; FIT Student Name',
			),
			'url' => array(
				'label'           => esc_html__( 'Image Source URL*', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => 'THIS IS A REQUIRED FIELD. Enter the URL of the website page where you found the image. Please use the Permalink for a museum webpage, when available. If you created this image, link to your professional website.  Be sure to include http:// or https:// before the rest of the URL. Examples: https://commons.wikimedia.org/wiki/File:Mme_Louis_Singer,_née_Thérèse_Stern.jpg; https://www.metmuseum.org/art/collection/search/12127',
			),
			
			'admin_label' => array(
				'label'       => esc_html__( 'Admin Label', 'et_builder' ),
				'type'        => 'text',
				'description' => esc_html__( 'THIS IS A REQUIRED FIELD. Enter the Figure # and a short description for this image (artist name, or title). Examples: Fig. 1 - Manet; Fig. 2 - Luncheon on the Grass', 'et_builder' ),
				'toggle_slug' => 'admin_label',
			),
		);

		return $fields;
	}

	function render( $atts, $content = null, $render_slug ) {
		$src					= $this->props['src'];
		$fig_number				= trim($this->props['fig_number']);
		$artist_name			= trim($this->props['artist_name']);
		$nationality			= trim($this->props['nationality']);
		$life_dates				= trim($this->props['life_dates']);
		$title_description		= trim($this->props['title_description']);
		$date_season			= trim($this->props['date_season']);
		$medium_materials		= ucfirst(strtolower(trim($this->props['medium_materials'])));
		$dimensions_cm			= strtolower(trim($this->props['dimensions_cm']));
		$dimensions_inch		= strtolower(trim($this->props['dimensions_inch']));
		$museum_collection      = trim($this->props['museum_collection']);
		$museum_collection_city = trim($this->props['museum_collection_city']);
		$accession_number       = trim($this->props['accession_number']);
		$credit_line			= trim($this->props['credit_line']);
		$image_source			= $this->props['image_source'];
		$url                    = $this->props['url'];

		// Create the linked image content
		$output = sprintf(
			'<img src="%1$s" alt="%2$s"%3$s />',
			esc_url( $src ),
			esc_attr( $title_description ),
			( '' !== $title_description ? sprintf( ' title="%1$s"', esc_attr( $title_description ) ) : '' )
		);

		if ( '' !== $url ) {
			$output = sprintf( '<a href="%1$s"%3$s>%2$s</a>',
				esc_url( $url ),
				$output,
				' target="_blank"'
			);
		}

		$this->add_classname( 'et_pb_image' );
		$this->add_classname( 'et_always_center_on_mobile' );

		$output = sprintf(
			'<div%3$s class="%2$s">
				%1$s
			</div>',
			$output,
			$this->module_classname( $render_slug ),
			$this->module_id()
		);
		
		// Begin creating the caption content
		$output = sprintf('%1$s<div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left"><p class="fit-image-caption">', $output);

		// Fig number
		if ( '' !== $fig_number ) {
			$fig_number = preg_replace('/\D/', '', $fig_number);
			$output .= " Fig. $fig_number - ";
		}
		
		// Include artist name
		// #todo - required field
		$artist_name = str_ireplace('unknown', 'unknown', $artist_name);
		// Reverse names with commas
		if ( strstr($artist_name, ',') ) {
			// Split on comma, remove extra whitespace, reverse order, combine elements with spaces
			$artist_name = implode(' ', array_reverse(array_map('trim', explode(',', $artist_name))));
		}
		$output .= $artist_name;

		// Include nationality and dates, formatted depending on either or both being available
		if ( '' !== $nationality || '' !== $life_dates ) {
			$output .= ' (';
			
			if ( '' !== $nationality ) {
				$output .= $nationality;
			}
			
			if ( '' !== $life_dates ) {
				$output .= ('' != $nationality ? ', ' : '') . $life_dates;
			}
			
			$output .= ')';
		}
		
		// End of 1st 'sentence'
		$output .= '. ';
		
		// Add the title and date. This will be the end of the 2nd 'sentence'
		// #todo - both are required fields
		$output = sprintf('%3$s <em>%1$s</em>%2$s. ', 
						  $title_description,
						  ( '' !== $date_season ? ', ' . $date_season : '' ),
						  $output );
		
		// Construct 3rd 'sentence'. Make sure the artistic medium was filled in, we do not want to only show dimensions.
		if ( '' !== $medium_materials ) {
			$dimensions_unknown = 'dimensions unknown';
			$has_cm = '' !== $dimensions_cm && $dimensions_unknown !== $dimensions_cm;
			$has_in = '' !== $dimensions_inch && $dimensions_unknown !== $dimensions_inch;
			$has_any_dim = $has_cm || $has_in;
				
			// Artistic medium
			$output .= $medium_materials . ($has_any_dim ? '; ' : '');
			
			// Dimensions - centimeters
			if ( $has_cm ) {
				$dimensions_cm = str_replace('cm.', 'cm', $dimensions_cm);
				$dimensions_cm .= strstr($dimensions_cm, 'cm') ? '' : ' cm';
				$output .= $dimensions_cm;
			}
			
			// Dimensions - inches
			if ( $has_in ) {
				$dimensions_inch = str_replace('in.', 'in', $dimensions_inch);
				$dimensions_inch .= strstr($dimensions_inch, 'in') ? '' : ' in';
				$output .= ($has_cm ? ' ' : '') . "($dimensions_inch)";
			}
			
			// End of 3rd 'sentence'.
			$output .= '. ';
		}
		
		// Museum/collection city
		if ( '' !== $museum_collection_city ) {
			$museum_collection_city = str_ireplace('new york city', 'New York', $museum_collection_city);
			$output .= $museum_collection_city;
		}
		
		// Museum/collection
		if ( '' !== $museum_collection ) {
			$output = sprintf('%3$s%2$s%1$s',
							  $museum_collection, 
							  ( '' !== $museum_collection_city ? ': ' : '' ),
							  $output);
		}
		
		// Accession number
		if ( '' !== $accession_number ) {
			$output = sprintf('%3$s%2$s%1$s', 
							  $accession_number, 
							  ( '' !== $museum_collection_city || '' !== $museum_collection ? ', ' : '' ),
							  $output);
		}
		
		// End of 4th 'sentence'. Make sure at least one of these was filled in.
		if ( '' !== $museum_collection_city || '' !== $museum_collection || '' !== $accession_number ) {
			$output = sprintf('%1$s. ', $output);
		}
		
		// Source credit line
		if ( '' !== $credit_line ) {
			$output = sprintf('%2$s%1$s. ', 
							  $credit_line, 
							  $output);
		}
		
		// Image source name and URL
		#todo both are required fields
		$output = sprintf('%3$s Source: <a href="%2$s" target="_blank">%1$s</a>',
						$image_source,
						$url,
						$output);
		
		// Wrap it up
		$output = sprintf('%1$s</p></div>', $output);
		
		return $output;
	}
}
new ET_Builder_Module_Image_FIT;