<?php



include('../wordpress_env.php');

if (the_awe_des_check_is_admin_w()) {

?>
<html><head>
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1">
<meta http-equiv="Content-Language" content="fr"> 
<meta http-equiv="imagetoolbar" content="no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link href='https://fonts.googleapis.com/css?family=News+Cycle' rel='stylesheet' type='text/css'>
<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>

<link type="text/css" rel="stylesheet" href="<?php echo $url_dossier_awesome;?>files/css/admin.css">

</head>
<body topmargin="0">
<!-- header --> 
<?php include('./module-header.php'); ?>

<!-- contenu --> 
<!-- 
<div class="menu">
	<div class="icone left1 bloc">
		<div class="bloc_div top" style="width:50px;">
			<img src="<?php echo $url_dossier_awesome;?>files/img/interface-admin/admin_acc_account.png" width="50" height="50">
		</div>
		<div class="bloc_div">
			<p class="txt">Your Account</p>
		</div>
	</div>

	<div class="icone right1 bloc">
		<div class="bloc_div top" style="width:50px;">
			<img src="<?php echo $url_dossier_awesome;?>files/img/interface-admin/admin_acc_modify_product.png" width="50" height="50">
		</div>
		<div class="bloc_div">
			<p class="txt">Create a Template </br><span class="txt-ital">Coming soon!</span> </p>
		</div>
	</div>	
	<div style="clear:both"></div>
</div>	
<!-- nouveau produit --> 
<div class="menu">	
	<div class="icone left1 bloc">
		<div class="bloc_div top" style="width:50px;">
			<a href="./module-creation.php"><img src="<?php echo $url_dossier_awesome;?>files/img/interface-admin/admin_acc_create_product.png" width="50" height="50"></a>
		</div>
		<div class="bloc_div">
			<a  style="text-decoration:none" href="./module-creation.php"><p class="txt"><?php _e('Create New Product','woocommerce-awesome-designer');?></p></a>
		</div>
	</div>
<!-- modifier produit --> 	
	<div class="icone right1 bloc">
		<div class="bloc_div top" style="width:50px;">
			<a  style="text-decoration:none" href="./module-modif.php"><img src="<?php echo $url_dossier_awesome;?>files/img/interface-admin/admin_acc_modify_product.png" width="50" height="50"></a>
		</div>
		<div class="bloc_div">
			<a  style="text-decoration:none" href="./module-modif.php"><p class="txt"><?php _e('Edit Existing Product','woocommerce-awesome-designer');?></p></a>
		</div>
	</div>	
	<div style="clear:both"></div>
</div>
<!-- cliparts --> 
<div class="menu">	
	<div class="icone left1 bloc">
		<div class="bloc_div top" style="width:50px;">
			<a href="./module-clipart.php"><img src="<?php echo $url_dossier_awesome;?>files/img/interface-admin/admin_acc_manage_cliparts.png" width="50" height="50"></a>
		</div>
		<div class="bloc_div">
			<a  style="text-decoration:none" href="./module-clipart.php"><p class="txt"><?php _e('Manage Cliparts','woocommerce-awesome-designer');?></p></a>
		</div>
	</div>	
<!-- polices --> 	
	<div class="icone right1 bloc">
		<div class="bloc_div top" style="width:50px;">
			<a href="./module-font.php"><img src="<?php echo $url_dossier_awesome;?>files/img/interface-admin/admin_acc_manage_fonts.png" width="50" height="50"></a>
		</div>
		<div class="bloc_div">
			<a  style="text-decoration:none" href="./module-font.php"><p class="txt"><?php _e('Manage Fonts','woocommerce-awesome-designer');?></p></a>
		</div>
	</div>		
	<div style="clear:both"></div>	
</div>
<!-- templates --> 
<div class="menu">	
	<div class="icone left1 bloc">
		<div class="bloc_div top" style="width:50px;">
			<a href="./module-admin.php"><img src="<?php echo $url_dossier_awesome;?>files/img/interface-admin/admin_acc_clean.png" width="50" height="50"></a>
		</div>
		<div class="bloc_div">
			<a  style="text-decoration:none" href="./module-admin.php"><p class="txt"><?php _e('Do the housework!','woocommerce-awesome-designer');?></p></a>
		</div>
	</div>	
<!-- polices --> 	
	<div style="clear:both"></div>	
</div>
<!-- separator --> 
<div class="txt-cadre-gris" style="height:5px; padding:0px;"></div>



</body>
</html>

<script > 	
	function test(e){
			window.parent.postMessage(e, "*");
		}	

	function clic(){
			$("#div_template").css("display",''); 
		}		
</script>
<?php } ?>