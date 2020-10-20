<?php echo view('client/layouts/header'); ?>
<?php echo view('client/layouts/topNav'); ?>
<?php echo view('client/layouts/sideNav'); ?>
<?php 
$fairs = $this->data;
?>
<div class="container mt-5">
    <div class="row mt-5">
        
        <?php foreach($fairs as $fair){ ?>
            <div class="col-md-12 mt-5">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3><?php echo $fair['title']; ?></h3>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <?php 
                            
                            $b = new App\Controllers\Owner;
                            $booths = $b->clientsBoothsOnSingleFair($fair['fair_id']);

                            foreach($booths as $booth){ ?>
                            <a href="/mybooth/<?php echo $booth['booth_id']; ?>" class="btn btn-success"><?php echo $booth['booth_name']; ?></a>
                        <?php    }
                        
                        ?> 
                    </div>
                    <div class="card-footer blockquote-footer">
                        Start: <?php echo date_format(date_create($fair['startDate']), "d.M.Y"); ?>  end: <?php echo date_format(date_create($fair['endDate']), "d.M.Y"); ?>
                    </div>
                </div>
            </div>
        <?php }?>
        
    </div>
</div>
<?php echo view('client/layouts/footer'); ?>