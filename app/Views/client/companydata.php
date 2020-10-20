<?php echo view('client/layouts/header'); ?>
<?php echo view('client/layouts/topNav'); ?>
<?php echo view('client/layouts/sideNav'); ?>
<?php $data = $this->data; ?>
<div class="container">
<?php echo view('client/layouts/alerts'); ?>
    <div class="row m-3">
        <div class="col-md-12">
            <a href="../<?php echo $data['company_id']; ?>" class="btn btn-secondary"><i class="fas fa-angle-double-left"></i> Go back</a>
        </div>
    </div>
    <div class="row">
        <div class="card card-info col-md-12 mb-5">
            <div class="card-header">
                <h3 class="card-title">Change data you wish and click SAVE</h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="../updateBasicData" method="post">
                    <input type="hidden" class="form-control" name="company_id" id="company_id" value="<?php echo $data['company_id']; ?>">
                    
                    <div class="form-group row">
                        <label for="company_name" class="col-sm-2 col-form-label">Company name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="company_name" id="company_name" value="<?php echo $data['company_name']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="company_displayname" class="col-sm-2 col-form-label">Company displayname</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="company_displayname" id="company_displayname" value="<?php echo $data['company_displayname']; ?>">
                        </div>
                    </div>                
                    <div class="form-group row">
                        <label for="company_location" class="col-sm-2 col-form-label">Location</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="company_location" id="company_location" value="<?php echo $data['company_location']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="company_employees" class="">Number of eployees</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-friends"></i></span>
                                </div>
                                <input type="number" class="form-control" name="company_employees" id="company_employees" value="<?php echo $data['company_employees']; ?>">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label for="company_website" class="">Website</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                </div>
                                <input type="text" class="form-control" name="company_website" id="company_website" placeholder="https://yourwebsite..." value="<?php echo $data['company_website']; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="company_slogan" class="form-label">Company slogan</label>
                            <input type="text" class="form-control" name="company_slogan" id="company_slogan" value="<?php echo $data['company_slogan']; ?>">
                            <small id="emailHelp" class="form-text text-muted"><i class="fas fa-info-circle"></i> Try to keep it short, but memorable.</small>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="company_moreinformation" class="form-label">More information</label>
                            <textarea class="form-control" name="company_moreinformation" id="company_moreinformation"><?php echo $data['company_moreinformation']; ?></textarea>
                            <small id="emailHelp" class="form-text text-muted"><i class="fas fa-info-circle"></i> Add some additional info about your company.</small>
                        </div>
                    </div>
                    <div class="form-group row m-3">
                        <button type="submit" class="btn btn-info">Save changes</button>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <a href="../<?php echo $data['company_id']; ?>" class="btn btn-default float-right"><i class="fas fa-chevron-circle-left"></i> Go back</a>
            </div>
        </div>
    </div>
</div>


<?php echo view('client/layouts/footer'); ?>