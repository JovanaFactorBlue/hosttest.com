<?php echo view('client/layouts/header'); ?>
<?php echo view('client/layouts/topNav'); ?>
<?php echo view('client/layouts/sideNav'); ?>
<?php 
    $company = $this->data['basic'];
    $contacts = $this->data['contacts'];
    $links = $this->data['links'];
    $social = $this->data['social'];
    $networks = $this->data['networks'];
    $counter = 1;
?>
<div class="container">
<?php echo view('client/layouts/alerts'); ?>
    <div class="row">
        <div class="card card-outline card-info col-md-12">
            <div class="card-header">
                <h3 class="card-title"><b>Basic company data</b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Company name: </b><?php echo $company['company_name']; ?></li>
                    <li class="list-group-item"><b>Display name: </b><?php echo $company['company_displayname']; ?></li>
                    <li class="list-group-item"><b>Location: </b><?php echo $company['company_location']; ?></li>
                    <li class="list-group-item"><b>Employees: </b><?php echo $company['company_employees']; ?></li>
                    <li class="list-group-item"><b>Website: </b><?php echo $company['company_website']; ?></li>
                    <li class="list-group-item"><b>Slogan: </b>"<?php echo $company['company_slogan']; ?>"</li>
                    <li class="list-group-item"><b>Logo: </b><?php if(!empty($company['company_logo'])){ echo '<i class="fas fa-check-circle text-success"></i>'; }else{ echo '<i class="fas fa-times-circle text-danger"></i>'; } ?></li>
                    <li class="list-group-item"><b>More info: </b><?php echo $company['company_moreinformation']; ?></li>
                </ul>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="./editcompany/<?php echo $company['company_id']; ?>" class="btn btn-outline-primary">Edit Basic data</a>
            </div>
            <!-- /.card-footer -->
        </div>
    </div>
    <div class="row">
        <div class="card card-outline card-info col-md-5">
            <div class="card-header">
                <h4 class="card-title"><b>Company Profiles</b></h4>
            </div>
            <div class="card-body">

            </div>
            <div class="card-footer">
                <a href="./profiles/<?php echo $company['company_id']; ?>" class="btn btn-outline-primary">Edit Company profiles</a>
            </div>
        </div>
        <div class="col-md-1"></div>
        <div class="card card-outline card-info col-md-6">
            <div class="card-header">
                <h4>Company logo</h4>
            </div>
            <div class="card-body">
                <?php if(!empty($company['company_logo'])){ ?>
                        <img src="<?php echo ltrim($company['company_logo'], '.'); ?>" class="img-fluid" alt="">
                    </div> 
                    <div class="card-footer">
                        <a href="../index.php/Companies/removeLogo/<?php echo $company['company_id']; ?>" class="btn btn-danger m-3">Delete</a>
                    </div>
                <?php }else{ ?>
                    <form role="form" action="./uploadLogo" method="post" enctype="multipart/form-data">
                        <input type="hidden" value="<?php echo $company['company_id']; ?>" name="company_id"> 
                        <div class="form-group">
                            <label for="company_logo">Upload logo</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="company_logo" id="company_logo">
                                    <label class="custom-file-label" for="company_logo">Choose file</label>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Upload Logo</button>
                        </div>
                    </div>
                    </form>
                <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="card card-outline card-info col-md-4">
            <div class="card-header">
                <h4 class="card-title"><b>Social Media links</b></h4>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                <?php  if(!empty($networks)){
                            foreach($networks as $key => $value){ ?>
                            <li class="list-group-item"><div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fab fa-<?php echo $key; ?> 
                                    <?php if(!empty($networks)){
                                            foreach($social as $ta => $da){
                                                if($da->media_type == $key){
                                                    echo $value;
                                                }
                                            }
                                        }?>"></i> </span>
                                        </div> 
                                        <input type="hidden" name="compId" value="<?php echo $company['company_id']; ?>">
                                        <input type="text" class="form-control"
                                        
                                        <?php if(!empty($social)){
                                            foreach($social as $ta => $da){
                                                if($da->media_type == $key){ ?>
                                                    value="<?php echo $da->social_link; ?>"
                                        <?php   }
                                            }
                                            }?> disabled>
                            </li>
                            <?php }
                            } ?>
                <ul>
            </div>
            <div class="card-footer">
                <a href="./social/<?php echo $company['company_id']; ?>" class="btn btn-outline-primary">Edit links</a>
            </div>
        </div>
        <div class="col-md-1"></div>
        <div class="card card-outline card-info col-md-7">
            <div class="card-header">
                <h3 class="card-title">List of company contacts</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($contacts)){
                            foreach($contacts as $key => $value){ ?>
                            <tr>
                                <td><?php echo $counter++; ?></td>
                                <td><?php echo $value->name; ?></td>
                                <td><?php echo $value->email; ?></td>
                                <td><?php echo $value->telephone; ?></td>
                                <td><?php echo $value->address; ?></td>
                            </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <a href="./contacts/<?php echo $company['company_id']; ?>" class="btn btn-outline-primary">Edit contact persons</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card card-outline card-info col-md-12">
            <div class="card-header">
                <h4 class="card-title"><b>External links</b></h4>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                <?php if(!empty($links)){ 
                        foreach($links as $key => $value){ ?>
                            <li class="list-group-item"><a href="<?php echo $value->link; ?>"><?php echo $value->text; ?></a></li>
                    <?php }
                        } ?>
                <ul>
            </div>
            <div class="card-footer">
                <a href="./external/<?php echo $company['company_id']; ?>" class="btn btn-outline-primary">Edit external links</a>
            </div>
        </div>
    </div>
    <div class="row mb-5"></div>
</div>


<?php echo view('client/layouts/footer'); ?>