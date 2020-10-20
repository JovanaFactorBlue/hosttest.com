<?php echo view('admin/header'); ?>
<?php echo view('admin/top-nav'); ?>

<?php 
    $id = basename($_SERVER['REQUEST_URI']);

    $test = new App\Controllers\Companies();

    $booths = $test->getBooths($id);

    foreach($booths as $key => $value){
?>
<div class="container mt-5">
    <div class="row">
        <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title"><?php echo $value['booth_name']; ?></h5>
            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="card-link">Card link</a>
            <a href="../booths/booth/<?php echo $id; ?>" class="card-link">Another link</a>
        </div>
        </div>
    </div>
</div>
    <?php } ?>