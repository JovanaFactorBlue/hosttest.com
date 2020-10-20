<?php echo view('client/layouts/header'); ?>
<?php echo view('client/layouts/topNav'); ?>
<?php echo view('client/layouts/sideNav'); ?>
<?php 
    $data = $this->data; 
    $id = $data['company']['company_id'];
?>
<div class="container">
<?php echo view('client/layouts/alerts'); ?>
    <div class="row m-3">
        <div class="col-md-12">
            <a href="../<?php echo $id; ?>" class="btn btn-secondary"><i class="fas fa-angle-double-left"></i> Go back</a>
        </div>
    </div>
    <div class="row">
        <div class="card card-outline card-info col-md-6">
            <div class="card-header">
                <h4 class="card-title"><b>Social Media links</b></h4>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <?php foreach($data['networks'] as $key => $value){ ?>
                    <form action="../updateSocial" method="post">
                        <input type="hidden" name="compId" value="<?php echo $id; ?>">
                        <input type="hidden" name="type" value="<?php echo $key; ?>">
                        <li class="list-group-item">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fab fa-<?php echo $key; ?> 
                                    <?php if(!empty($data['profiles'])){
                                            foreach($data['profiles'] as $ta => $da){
                                                if($da->media_type == $key){
                                                    echo $value;
                                                }
                                            }
                                        }?>"></i> 
                                    </span>
                                </div>
                                <input type="text" name="link" class="form-control" placeholder="enter link..."                                        
                                    <?php if(!empty($data['profiles'])){
                                        foreach($data['profiles'] as $ta => $da){
                                            if($da->media_type == $key){ ?>
                                                value="<?php echo $da->social_link; ?>"
                                    <?php   }
                                        }
                                        }?>>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-outline-secondary">Save</button>
                                </div>
                        </li>
                    </form>
                    <?php } ?>
                <ul>
            </div>
            <div class="card-footer">
                
            </div>
                
        </div>
    </div>
</div>
<?php echo view('client/layouts/footer'); ?>