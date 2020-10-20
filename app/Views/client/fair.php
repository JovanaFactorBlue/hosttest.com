<?php echo view('client/layouts/header'); ?>
<?php echo view('client/layouts/topNav'); ?>
<?php echo view('client/layouts/sideNav'); ?>
<?php 
$booths = $this->data;
?>

<?php echo view('admin/header'); ?>
<?php echo view('admin/top-nav'); ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="m-5">These are all owners booths in this fair</h1>
        </div>
    </div>
    <div class="row">   
        <?php foreach($booths as $booth){ ?>
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
            </div>
        <?php } ?>      
    </div>
</div>
<?php echo view('client/layouts/footer'); ?>