<?php
/* @var $request \Pragmatic\Request */

/* @var $paginator \Pragmatic\DBAL\Paginator */
$paginator = $data['data']['paginator'];

/* @var $users App\Model\Contact[] */
$contacts = $data['data']['contacts'];
?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Contacts <small>Your Contacts</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> List of the contacts
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->

<?php if (!empty($message)) { ?>
	<div class="row">
		<div class="col-lg-12">
			<div class="alert alert-info alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="fa fa-info-circle"></i>  <?= $message ?>
			</div>
		</div>
	</div>
	<!-- /.row -->

	<?php } ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Contacts</h3>
            </div>
            <div class="panel-body">
                <div class="text-right">
                    <a href="<?= $request->createUrl(null, 'create') ?>">Create new Contact <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                <div class="text-left">
					<?php if ($paginator->hasPrev()) { ?>
						<a class='btn btn-primary' href="<?= $request->createUrl(null, null, array('page' => $paginator->previousPage())) ?>">Prev</a>
					<?php } ?>
					<?php if ($paginator->hasNext()) { ?>
						<a class='btn btn-primary' href="<?= $request->createUrl(null, null, array('page' => $paginator->nextPage())) ?>">Next</a>
<?php } ?>
                </div>
                <br/>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Address</th>
								<th>Email</th>
								<th>Phones</th>
                                <th width="130px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
						<?php foreach ($contacts as $contact) { ?>
								<tr>
									<td><?= $contact->getFirstName() ?></td>
									<td><?= $contact->getLastName() ?></td>
									<td><?= $contact->getAddress() ?></td>
									<td><?= $contact->getEmail() ?></td>
									<td>
										<table class="table table-bordered table-hover table-striped">
											<thead>
											<th>Type</th>
											<th>Number</th>
											<th>Actions</th>
											</thead>
											<tbody>
												<?php
												$numbers = $contact->getNumbers();
												foreach ($numbers as $numberId => $number) {
													?>
													<tr>
														<td><?= $number->getType() ?></td>
														<td><?= $number->getNumber() ?></td>
														<td>
															<a class="btn btn-primary btn-sm" href="<?= $request->createUrl(null, 'deleteNumber', array('contactId' => $contact->getId(), 'numberId' => $number->getId())) ?>" style="float:left;" />Delete</a>
															<a class="btn btn-primary btn-sm" href="<?= $request->createUrl(null, 'updateNumber', array('contactId' => $contact->getId(), 'numberId' => $number->getId())) ?>" style="float:right;" />Edit</a>
														</td>
													</tr>
												<?php } ?>
											</tbody>
										</table>
									</td>
									<td>
										<a class="btn btn-primary btn-sm" href="<?= $request->createUrl(null, 'delete', array('id' => $contact->getId())) ?>" style="float:left;" />Delete</a>
										<a class="btn btn-primary btn-sm" href="<?= $request->createUrl(null, 'update', array('id' => $contact->getId())) ?>" style="float:right;" />Edit</a><br/><br/>
										<a class="btn btn-primary btn-sm" href="<?= $request->createUrl(null, 'addNumber', array('contactId' => $contact->getId())) ?>" style="float:left;width:112px" />Add Number</a>
									</td>
								</tr>
						<?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="text-right">
                    <a href="<?= $request->createUrl(null, 'create') ?>">Create new contact <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                <div class="text-left">
					<?php if ($paginator->hasPrev()) { ?>
						<a class='btn btn-primary' href="<?= $request->createUrl(null, null, array('page' => $paginator->previousPage())) ?>">Prev</a>
					<?php } ?>
					<?php if ($paginator->hasNext()) { ?>
						<a class='btn btn-primary' href="<?= $request->createUrl(null, null, array('page' => $paginator->nextPage())) ?>">Next</a>
<?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>