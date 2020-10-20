<?php echo view('admin/header'); ?>
  
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper container">

    <div class="row">
    <?php
      if(!empty($message)){
        echo $message;
      }
    ?>
    </div>
    <div class="row mt-5">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <h1 class="m-3"><?php echo lang('Auth.login_heading');?></h1>
        <h3 class="card-title m-3"><?php echo lang('Auth.login_subheading');?></h3>
        <?php echo form_open();?>

          <div class="card-body">
            <div class="form-group">
              <?php echo form_label(lang('Auth.login_identity_label'), 'identity');?><br>
              <?php echo form_input($identity);?>
            </div>
            <div class="form-group">
              <?php echo form_label(lang('Auth.login_password_label'), 'password');?><br>
              <?php echo form_input($password);?>
            </div>

            <div class="form-check">
              <label class="form-check-label" for="exampleCheck1"><?php echo form_label(lang('Auth.login_remember_label'), 'remember');?></label>&nbsp;
              <?php echo form_checkbox('remember', '1', false, 'id="remember"');?>
            </div>
          </div>

          <div class="card-footer">
            <?php echo form_submit('submit', lang('Auth.login_submit_btn'));?>
          </div>

        <?php echo form_close();?>
        <p><a href="forgot_password"><?php echo lang('Auth.login_forgot_password');?></a></p>
      </div>
      <div class="col-md-3"></div>
    </div>


  <?php echo view('admin/footer'); ?>  
</div>

