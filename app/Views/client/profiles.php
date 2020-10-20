<?php echo view('client/layouts/header'); ?>
<?php echo view('client/layouts/topNav'); ?>
<?php echo view('client/layouts/sideNav'); ?>
<?php $profiles = $this->data['profiles']; ?>
<?php $company = $this->data['company']; ?>
<?php var_dump($this->data); ?>

<div class="container">
<?php echo view('client/layouts/alerts'); ?>
    <div class="row m-3">
        <div class="col-md-12">
            <a href="../<?php echo $company['company_id']; ?>" class="btn btn-secondary"><i class="fas fa-angle-double-left"></i> Go back</a>
        </div>
    </div>
</div>
<?php echo view('client/layouts/footer'); ?>