<?php echo view('client/layouts/header'); ?>
<?php echo view('client/layouts/topNav'); ?>
<?php echo view('client/layouts/sideNav'); ?>
<?php 
    $links = $this->data['links']; 
    $id = $this->data['company']['company_id'];
    $counter = 1;

?>
<div class="container">
<?php echo view('client/layouts/alerts'); ?>

    <div class="row m-3">
        <div class="col-md-12">
            <a href="../<?php echo $id; ?>" class="btn btn-secondary"><i class="fas fa-angle-double-left"></i> Go back</a>
        </div>
    </div>
    <div class="row">
        <div class="card card-outline card-info col-md-12">
            <div class="card-header">
                <h3 class="card-title">Contacts List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Link</th>
                            <th>Text</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <form action="../newLink" method="post">
                                <td>
                                    <input type="hidden" name="compId" id="companyId" value="<?php echo $id; ?>">
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-link"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="link" id="link" placeholder="Paste link here...">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-comment-dots"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="text" id="text" placeholder="Enter text following link...">
                                    </div>
                                </td>
                                <td>
                                <button type="submit" class="btn btn-outline-primary">Add Link</button>
                                </td>
                            </form>
                        </tr>
                        <?php if(!empty($links)){
                                foreach($links as $key => $value){ ?>
                        <tr>
                            <form action="../updateLink" method="post">
                                <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $value->id; ?>">
                                <input type="hidden" class="form-control" name="compId" id="compId" value="<?php echo $value->company_id; ?>">
                                <td>
                                    <?php echo $counter++.'.'; ?>
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-link text-primary"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="link" id="link" value="<?php echo $value->link; ?>">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-comment-dots text-primary"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="text" id="text" value="<?php echo $value->text; ?>">
                                    </div>
                                </td>
                                <td>
                                <button type="submit" class="btn btn-outline-success mr-2">Save</button><a href="../../index.php/Companies/deleteLink/<?php echo $value->id; ?>/<?php echo $id; ?>" class="btn btn-outline-danger">Delete</a>
                                </td>
                            </form>
                        </tr>
                            <?php }
                            } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php echo view('client/layouts/footer'); ?>