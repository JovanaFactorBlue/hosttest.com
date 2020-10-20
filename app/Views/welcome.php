<?php echo view('admin/header'); ?>

<?php echo view('admin/top-nav'); ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1>WELCOME</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <a href="/admin" class="btn btn-lg btn-outline-primary">ADMIN</a>
        </div>
        <div class="col-md-2">
            <a href="/owner" class="btn btn-lg btn-outline-primary">OWNER</a>
        </div>        
        <div class="col-md-2">
            <a href="/" class="btn btn-lg btn-outline-primary">VISITOR</a>
        </div>
    </div>
</div>


<?php echo view('admin/footer'); ?>