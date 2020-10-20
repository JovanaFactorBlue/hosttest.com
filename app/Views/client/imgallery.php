<?php
$booth = $this->data;

use App\Models\BoothModel;

echo view('client/layouts/header');
echo view('client/layouts/topNav');
echo view('client/layouts/sideNav');

if(isset($message)){
    var_dump($message);
} ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Booth Image Gallery</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                    <?php 
                        $imageDisplay = $booth['imgs'];
                        $imageN = $booth['type']['imagesNum'];
                        $position = '';
                        for($i = 1; $i <= $imageN; $i++){ 
                            $imageDisplay = $booth['imgs']; ?>
                            <div class="card card-outline card-warning col-md-3 m-3">
                                <div class="card-header">
                                    <h3 class="card-title">Image position <?php echo $i; ?></h3>
                                </div>
                                <div class="card-body">
                                    <?php
                                        $m = new BoothModel;
                                        $img = $m->getOneImage($booth['id'], $i);
                                        if(isset($img['position']) && $img['position'] == $i){ ?>
                                                <img src="<?php echo ltrim($img['file_path'], '.'); ?>" class="img-fluid" alt="">
                                            </div>
                                            <div class="card-footer">
                                                <a href="../index.php/Booths/unlinkImage/<?php echo $booth['id']; ?>/<?php echo $i; ?>" class="btn btn-outline-danger">Remove</a>
                                       <?php }else{ ?>
                                            <form role="form" action="/index.php/booths/uploadBoothImage" method="post" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="fileInput">Choose an image:</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="hidden" name="position" value="<?php echo $i; ?>">
                                                            <input type="hidden" name="id" value="<?php echo $booth['id']; ?>">
                                                            <input type="file" class="custom-file-input fileInput" name="image" id="fileInput">
                                                            <label class="custom-file-label" id="fileInputL" for="fileInput"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-success">Upload</button>
                                            </form> 
                                       <?php } ?>
                                </div>
                            </div>
                        <?php } ?> 
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo view('client/layouts/footer'); ?>
