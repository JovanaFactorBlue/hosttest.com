<?php echo view('client/layouts/header'); ?>
<?php echo view('client/layouts/topNav'); ?>
<?php echo view('client/layouts/sideNav'); ?>
<?php 
    $user = $this->data['userData'];
    $compId = $this->data['compId']['company_id'];
?>

<div class="container mt-5">
    <div class="row mt-5">
        <div class="col-md-4 mt-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h4>Manage your <br>company data</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-file-invoice"></i>
                </div>
                <a href="./company/<?php echo $compId; ?>" class="small-box-footer">
                    <i class="fas fa-hand-pointer"></i>
                </a>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h4>Overview your <br>booths in fairs</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-store"></i>
                </div>
                <a href="/myfairs" class="small-box-footer">
                    <i class="fas fa-hand-pointer"></i>
                </a>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="small-box bg-warning">
                <div class="inner text-light">
                    <h4>Manage your <br>personal data</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <a href="#" class="small-box-footer">
                    <i class="fas fa-hand-pointer text-light"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <h2>Owner data</h2>
                <ul class="list-group">
                    <li class="list-group-item">User ID: <?php echo $user['user_id']; ?></li>
                    <li class="list-group-item">User group ID: <?php echo $user['group_id']; ?></li>
                    <li class="list-group-item">User group name: <?php echo $user['name']; ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php echo view('client/layouts/footer'); ?>