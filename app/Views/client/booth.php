<?php
$booth = $this->data['booth'];
use App\Controllers\Booths;
use App\Models\BoothModel;

echo view('client/layouts/header');
echo view('client/layouts/topNav');
echo view('client/layouts/sideNav');

if(isset($message)){
    var_dump($message);
} ?>
<div class="container mt-5">
    <div class="row mt-5">
        <div class="col-md-12 mt-5">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title"><b>Basic booth info:</b></h3>
                    <div class="card-tools">
                    <span class="badge badge-info">Info</span>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Booth title: </b><?php echo $booth['booth_name']; ?></li>
                        <li class="list-group-item"><b>Booth color: </b><?php echo $booth['booth_color']; ?></li>
                        <li class="list-group-item"><b>Booth size: </b><?php echo $booth['booth_size']; ?></li>
                    </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    The footer of the card
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-4 mt-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h4>Manage booth <br>images</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-images"></i>
                </div>
                <a href="../images/<?php echo $booth['booth_id']; ?>" class="small-box-footer">
                    <i class="fas fa-hand-pointer"></i>
                </a>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h4>Manage <br>booth videos</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-film"></i>
                </div>
                <a href="../videos/<?php echo $booth['booth_id']; ?>" class="small-box-footer">
                    <i class="fas fa-hand-pointer"></i>
                </a>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="small-box bg-warning">
                <div class="inner text-light">
                    <h4>Manage files <br>for download</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-file-archive"></i>
                </div>
                <a href="../files/<?php echo $booth['booth_id']; ?>" class="small-box-footer">
                    <i class="fas fa-hand-pointer text-light"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 mt-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h4>Booth <br>preview</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-eye"></i>
                </div>
                <a href="#" class="small-box-footer">
                    <i class="fas fa-hand-pointer"></i>
                </a>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>

<?php echo view('client/layouts/footer'); ?>
 


