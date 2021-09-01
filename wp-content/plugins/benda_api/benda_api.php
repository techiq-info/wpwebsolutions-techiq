<?php
/**
 * Plugin Name: Benda API
 * Plugin URI: https://epayworldwide.com
 * Description: Woocommrece based plugin for the digital products with licencing.
 * Version: 1.0
 * Author: M Coder
 * Author URI: https://epayworldwide.com
 */


/*function register_digital_product_type() {

    class WC_Product_package extends WC_Product {

        public $product_type = 'digital';
        public function __construct( $product ) {
            parent::__construct( $product );
        }
    }
}*/

function register_digital_product_type () {

	class WC_Product_Digital extends WC_Product {

		public function __construct( $product ) {
			$this->product_type = 'digital'; // name of your custom product type
			$this->supports[]   = 'ajax_add_to_cart';
			parent::__construct( $product );
			// add additional functions here
		}
    }
}

add_action( 'init', 'register_digital_product_type' );

class BendaApi{
	private $my_plugin_screen_name;
	private static $instance;
	private $templatePath = 'templates/';
	private $benda_api_table = 'benda_transactions';
	private $api_url = 'https://www.transact-online.de/up-interface';

	public function __construct(){
		$this->checkWooCommerce();
		/*$this->create_db_table();*/
		/*$this->register_digital_product_type();*/
		add_filter('product_type_selector', array($this, 'add_demo_product_type') );
		add_filter('woocommerce_product_data_tabs', array($this, 'dm_product_product_tab') );
		add_action('woocommerce_product_data_panels', array( $this, 'digital_add_custom_settings') );
		add_action('woocommerce_process_product_meta', array($this, 'save_digital_product_settings') );
		/*add_action('admin_footer', array( $this, 'pd_custom_product_admin_custom_js' ) );*/
		add_action( 'woocommerce_digital_add_to_cart', array($this, 'digital_product_front') );
		
		add_action( 'admin_init', array($this, 'benda_api_settings_init') );
		add_action( 'woocommerce_product_options_general_product_data', array($this, 'showGeneralTabs')  );
		
		add_action( 'admin_footer', array( $this, 'enable_js_on_wc_product' ) );
		add_action( 'woocommerce_thankyou', array( $this, 'digital_order_placed_success' ) ,10,1);
		
		if (is_admin()) {
			register_activation_hook(__FILE__, array( $this, 'activate'));
			register_deactivation_hook( __FILE__, array( $this, 'digital_remove_database' ) );	
		}
		
	}

	static function GetInstance()
	{
		if (!isset(self::$instance)){
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function activate(){
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();

		if($wpdb->get_var("show tables like '".$wpdb->prefix.$this->benda_api_table."'") != $wpdb->prefix.$this->benda_api_table) 
		{ 
			$sql = "CREATE TABLE " . $wpdb->prefix.$this->benda_api_table . " (
				`id` mediumint(9) NOT NULL AUTO_INCREMENT,
				`order_id` tinytext NOT NULL,
				`product_id` mediumint(9) NOT NULL,
				`transaction_code` tinytext NOT NULL,
				`quantity` varchar(20) NOT NULL,
				`amount` mediumint(9) NOT NULL,
				`order_date` datetime NOT NULL,
				`transaction_response` text NOT NULL,
				PRIMARY KEY (id)
				)$charset_collate;";
		 	
		 	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}
	}

	public function digital_remove_database() {
        global $wpdb;
        $table_name = $wpdb->prefix .$this->benda_api_table;
        $sql = "DROP TABLE IF EXISTS $table_name";
        $wpdb->query($sql);
    } 

	public function PluginMenu(){
		add_menu_page('Benda Api', 'Benda Api', 'manage_options', 'benda-api-ref', array($this, 'RenderPage'));
   		add_submenu_page('benda-api-ref', 'Logs', 'Logs', 'manage_options', 'benda_api_logs', array($this, 'logs'));
		add_submenu_page('benda-api-ref', 'Settings', 'Settings', 'manage_options', 'benda_api_settings', array($this, 'settings'));
	}

	function benda_api_settings_init() {
	    register_setting('benda_api_settings_fg', 'benda_api_uname');
        register_setting('benda_api_settings_fg', 'benda_api_pass');
        register_setting('benda_api_settings_fg', 'benda_api_terminal_id');
        register_setting('benda_api_settings_fg', 'benda_api_shop_id');
	}

	function dm_product_product_tab( $tabs) {
			
	    $tabs['digital'] = array(
	      'label'	 => __( 'Epay Settings', 'epay_settings' ),
	      'target' => 'digital_product_options',
	      'class'  => 'show_if_digital',
	    );
	    return $tabs;
	}

	function add_demo_product_type( $types ){
	    $types[ 'digital' ] = __( 'Digital product', 'benda_api' );
	    return $types;	
	}

	function digital_add_custom_settings(){
		global $woocommerce, $post;
		echo "<div id='digital_product_options' class='panel woocommerce_options_panel'>";
    	echo '<div class="options_group">';
		woocommerce_wp_text_input(
		array(
			'id'                => 'benda_product_ean',
			'label'             => __( 'מק"ט', 'benda_api' ),
			'placeholder'       => '',
			'desc_tip'    		=> 'true',
			'description'       => __( 'This is the skuEpay', 'benda_api' ),
			'type'              => 'text',
			'wrapper_class' 	=> 'show_if_digital',
		));
		echo '</div></div>';
	}

	public function showGeneralTabs(){
		echo '<div class="options_group show_if_advanced clear"></div>';
	}

	public function save_digital_product_settings( $post_id ) {
			
	    $digi_product_info = $_POST['benda_product_ean'];
			
	    if( !empty( $digi_product_info ) ) {
			update_post_meta( $post_id, 'benda_product_ean', esc_attr( $digi_product_info ) );
	    }
	}

	public function digital_product_front () {
	    global $product;

	    if ( 'digital' == $product->get_type() ) {  	
	 		do_action( 'woocommerce_before_add_to_cart_button' );
			do_action( 'woocommerce_simple_add_to_cart' );
			do_action( 'woocommerce_after_add_to_cart_button' );    
		}
	}

	public function settings(){
		$this->checkWooCommerce();
		$this->loadTemplate('settings');
	}

	public function logs(){
		$this->checkWooCommerce();
		$this->loadTemplate('logs');
	}

	public function InitPlugin()
	{
		add_action('admin_menu', array($this, 'PluginMenu'));
	}

	public function RenderPage(){ 
		$this->checkWooCommerce();
		?>
		<div class='wrap'>
		<h2>Benda API - Dashboard</h2>
		</div>
		<?php	
	}

	public function checkWooCommerce(){
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if (! is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			echo '<div class="error"><p><strong>Benda API requires WooCommerce to be installed and active. You can download <a href="https://woocommerce.com/" target="_blank">WooCommerce</a> here.</strong></p></div>';
			die();
		}
	}

	function loadTemplate($templateName = ''){
		if($templateName != ''){
			require_once($this->templatePath.$templateName.'.php');
		}
	}

	public function enable_js_on_wc_product() {
		global $post, $product_object;
		if ( ! $post ) { return; }
		if ( 'product' != $post->post_type ) :
			return;
		endif;
		?><script type='text/javascript'>
			jQuery( document ).ready( function() {
				jQuery( '.options_group.pricing' ).addClass( 'show_if_digital' ).show();
				jQuery('.inventory_options').addClass('show_if_digital').show();
			});
		</script>
		<?php
	}

	public function digital_order_placed_success($order_id) {
		global $wpdb;
		$currency = get_woocommerce_currency();
		$order = new WC_Order( $order_id );
    	$items = $order->get_items();
    	/*echo "<pre>";
    	print_r($items);
    	exit;*/
		foreach ( $items as $item_id => $item_data) {
			$data = array();
			$product_id = $item_data['product_id'];
	        $product = wc_get_product( $product_id );
			/*echo "<pre>";
			print_r($item_data);
			exit;*/
	        if ('digital' == $product->get_type()){
	        	$data['CURRENCY'] = $currency;
	        	$data['AMOUNT'] = $item_data->get_total();
	        	$data['RECEIPT']['LANGUAGE'] = $currency;
	        	$data['RECEIPT']['CHARSPERLINE'] = 44;
	        	$data['TYPE'] = 'SALE';
	        	$data['AUTHORIZATION']['USERNAME'] = get_option('benda_api_uname');
	        	$data['AUTHORIZATION']['PASSWORD'] = get_option('benda_api_pass');
	        	$data['TERMINALID'] = get_option('benda_api_terminal_id');
	        	$data['SHOPID'] = get_option('benda_api_shop_id');
	        	$data['TXID'] = $order_id;
	        	$data['LOCALDATETIME'] = date('Y-m-d h:i:s');
	        	$data['CARD']['EAN'] = get_post_meta($product_id, 'benda_product_ean', true);
	        	$url = $this->api_url;
				$result = json_decode($this->request($url, $data));
				if($result->RESULT == '0'){
					$sql = $wpdb->prepare(
					"INSERT INTO ".$wpdb->prefix.$this->benda_api_table." (
				 		order_id,
				 		product_id,
				 		transaction_code,
				 		quantity,
				 		amount,
				 		order_date,
				 		transaction_response
				 	) values (
				 		'".$order_id."',
				 		'".$product_id."',
				 		'".$result->HOSTTXID."',
				 		'".$item_data->get_quantity()."',
				 		'".$result->AMOUNT."',
				 		'".$result->LOCALDATETIME."',
				 		'".serialize($result)."'
				 	)");
					$sqlres = $wpdb->query($sql);
				}
	        }
	    }
	}

	function request($url, $data){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => json_encode($data),
		  CURLOPT_HTTPHEADER => array(
		    "Content-Type: application/json",
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		if ($err) {
		  return "cURL Error #:" . $err;
		} else {
		  return $response;
		}
	}
}
 
$BendaApi = BendaApi::GetInstance();
$BendaApi->InitPlugin();