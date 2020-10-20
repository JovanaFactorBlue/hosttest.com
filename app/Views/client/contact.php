<?php echo view('client/layouts/header'); ?>
<?php echo view('client/layouts/topNav'); ?>
<?php echo view('client/layouts/sideNav'); ?>
<?php 
    $contacts = $this->data['contact']; 
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
        <div class="col-md-12">
            <div class="card card-outline card-info col-md-12">
                <form role="form" action="../addContact" method="post">
                    <input type="hidden" name="compId" value="<?php echo $id; ?>">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter name here...">
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email here...">
                        </div>
                        <div class="form-group">
                            <label for="telephone">Telephone</label>
                            <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Enter phone number...">
                        </div>                        
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="Enter address...">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </form>
            </div>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>Address</th>
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($contacts)){ 
                        foreach($contacts as $key => $value){ ?>
                        <tr>
                            <form action="../updateContact" method="post">
                                <td><?php echo $counter++; ?></td>
                                    <input type="hidden" name="id" id="id" value="<?php echo $value->person_id; ?>">
                                    <input type="hidden" name="companyId" id="companyId" value="<?php echo $value->company_id; ?>">
                                <td><input type="text" name="name" id="name" value="<?php echo $value->name; ?>"></td>
                                <td><input type="email" name="email" id="email" value="<?php echo $value->email; ?>"></td>
                                <td><input type="text" name="telephone" id="telephone" value="<?php echo $value->telephone; ?>"></td>
                                <td><input type="text" name="address" id="address" value="<?php echo $value->address; ?>"></td>
                                <td><button type="submit" class="btn btn-outline-success mr-2">Save</button><a href="../../index.php/Companies/deleteContact/<?php echo $value->person_id; ?>/<?php echo $id;  ?>" class="btn btn-outline-danger">Delete</a></td>
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