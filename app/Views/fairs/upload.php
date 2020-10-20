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
            <a class="btn btn-sm btn-secondary mt-5" href="../fairs"><i class="fas fa-step-backward"></i> Go back</a>
        </div>
    </div>
    <div class="row">
        <form role="form" action="/index.php/fairs/uploadFile" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="hidden" name="id" value="<?php echo intval($id); ?>">
                            <input type="file" class="custom-file-input" name="image" id="fileInput">
                            <label class="custom-file-label" for="fileInput">Choose file</label>
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
    <div class="row">
        <a href="/index.php/fairs/removeImage/<?php echo $id; ?>" class="btn btn-outline-danger m-3">Delete image</a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php 
                $image = new App\Controllers\Fairs();
                if($image->displayImage($id) !== 'empty'){
                    echo '<img src="'.base_url('uploads/images/fairs').'/'.$image->displayImage($id).'" class="img-fluid" alt="Responsive image">';
                }
            ?>
        </div>
    </div>
</div>
<?php echo view('admin/footer'); ?>