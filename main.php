<?php
session_start();
$email_mail = $_SESSION['email'];
$_SESSION['email_create'] = $email_mail;
$_SESSION['email_get'] = $email_mail;

require 'config.php';
$res = pg_query($dbconn, "SELECT credit FROM credit WHERE email = '".$email_mail."'");
$val = pg_fetch_result($res, 0, 0);
?>
<!DOCTYPE html>
<html>

<head>

	<title>Money Management</title>

	<link rel="shortcut icon" type="image/png" href="assets/images/dollar.png"/>

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=neon|outline|emboss|shadow-multiple">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">

	<script type="text/javascript">
    	 var url = "http://localhost:3000/"; // Perlu Disesuasikan
    </script>
    <script src="js/item-ajax.js"></script>
</head>

<body>
	<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
		<img src="https://img.icons8.com/bubbles/2x/money.png">
		</div>
		<ul class="nav navbar-nav">
		</ul>
		<ul class="nav navbar-nav navbar-right">
		<li><a href="#"><?php echo "Rp.", $val?></a></li>
		<li><a href="#"><?php echo $email_mail?></a></li>
		<li><a href="api/logout.php"><span class="glyphicon glyphicon-log-out"></span> LogOut</a></li>
		</ul>
	</div>
	</nav>

	<div class="container">
		<div class="row">
		    <div class="col-lg-12 margin-tb">
				<div class="pull-left">
					<h2 class="font-effect-outline">Money Management</h2>
				</div>
				<div class="pull-right">
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-item">
					Add Transaction
				</button>
				</div>
			</div>
		</div>


		<table class="table table-borderless table-striped">
			<thead>
			    <tr>
				<th>Transaction</th>
				<th>Amount</th>
                <th>Date</th>
                <th>Category</th>
				<th>Type</th>
				<th width="150px"></th>
			    </tr>
			</thead>
			<tbody>
			</tbody>
		</table>

	    <!-- Create Item Modal -->

		<div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		        <h4 class="modal-title" id="myModalLabel">Add Transaction</h4>
		      </div>

		      <div class="modal-body">
		      		<form data-toggle="validator" action="../api/create.php" method="POST">

		      			<div class="form-group">
							<label class="control-label" for="title">Transaction:</label>
							<input type="text" name="transaction" class="form-control" data-error="Input Transaction Name." required />
							<div class="help-block with-errors"></div>
						</div>

						<div class="form-group">
							<label class="control-label" for="title">Amount:</label>
							<input type="number" name="amount" class="form-control" data-error="Input Transaction Amount." required />
							<div class="help-block with-errors"></div>
						</div>

						<div class="form-group">
							<label class="control-label" for="title">Date:</label>
							<input type="date" name="date" class="form-control" data-error="Input Transaction Date." required />
							<div class="help-block with-errors"></div>
						</div>

						<div class="form-group">
							<label class="control-label" for="title">Category:</label>
							<select class="form-control" name="category" data-error="Insert Transaction Category" required>
							<option value="Housing">Housing</option>
							<option value="Transportation">Transportation</option>
							<option value="Food">Food</option>
							<option value="Utilities">Utilities</option>
							<option value="Insurance">Insurance</option>
							<option value="Medical">Medical & Healthcare</option>
							<option value="Personal Spending">Personal Spending </option>
							<option value="Entertainment">Entertainment</option>
							<option value="Recreation">Recreation</option>
							<option value="Salary">Salary</option>
							<option value="Stock">Stock</option>
							<option value="Miscellaneous">Miscellaneous...</option>
							</select>
						</div>

						<div class="form-group">
							<label class="control-label" for="title">Type:</label>
							<select class="form-control" name="inout" data-error="Insert Transaction Type" required>
							<option value="Income">Income</option>
							<option value="Outcome">Outcome</option>
							</select>
						</div>

						<div class="form-group">
							<button type="submit" class="btn crud-submit btn-success">Submit</button>
						</div>
		      		</form>
		      </div>
		    </div>
		  </div>
		</div>

		<!-- Edit Item Modal -->

		<div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  	<div class="modal-dialog" role="document">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		        		<h4 class="modal-title" id="myModalLabel">Edit Transaction</h4>
		      		</div>

		      		<div class="modal-body">
		      			<form data-toggle="validator" action="../api/update.php" method="put">
		      			<input type="hidden" name="id" class="edit-id">

		      			<div class="form-group">
							<label class="control-label" for="title">Transaction:</label>
							<input type="text" name="transaction" class="form-control" data-error="Input Transaction Name." required />
							<div class="help-block with-errors"></div>
						</div>

						<div class="form-group">
							<label class="control-label" for="title">Amount:</label>
							<input type="number" name="amount" class="form-control" data-error="Input Transaction Amount." required />
							<div class="help-block with-errors"></div>
						</div>

						<div class="form-group">
							<label class="control-label" for="title">Date:</label>
							<input type="date" name="date" class="form-control" data-error="Input Transaction Date." required />
							<div class="help-block with-errors"></div>
						</div>

						<div class="form-group">
							<label class="control-label" for="title">Category:</label>
							<select class="form-control" name="category" data-error="Insert Transaction Category" required>
							<option value="Housing">Housing</option>
							<option value="Transportation">Transportation</option>
							<option value="Food">Food</option>
							<option value="Utilities">Utilities</option>
							<option value="Insurance">Insurance</option>
							<option value="Medical & Healthcare">Medical & Healthcare</option>
							<option value="Personal Spending">Personal Spending </option>
							<option value="Entertainment">Entertainment</option>
							<option value="Recreation">Recreation</option>
							<option value="Miscellaneous">Miscellaneous</option>
							</select>
						</div>

						<div class="form-group">
							<label class="control-label" for="title">Type:</label>
							<select class="form-control" name="inout" data-error="Insert Transaction Type" required>
							<option value="Income">Income</option>
							<option value="Outcome">Outcome</option>
							</select>
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-success crud-submit-edit">Submit</button>
						</div>
		      			</form>
		      		</div>
		    	</div>
			</div>
		</div>
	</div>

</body>
</html>