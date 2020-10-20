
<!-- <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <?php echo view('admin/header'); ?>
<?php foreach($css_files as $file): ?>
	    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
</head>
<body>


<?php //echo view('admin/top-nav'); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <?php echo $output; ?>
        </div>
    </div>
</div>

    <div style="padding: 10px">
		
    </div>
    <?php foreach($js_files as $file): ?>
        <script src="<?php echo $file; ?>"></script>
    <?php endforeach; ?>

</body>
</html>