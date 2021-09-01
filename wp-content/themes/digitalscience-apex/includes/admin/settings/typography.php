<?php

/* --------------------------------------------------------- */
/* !Settings setup - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_typography_settings_setup') ) {
function apex_typography_settings_setup() {

	$settings = apex_typography_settings();


	/* --------------------------------------------------------- */
	/* !Add the setting sections - 1.0.0 */
	/* --------------------------------------------------------- */

	$sub = isset( $_GET['sub'] ) ? $_GET['sub'] : 'all';

	if( $sub == 'generic' || $sub == 'all' ) {
		add_settings_section( 'apex_generic_typography_settings_section', __( 'Generic typography settings', 'apex' ).'<input type="submit" class="button button-primary" value="'.__('Save Changes', 'apex').'">', false, 'apex_typography_settings' );
	}
	if( $sub == 'class' || $sub == 'all' ) {
		add_settings_section( 'apex_class_typography_settings_section', __( 'Class typography settings', 'apex' ).'<input type="submit" class="button button-primary" value="'.__('Save Changes', 'apex').'">', false, 'apex_typography_settings' );
	}


	/* --------------------------------------------------------- */
	/* !Add the style settings - 1.0.0 */
	/* --------------------------------------------------------- */

	/* Base font */
	$title = apex_settings_label( __( 'Base', 'apex' ), __('Set the style of the base font', 'apex') );
	add_settings_field( 'apex_typography_settings_base', $title, 'apex_typography_settings_render', 'apex_typography_settings', 'apex_generic_typography_settings_section', array('field' => 'body', 'settings' => $settings) );

	/* H1 font */
	$title = apex_settings_label( __( 'Header 1', 'apex' ), __('Set the style of the h1 elements', 'apex') );
	add_settings_field( 'apex_typography_settings_h1', $title, 'apex_typography_settings_render', 'apex_typography_settings', 'apex_generic_typography_settings_section', array('field' => 'h1', 'settings' => $settings) );

	/* H2 font */
	$title = apex_settings_label( __( 'Header 2', 'apex' ), __('Set the style of the h2 elements', 'apex') );
	add_settings_field( 'apex_typography_settings_h2', $title, 'apex_typography_settings_render', 'apex_typography_settings', 'apex_generic_typography_settings_section', array('field' => 'h2', 'settings' => $settings) );

	/* H3 font */
	$title = apex_settings_label( __( 'Header 3', 'apex' ), __('Set the style of the h3 elements', 'apex') );
	add_settings_field( 'apex_typography_settings_h3', $title, 'apex_typography_settings_render', 'apex_typography_settings', 'apex_generic_typography_settings_section', array('field' => 'h3', 'settings' => $settings) );

	/* H4 font */
	$title = apex_settings_label( __( 'Header 4', 'apex' ), __('Set the style of the h4 elements', 'apex') );
	add_settings_field( 'apex_typography_settings_h4', $title, 'apex_typography_settings_render', 'apex_typography_settings', 'apex_generic_typography_settings_section', array('field' => 'h4', 'settings' => $settings) );

	/* H5 font */
	$title = apex_settings_label( __( 'Header 5', 'apex' ), __('Set the style of the h5 elements', 'apex') );
	add_settings_field( 'apex_typography_settings_h5', $title, 'apex_typography_settings_render', 'apex_typography_settings', 'apex_generic_typography_settings_section', array('field' => 'h5', 'settings' => $settings) );

	/* H6 font */
	$title = apex_settings_label( __( 'Header 6', 'apex' ), __('Set the style of the h6 elements', 'apex') );
	add_settings_field( 'apex_typography_settings_h6', $title, 'apex_typography_settings_render', 'apex_typography_settings', 'apex_generic_typography_settings_section', array('field' => 'h6', 'settings' => $settings) );

	/* Section title */
	$title = apex_settings_label( __( 'Section title', 'apex' ), __('Set the style of the .section-title elements', 'apex') );
	add_settings_field( 'apex_typography_settings_section_title', $title, 'apex_typography_settings_render', 'apex_typography_settings', 'apex_class_typography_settings_section', array('field' => 'section_title', 'settings' => $settings) );

	/* Section tagline */
	$title = apex_settings_label( __( 'Section tagline', 'apex' ), __('Set the style of the .section-tagline elements', 'apex') );
	add_settings_field( 'apex_typography_settings_section_tagline', $title, 'apex_typography_settings_render', 'apex_typography_settings', 'apex_class_typography_settings_section', array('field' => 'section_tagline', 'settings' => $settings) );


	/* --------------------------------------------------------- */
	/* !Register the settings - 1.0.0 */
	/* --------------------------------------------------------- */

	if( false == get_option('apex_typography_settings') ) {
		add_option( 'apex_typography_settings' );
	}
	register_setting( 'apex_typography_settings', 'apex_typography_settings', 'apex_typography_settings_sanitize' );
}
}


/* --------------------------------------------------------- */
/* !Typography display - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_typography_settings_render') ) {
function apex_typography_settings_render( $args ) {

	$field = $args['field'];
	$settings = $args['settings'];
	$enabled = ( isset($settings[$field]['enabled']) && $settings[$field]['enabled'] == 'on'  ) ? 'on' : false;

	echo '<div id="apex_typography_settings_'.$field.'" class="apex-typography-settings-render">';
		echo '<input type="hidden" name="apex_typography_settings['.$field.'][element]" value="'.$settings[$field]['element'].'" />';
		echo '<table>';
			echo '<tr>';
				echo '<th class="apex-typography-settings-enable"></th>';
				echo '<th>'.__('Font Size', 'apex').'</th>';
				echo '<th>'.__('Line Height', 'apex').'</th>';
				echo '<th>'.__('Font Family', 'apex').'</th>';
				echo '<th>'.__('Font Weight', 'apex').'</th>';
				echo '<th>'.__('Font Style', 'apex').'</th>';
				echo '<th>'.__('Color', 'apex').'</th>';
				echo '<th></th>';
			echo '</tr>';
			echo '<tr>';
				echo '<td class="apex-typography-settings-enable"><input name="apex_typography_settings['.$field.'][enabled]" type="checkbox" value="on" '.checked( 'on', $enabled, false ).' /></td>';
				echo '<td class="apex-typography-settings-size-px"><select name="apex_typography_settings['.$field.'][size_px]">'.apex_typography_settings_font_px_options($settings[$field]['size_px']).'</select></td>';
				echo '<td class="apex-typography-settings-height-px"><select name="apex_typography_settings['.$field.'][height_px]">'.apex_typography_settings_font_px_options($settings[$field]['height_px']).'</select></td>';
				echo '<td class="apex-typography-settings-font-family"><select name="apex_typography_settings['.$field.'][font_family]">'.apex_typography_settings_font_family_options($settings[$field]['font_family']).'</select></td>';
				echo '<td class="apex-typography-settings-font-weight"><select name="apex_typography_settings['.$field.'][font_weight]">'.apex_typography_settings_font_weight_options($settings[$field]['font_weight']).'</select></td>';
				echo '<td class="apex-typography-settings-font-style"><select name="apex_typography_settings['.$field.'][font_style]">'.apex_typography_settings_font_style_options($settings[$field]['font_style']).'</select></td>';
				echo '<td class="apex-typography-settings-color apex-minicolors"><input name="apex_typography_settings['.$field.'][color]" value="'.$settings[$field]['color'].'" type="text" /></td>';
				echo '<td class="apex-typography-settings-reset"><a href="#'.$field.'"><i class="apex-icon-undo-2"></i></a></td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td></td>';
				echo '<td class="apex-typography-settings-preview" colspan="7"'.(($enabled != 'on') ? ' style="display:none;"' : '').'><textarea name="apex_typography_settings['.$field.'][preview]">'.$settings[$field]['preview'].'</textarea></td>';
				echo '<td></td>';
			echo '</tr>';
		echo '</table>';
	echo '</div>';
}
}


/* --------------------------------------------------------- */
/* !Typography helpers - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_typography_settings_font_px_options') ) {
function apex_typography_settings_font_px_options( $value ) {
	$html = '';
	for( $i=3; $i<101; $i++ ) {
		$html .= '<option '.selected($i, $value, false).'>'.$i.'</option>';
	}
	return $html;
}
}
if( !function_exists('apex_typography_settings_font_em_options') ) {
function apex_typography_settings_font_em_options( $value ) {
	$html = '';
	for( $i=3; $i<100; $i++ ) {
		$unit = $i/10;
		$html .= '<option '.selected($unit, $value, false).'>'.$unit.'</option>';
	}
	return $html;
}
}
if( !function_exists('apex_typography_settings_font_size_unit_options') ) {
function apex_typography_settings_font_size_unit_options( $value ) {
	$html = '';
	$units = array('px','em');
	foreach( $units as $unit ) {
		$html .= '<option '.selected($unit, $value, false).'>'.$unit.'</option>';
	}
	return $html;
}
}
if( !function_exists('apex_typography_settings_font_family_options') ) {
function apex_typography_settings_font_family_options( $value ) {
	$fonts = array(
		'Arial, sans-serif' => 'Arial',
		'Verdana, Geneva, sans-serif' => 'Verdana',
		'\'Trebuchet MS\', Tahoma, sans-serif' => 'Trebuchet',
		'Georgia, serif' => 'Georgia',
		'\'Times New Roman\', serif' => 'Times New Roman',
		'Tahoma, Geneva, Verdana, sans-serif' => 'Tahoma',
		'Palatino, \'Palatino Linotype\', serif' => 'Palatino',
		'\'Helvetica Neue\', Helvetica, sans-serif' => 'Helvetica',
		'Calibri, Candara, Segoe, Optima, sans-serif' => 'Calibri',
		'\'Myriad Pro\', Myriad, sans-serif' => 'Myriad Pro',
		'\'Lucida Grande\', \'Lucida Sans Unicode\', \'Lucida Sans\', sans-serif' => 'Lucida',
		'\'Arial Black\', sans-serif' => 'Arial Black',
		'\'Gill Sans\', \'Gill Sans MT\', Calibri, sans-serif' => 'Gill Sans',
		'Geneva, Tahoma, Verdana, sans-serif' => 'Geneva',
		'Impact, Charcoal, sans-serif' => 'Impact',
		'Courier, \'Courier New\', monospace' => 'Courier',
		'\'Century Gothic\', sans-serif' => 'Century Gothic',
		'' => '-- Google Fonts --',
		'Abel' => 'Abel',
		'Abril Fatface' => 'Abril Fatface',
		'Aclonica' => 'Aclonica',
		'Actor' => 'Actor',
		'Adamina' => 'Adamina',
		'Aldrich' => 'Aldrich',
		'Alice' => 'Alice',
		'Alike' => 'Alike',
		'Alike Angular' => 'Alike Angular',
		'Allan' => 'Allan',
		'Allerta' => 'Allerta',
		'Allerta Stencil' => 'Allerta Stencil',
		'Amaranth' => 'Amaranth',
		'Amatic SC' => 'Amatic SC',
		'Andada' => 'Andada',
		'Andika' => 'Andika',
		'Annie Use Your Telescope' => 'Annie Use Your Telescope',
		'Anonymous Pro' => 'Anonymous Pro',
		'Antic' => 'Antic',
		'Anton' => 'Anton',
		'Arapey' => 'Arapey',
		'Architects Daughter' => 'Architects Daughter',
		'Arimo' => 'Arimo',
		'Artifika' => 'Artifika',
		'Arvo' => 'Arvo',
		'Asap' => 'Asap',
		'Asset' => 'Asset',
		'Astloch' => 'Astloch',
		'Atomic Age' => 'Atomic Age',
		'Aubrey' => 'Aubrey',
		'Bangers' => 'Bangers',
		'Bentham' => 'Bentham',
		'Bevan' => 'Bevan',
		'Bigshot One' => 'Bigshot One',
		'Bitter' => 'Bitter',
		'Black Ops One' => 'Black Ops One',
		'Bowlby One' => 'Bowlby One',
		'Bowlby One SC' => 'Bowlby One SC',
		'Brawler' => 'Brawler',
		'Bree Serif' => 'Bree Serif',
		'Buda' => 'Buda',
		'Butcherman Caps' => 'Butcherman Caps',
		'Cabin' => 'Cabin',
		'Cabin Condensed' => 'Cabin Condensed',
		'Cabin Sketch' => 'Cabin Sketch',
		'Calligraffitti' => 'Calligraffitti',
		'Candal' => 'Candal',
		'Cantarell' => 'Cantarell',
		'Cardo' => 'Cardo',
		'Carme' => 'Carme',
		'Carter One' => 'Carter One',
		'Caudex' => 'Caudex',
		'Cedarville Cursive' => 'Cedarville Cursive',
		'Changa One' => 'Changa One',
		'Cherry Cream Soda' => 'Cherry Cream Soda',
		'Chewy' => 'Chewy',
		'Chivo' => 'Chivo',
		'Coda' => 'Coda',
		'Coda' => 'Coda',
		'Comfortaa' => 'Comfortaa',
		'Coming Soon' => 'Coming Soon',
		'Contrail One' => 'Contrail One',
		'Convergence' => 'Convergence',
		'Copse' => 'Copse',
		'Corben' => 'Corben',
		'Corben' => 'Corben',
		'Cousine' => 'Cousine',
		'Coustard' => 'Coustard',
		'Covered By Your Grace' => 'Covered By Your Grace',
		'Crafty Girls' => 'Crafty Girls',
		'Creepster Caps' => 'Creepster Caps',
		'Crimson Text' => 'Crimson Text',
		'Crushed' => 'Crushed',
		'Cuprum' => 'Cuprum',
		'Cutive' => 'Cutive',
		'Damion' => 'Damion',
		'Dancing Script' => 'Dancing Script',
		'Dawning of a New Day' => 'Dawning of a New Day',
		'Days One' => 'Days One',
		'Delius' => 'Delius',
		'Delius Swash Caps' => 'Delius Swash Caps',
		'Delius Unicase' => 'Delius Unicase',
		'Didact Gothic' => 'Didact Gothic',
		'Dorsa' => 'Dorsa',
		'Droid Sans' => 'Droid Sans',
		'Droid Sans Mono' => 'Droid Sans Mono',
		'Droid Serif' => 'Droid Serif',
		'EB Garamond' => 'EB Garamond',
		'Eater Caps' => 'Eater Caps',
		'Expletus Sans' => 'Expletus Sans',
		'Fanwood Text' => 'Fanwood Text',
		'Federant' => 'Federant',
		'Federo' => 'Federo',
		'Fjord One' => 'Fjord One',
		'Fontdiner Swanky' => 'Fontdiner Swanky',
		'Forum' => 'Forum',
		'Francois One' => 'Francois One',
		'Gentium Book Basic' => 'Gentium Book Basic',
		'Geo' => 'Geo',
		'Geostar' => 'Geostar',
		'Geostar Fill' => 'Geostar Fill',
		'Give You Glory' => 'Give You Glory',
		'Gloria Hallelujah' => 'Gloria Hallelujah',
		'Goblin One' => 'Goblin One',
		'Gochi Hand' => 'Gochi Hand',
		'Goudy Bookletter 1911' => 'Goudy Bookletter 1911',
		'Gravitas One' => 'Gravitas One',
		'Gruppo' => 'Gruppo',
		'Hammersmith One' => 'Hammersmith One',
		'Holtwood One SC' => 'Holtwood One SC',
		'Homemade Apple' => 'Homemade Apple',
		'IM Fell DW Pica' => 'IM Fell DW Pica',
		'IM Fell English' => 'IM Fell English',
		'IM Fell English SC' => 'IM Fell English SC',
		'Inconsolata' => 'Inconsolata',
		'Indie Flower' => 'Indie Flower',
		'Irish Grover' => 'Irish Grover',
		'Irish Growler' => 'Irish Growler',
		'Istok Web' => 'Istok Web',
		'Jockey One' => 'Jockey One',
		'Josefin Sans' => 'Josefin Sans',
		'Josefin Slab' => 'Josefin Slab',
		'Judson' => 'Judson',
		'Julee' => 'Julee',
		'Jura' => 'Jura',
		'Just Another Hand' => 'Just Another Hand',
		'Just Me Again Down Here' => 'Just Me Again Down Here',
		'Kameron' => 'Kameron',
		'Karla' => 'Karla',
		'Kelly Slab' => 'Kelly Slab',
		'Kenia' => 'Kenia',
		'Kranky' => 'Kranky',
		'Kreon' => 'Kreon',
		'Kristi' => 'Kristi',
		'La Belle Aurore' => 'La Belle Aurore',
		'Lancelot' => 'Lancelot',
		'Lato' => 'Lato',
		'League Script' => 'League Script',
		'Leckerli One' => 'Leckerli One',
		'Lekton' => 'Lekton',
		'Limelight' => 'Limelight',
		'Linden Hill' => 'Linden Hill',
		'Lobster' => 'Lobster',
		'Lobster Two' => 'Lobster Two',
		'Lora' => 'Lora',
		'Love Ya Like A Sister' => 'Love Ya Like A Sister',
		'Loved by the King' => 'Loved by the King',
		'Luckiest Guy' => 'Luckiest Guy',
		'Maiden Orange' => 'Maiden Orange',
		'Mako' => 'Mako',
		'Marck Script' => 'Marck Script',
		'Marvel' => 'Marvel',
		'Mate' => 'Mate',
		'Mate SC' => 'Mate SC',
		'Maven Pro' => 'Maven Pro',
		'Meddon' => 'Meddon',
		'MedievalSharp' => 'MedievalSharp',
		'Megrim' => 'Megrim',
		'Merienda One' => 'Merienda One',
		'Merriweather' => 'Merriweather',
		'Metrophobic' => 'Metrophobic',
		'Michroma' => 'Michroma',
		'Miltonian' => 'Miltonian',
		'Miltonian Tattoo' => 'Miltonian Tattoo',
		'Modern Antiqua' => 'Modern Antiqua',
		'Molengo' => 'Molengo',
		'Monofett' => 'Monofett',
		'Monoton' => 'Monoton',
		'Montez' => 'Montez',
		'Mountains of Christmas' => 'Mountains of Christmas',
		'Muli' => 'Muli',
		'Neucha' => 'Neucha',
		'Neuton' => 'Neuton',
		'News Cycle' => 'News Cycle',
		'Nixie One' => 'Nixie One',
		'Nobile' => 'Nobile',
		'Nosifer Caps' => 'Nosifer Caps',
		'Nova Cut' => 'Nova Cut',
		'Nova Flat' => 'Nova Flat',
		'Nova Mono' => 'Nova Mono',
		'Nova Oval' => 'Nova Oval',
		'Nova Round' => 'Nova Round',
		'Nova Script' => 'Nova Script',
		'Nova Slim' => 'Nova Slim',
		'Numans' => 'Numans',
		'Nunito' => 'Nunito',
		'OFL Sorts Mill Goudy TT' => 'OFL Sorts Mill Goudy TT',
		'Old Standard TT' => 'Old Standard TT',
		'Open Sans' => 'Open Sans',
		'Open Sans Condensed' => 'Open Sans Condensed',
		'Orbitron' => 'Orbitron',
		'Oswald' => 'Oswald',
		'Over the Rainbow' => 'Over the Rainbow',
		'Ovo' => 'Ovo',
		'PT Sans' => 'PT Sans',
		'PT Sans Caption' => 'PT Sans Caption',
		'PT Sans Narrow' => 'PT Sans Narrow',
		'PT Serif' => 'PT Serif',
		'PT Serif Caption' => 'PT Serif Caption',
		'Pacifico' => 'Pacifico',
		'Passero One' => 'Passero One',
		'Patrick Hand' => 'Patrick Hand',
		'Paytone One' => 'Paytone One',
		'Permanent Marker' => 'Permanent Marker',
		'Petrona' => 'Petrona',
		'Philosopher' => 'Philosopher',
		'Pinyon Script' => 'Pinyon Script',
		'Play' => 'Play',
		'Playfair Display' => 'Playfair Display',
		'Podkova' => 'Podkova',
		'Poller One' => 'Poller One',
		'Poly' => 'Poly',
		'Pompiere' => 'Pompiere',
		'Prata' => 'Prata',
		'Prociono' => 'Prociono',
		'Puritan' => 'Puritan',
		'Quattrocento' => 'Quattrocento',
		'Quattrocento Sans' => 'Quattrocento Sans',
		'Questrial' => 'Questrial',
		'Quicksand' => 'Quicksand',
		'Radley' => 'Radley',
		'Raleway' => 'Raleway',
		'Rametto One' => 'Rametto One',
		'Rancho' => 'Rancho',
		'Rationale' => 'Rationale',
		'Redressed' => 'Redressed',
		'Reenie Beanie' => 'Reenie Beanie',
		'Rochester' => 'Rochester',
		'Rock Salt' => 'Rock Salt',
		'Rokkitt' => 'Rokkitt',
		'Rosario' => 'Rosario',
		'Ruslan Display' => 'Ruslan Display',
		'Salsa' => 'Salsa',
		'Sancreek' => 'Sancreek',
		'Sansita One' => 'Sansita One',
		'Satisfy' => 'Satisfy',
		'Schoolbell' => 'Schoolbell',
		'Shadows Into Light' => 'Shadows Into Light',
		'Shanti' => 'Shanti',
		'Short Stack' => 'Short Stack',
		'Sigmar One' => 'Sigmar One',
		'Six Caps' => 'Six Caps',
		'Slackey' => 'Slackey',
		'Smokum' => 'Smokum',
		'Smythe' => 'Smythe',
		'Sniglet' => 'Sniglet',
		'Snippet' => 'Snippet',
		'Sorts Mill Goudy' => 'Sorts Mill Goudy',
		'Special Elite' => 'Special Elite',
		'Spinnaker' => 'Spinnaker',
		'Stardos Stencil' => 'Stardos Stencil',
		'Sue Ellen Francisco' => 'Sue Ellen Francisco',
		'Sunshiney' => 'Sunshiney',
		'Supermercado One' => 'Supermercado One',
		'Swanky and Moo Moo' => 'Swanky and Moo Moo',
		'Syncopate' => 'Syncopate',
		'Tangerine' => 'Tangerine',
		'Tenor Sans' => 'Tenor Sans',
		'Terminal Dosis' => 'Terminal Dosis',
		'Terminal Dosis Light' => 'Terminal Dosis Light',
		'The Girl Next Door' => 'The Girl Next Door',
		'Tienne' => 'Tienne',
		'Tinos' => 'Tinos',
		'Tulpen One' => 'Tulpen One',
		'Ubuntu' => 'Ubuntu',
		'Ubuntu Condensed' => 'Ubuntu Condensed',
		'Ubuntu Mono' => 'Ubuntu Mono',
		'Ultra' => 'Ultra',
		'UnifrakturCook' => 'UnifrakturCook',
		'UnifrakturMaguntia' => 'UnifrakturMaguntia',
		'Unkempt' => 'Unkempt',
		'Unna' => 'Unna',
		'VT323' => 'VT323',
		'Varela' => 'Varela',
		'Varela Round' => 'Varela Round',
		'Vast Shadow' => 'Vast Shadow',
		'Vibur' => 'Vibur',
		'Vidaloka' => 'Vidaloka',
		'Volkhov' => 'Volkhov',
		'Vollkorn' => 'Vollkorn',
		'Voltaire' => 'Voltaire',
		'Waiting for the Sunrise' => 'Waiting for the Sunrise',
		'Wallpoet' => 'Wallpoet',
		'Walter Turncoat' => 'Walter Turncoat',
		'Wire One' => 'Wire One',
		'Yanone Kaffeesatz' => 'Yanone Kaffeesatz',
		'Yellowtail' => 'Yellowtail',
		'Yeseva One' => 'Yeseva One',
		'Zeyada' => 'Zeyada'
	);
	$html = '';
	foreach( $fonts as $i => $font ) {
		$html .= '<option value="'.$i.'" '.selected($i, $value, false).'>'.$font.'</option>';
	}
	return $html;
}
}
if( !function_exists('apex_typography_settings_font_weight_options') ) {
function apex_typography_settings_font_weight_options( $value ) {
	$weights = array(
		'100' => '100',
		'200' => '200',
		'300' => '300',
		'400' => '400',
		'500' => '500',
		'600' => '600',
		'700' => '700',
		'800' => '800',
		'900' => '900',
		'bold' => 'Bold',
		'bolder' => 'Bolder',
		'inherit' => 'Inherit',
		'lighter' => 'Lighter',
		'normal' => 'Normal'
	);
	$html = '';
	foreach( $weights as $i => $weight ) {
		$html .= '<option value="'.$i.'" '.selected($i, $value, false).'>'.$weight.'</option>';
	}
	return $html;
}
}
if( !function_exists('apex_typography_settings_font_style_options') ) {
function apex_typography_settings_font_style_options( $value ) {
	$styles = array(
		'inherit' => 'Inherit',
		'italic' => 'Italic',
		'normal' => 'Normal',
		'oblique' => 'Oblique'
	);
	$html = '';
	foreach( $styles as $i => $style ) {
		$html .= '<option value="'.$i.'" '.selected($i, $value, false).'>'.$style.'</option>';
	}
	return $html;
}
}



/* --------------------------------------------------------- */
/* !Sanitize the setting fields - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_typography_settings_sanitize') ) {
function apex_typography_settings_sanitize( $fields ) {

	$defaults = apex_typography_settings_defaults();

	foreach( $fields as $key => $field ) {
		$fields[$key]['element'] = ( isset($field['element']) && $field['element'] != '' ) ? sanitize_text_field($field['element']) : $defaults[$key]['element'];
		$fields[$key]['enabled'] = ( isset($field['enabled']) && $field['enabled'] == 'on' ) ? $field['enabled'] : $defaults[$key]['enabled'];
		$fields[$key]['size_px'] = ( isset($field['size_px']) && $field['size_px'] != '' ) ? $field['size_px'] : $defaults[$key]['size_px'];
		$fields[$key]['height_px'] = ( isset($field['height_px']) && $field['height_px'] != '' ) ? $field['height_px'] : $defaults[$key]['height_px'];
		$fields[$key]['font_family'] = ( isset($field['font_family']) && $field['font_family'] != '' ) ? $field['font_family'] : $defaults[$key]['font_family'];
		$fields[$key]['font_weight'] = ( isset($field['font_weight']) && $field['font_weight'] != '' ) ? $field['font_weight'] : $defaults[$key]['font_weight'];
		$fields[$key]['font_style'] = ( isset($field['font_style']) && $field['font_style'] != '' ) ? $field['font_style'] : $defaults[$key]['font_style'];
		$fields[$key]['color'] = ( isset($field['color']) && $field['color'] != '' ) ? sanitize_text_field($field['color']) : $defaults[$key]['color'];
		$fields[$key]['preview'] = ( isset($field['preview']) && $field['preview'] != '' ) ? sanitize_text_field($field['preview']) : $defaults[$key]['preview'];
	}

	return wp_parse_args( $fields, get_option('apex_typography_settings', array()) );
}
}
