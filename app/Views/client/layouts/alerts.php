<?php if(isset($_SESSION['message'])){ ?>
        <div class="row">
            <div class="col-md-3">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading"> <i class="far fa-smile-beam"></i> <?php echo $_SESSION['message']; ?></h4>
                </div>
            </div>
        </div>
<?php }
 if(isset($_SESSION['info'])){ ?>
    <div class="row">
        <div class="col-md-3">
            <div class="alert alert-info" role="alert">
                <h3 class="alert-heading"> <i class="far fa-smile"></i> </h3>
                <?php echo $_SESSION['info']; ?>
            </div>
        </div>
    </div>
<?php } 
 if(isset($_SESSION['error'])){ ?>
        <div class="row">
            <div class="col-md-3">
                <div class="alert alert-danger" role="alert">
                    <h3 class="alert-heading"> <i class="far fa-dizzy"></i> </h3>
                    <?php echo $_SESSION['error']; ?>
                </div>
            </div>
        </div>
<?php } ?>