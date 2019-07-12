<!doctype html>

<html lang="en">
<head>

    <?php echo $this->header_html(); ?> 

	<!-- styles -->
	<link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/trueno" type="text/css"/>
	<link rel="stylesheet" href="<?php $this->get_theme_path( 'assets/main/main.css', true ); ?>">
	<link rel="stylesheet" href="<?php $this->get_theme_path( 'assets/third_party/sweetalert/sweetalert.css', true ); ?>">

	<?php $this->out( $this->infos->html_header, ['type'=>'html']); ?>
	<style>
		.bg-light { background-color: <?php $this->out( $this->infos->cor_bg_claro ); ?> }
		.bg-secondary { background-color: <?php $this->out( $this->infos->cor_bg ); ?> }
		.bg-secondary2, .bg-cta { background-color: <?php $this->out( $this->infos->cor_cta ); ?> } 
	</style>
</head>

<body>

<?php $this->out( $this->infos->html_pre_body, ['type'=>'html']); ?>

<?php 
	foreach ($this->slots as $item) 
	{
		if($item->bloc == 'content')
			$this->get_page_view();
		else
			$this->bloc($item->bloc);
	}
?>

	<script src="<?php $this->get_theme_path( 'assets/main/main.js', true ); ?>"></script>
	<script src="<?php $this->get_theme_path( 'assets/third_party/sweetalert/sweetalert.min.js', true ); ?>"></script>
	<script src="<?php $this->get_theme_path( 'assets/ajax/ajax.js', true ); ?>"></script>
	
	<?php $this->out( $this->infos->html_pos_body, ['type'=>'html']); ?>

</body>

</html>

