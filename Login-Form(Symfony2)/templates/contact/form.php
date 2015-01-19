<?php
/* @var $request \Pragmatic\Request */

?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
	<h1 class="page-header">
	    Contacts 
	    <small>
<?php if ($request->getCurrentAction() == 'create') { ?> 
    		Create Contact 
		<?php } else { ?> 
    		Edit Contact
		<?php } ?>
	    </small>
	</h1>
    </div>
</div>
<!-- /.row -->
<?php if (!empty($message)) { ?>
    <div class="row">
        <div class="col-lg-12">
    	<div class="alert alert-danger">
    	    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    	    <i class="fa fa-info-circle"></i>  <strong>Error</strong> <?= $message ?>
    	</div>
        </div>
    </div>
    <!-- /.row -->
<?php } ?>

<div class="row">
    <div class="col-lg-6">
	<form role="form" action="<?= $request->createUrl() ?>" method="POST">

	    <div class="form-group">
		<label>First Name</label>
		<input required placeholder="First Name" name="firstName" value="<?= $data['data']['firstName'] ?>" class="form-control">
	    </div>
		
		<div class="form-group">
		<label>Last Name</label>
		<input required placeholder="Last Name" name="lastName" value="<?= $data['data']['lastName'] ?>" class="form-control">
	    </div>
		
		<div class="form-group">
		<label>Email</label>
		<input required placeholder="Email" name="email" value="<?= $data['data']['email'] ?>" class="form-control">
	    </div>
		
		<div class="form-group">
		<label>Address</label>
		<input required placeholder="Address" name="address" value="<?= $data['data']['address'] ?>" class="form-control">
	    </div>


	    <input type="hidden" name='id' value='<?= $data['data']['id'] ?>'/>
	    <button class="btn btn-default" type="submit">Submit Button</button>
	    <button class="btn btn-default" type="reset">Reset Button</button>

	</form>
    </div>
</div>