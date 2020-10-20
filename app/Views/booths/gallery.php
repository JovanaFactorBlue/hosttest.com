<?php echo view('admin/header'); ?>
<?php echo view('admin/top-nav'); ?>

<?php 
    $id = basename($_SERVER['REQUEST_URI']);
    // if (null !== $validation->listErrors()){
    //     echo $validation->listErrors();
    // }

?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-sm btn-secondary mt-5" href="../booths"><i class="fas fa-step-backward"></i> Go back</a>
        </div>
    </div>
    <div class="row m-5">
        <div class="col-md-12">
            <h2>Booth gallery:</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 galleryPosition1">
            <h3>Position 1:</h3>
            <?php 
                $image = new App\Controllers\Booths();
                if($image->displayBoothImage($id, 1) !== 'empty'){ ?>
                    <img src="<?php echo base_url('./uploads/images/booths/'.$id.'/'.$image->displayBoothImage($id, 1)); ?>" class="img-fluid" alt="Responsive image"><br>
                    <div class="row">
                        <a href="/index.php/booths/removeImage/<?php echo $id; ?>/1" class="btn btn-outline-danger m-3">Delete this image</a>
                    </div>
            <?php }else{ ?>                   
                    <form role="form" action="/index.php/booths/uploadBoothImage" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="fileInput">Choose an image:</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="hidden" name="position" value="1">
                                        <input type="hidden" name="id" value="<?php echo intval($id); ?>">
                                        <input type="file" class="custom-file-input" name="image" id="fileInput">
                                        <label class="custom-file-label" for="fileInput">Choose an image...</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                    </form>    
               <?php } ?>
        </div>
        <div class="col-md-3 galleryPosition2">
            <h3>Position 2:</h3>
            <?php 
                $image = new App\Controllers\Booths();
                if($image->displayBoothImage($id, 2) !== 'empty'){ ?>
                    <img src="<?php echo base_url('./uploads/images/booths/'.$id).'/'.$image->displayBoothImage($id, 2); ?>" class="img-fluid" alt="Responsive image"><br>
                    <div class="row">
                        <a href="/index.php/booths/removeImage/<?php echo $id; ?>/2" class="btn btn-outline-danger m-3">Delete this image</a>
                    </div>
            <?php }else{ ?>
                    <form role="form" action="/index.php/booths/uploadBoothImage" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="fileInput">Choose an image:</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="hidden" name="position" value="2">
                                        <input type="hidden" name="id" value="<?php echo intval($id); ?>">
                                        <input type="file" class="custom-file-input" name="image" id="fileInput">
                                        <label class="custom-file-label" for="fileInput">Choose an image...</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                    </form>    
               <?php } ?>
        </div>
        <div class="col-md-3 galleryPosition3">
            <h3>Position 3:</h3>
            <?php 
                $image = new App\Controllers\Booths();
                if($image->displayBoothImage($id, 3) !== 'empty'){ ?>
                    <img src="<?php echo base_url('./uploads/images/booths/'.$id).'/'.$image->displayBoothImage($id, 3); ?>" class="img-fluid" alt="Responsive image"><br>
                    <div class="row">
                        <a href="/index.php/booths/removeImage/<?php echo $id; ?>/3" class="btn btn-outline-danger m-3">Delete this image</a>
                    </div>
            <?php }else{ ?>
                    <form role="form" action="/index.php/booths/uploadBoothImage" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="fileInput">Choose an image:</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="hidden" name="position" value="3">
                                        <input type="hidden" name="id" value="<?php echo intval($id); ?>">
                                        <input type="file" class="custom-file-input" name="image" id="fileInput">
                                        <label class="custom-file-label" for="fileInput">Choose an image...</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                    </form>   
            <?php } ?>
        </div>
        <div class="col-md-3 galleryPosition4">
            <h3>Position 4:</h3>
            <?php 
                $image = new App\Controllers\Booths();
                if($image->displayBoothImage($id, 4) !== 'empty'){ ?>
                    <img src="<?php echo base_url('./uploads/images/booths/'.$id).'/'.$image->displayBoothImage($id, 4); ?>" class="img-fluid" alt="Responsive image"><br>
                    <div class="row">
                        <a href="/index.php/booths/removeImage/<?php echo $id; ?>/4" class="btn btn-outline-danger m-3">Delete this image</a>
                    </div>
            <?php }else{ ?>
                    <form role="form" action="/index.php/booths/uploadBoothImage" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="fileInput">Choose an image:</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="hidden" name="position" value="4">
                                        <input type="hidden" name="id" value="<?php echo intval($id); ?>">
                                        <input type="file" class="custom-file-input" name="image" id="fileInput">
                                        <label class="custom-file-label" for="fileInput">Choose an image...</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                    </form>    
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h2>Booth video:</h2>
        </div>
    </div>
    <div class="row">
    <?php
        if($image->boothVideo($id) !== 'empty'){ ?>
            <div class="row">
                <a href="/index.php/booths/removeVideo/<?php echo $id; ?>" class="btn btn-outline-danger m-3">Delete video</a>
            </div>
            <div class="col-md-12 mt-3 mb-5">
                <div class="embed-responsive embed-responsive-16by9">
                    <?php echo $image->boothVideo($id); ?>
                </div>
            </div>
    <?php }else{ ?>
            <div class="col-md-6">
                <h4>Upload video:</h4>
                <form action="/index.php/booths/uploadBoothVideo" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="video">Upload a video:</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <input type="file" class="custom-file-input" name="video" id="video">
                                    <label class="custom-file-label" for="fileInput">Choose video...</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <h4>Or embed from a link:</h4>
                <form action="/index.php/booths/embedBoothVideo" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="link">Paste a link here:</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <input type="text" name="link" id="link">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Embed</button>
                    </div>
                </form>
            </div>
    <?php } ?>

    </div>

</div>
<?php echo view('admin/footer'); ?>


