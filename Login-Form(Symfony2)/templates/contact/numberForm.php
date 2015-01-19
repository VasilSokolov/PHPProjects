<?php
/* @var $request \Pragmatic\Request */

?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
	<h1 class="page-header">
	    Contacts 
	    <small>
<?php if ($request->getCurrentAction() == 'addNumber') { ?> 
    		Create Number 
		<?php } else { ?> 
    		Edit Number
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
		<label>Number</label>
		<input required placeholder="Number" name="number" value="<?= $data['data']['number'] ?>" class="form-control">
	    </div>
		
		<div class="form-group">
			<label>Type</label>
			<select name='type' class="form-control">
				<?php foreach($data['data']['types'] as $type) { ?>
				<option 
					<?php echo !empty($data['data']['type']) && $data['data']['type'] == $type ? 'selected="selected"' : '' ?>value='<?=$type?>'><?=  ucfirst($type)?></option>
				<?php } ?>
			</select>
		</div>

	    <input type="hidden" name='numberId' value='<?= $data['data']['id'] ?>'/>
		<input type="hidden" name='contactId' value='<?= $data['data']['contactId'] ?>'/>
	    <button class="btn btn-default" type="submit">Submit Button</button>
	    <button class="btn btn-default" type="reset">Reset Button</button>

	</form>
    </div>
</div>