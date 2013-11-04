<?php

/* Given variables: 
	$exception, which is a BlogzaException (system/models/BlogzaException.class.php)

*/

if(!isset($exception)) {
	die("Viewing raw is not available.");
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Uh oh! An error has occurred!</title>
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="http://10.0.1.34/blog/templates/default/css/error.css">
	</head>

	<body>
		<div class="container">
			<div class="row">

				<div class="col-md-4">
					<ul class="nav nav-pills nav-stacked nav-error-files">
						<li><a href="#1">
							<?php echo $exception->err_file; ?> : <?php echo $exception->err_line; ?>
						</a></li>
					</ul>
				</div>

				<div class="col-md-8">
					<div class="alert alert-danger">
						<h2>Error level <?php echo $exception->err_level; ?></h2>
						<h4> <?php echo $exception->err_msg; ?></h4>
					</div>

					<h2>Code <small> <?php echo $exception->err_file; ?></small></h2>
					<pre class="pre-scrollable">
						<ol class="linenums">

							<?php
							foreach($exception->err_file_lines as $linenum => $line) {
								// Is this the culprit :O
								// $linenum+1 - the +1 is an ugly hack to make the actual line show.
								if($linenum+1 == $exception->err_line) {
									echo '<li class="culprit">' . $line . '</li>';
								} else if ($linenum+1 > $exception->err_line-2 && $linenum+1 < $exception->err_line+2 ) {
									echo '<li class="culprit-helper">' . $line . '</li>';
								} else {
								// Not the culprit.
									echo '<li>' . $line . "</li>";
								}
								
							}
							?>

						</ol>

					</pre>

					<h2>Variables</h2>

					<table class="table table-striped table-bordered">
						<tbody>
							<th>
								<td>Key</td>
								<td>Value</td>
							</th>

							<?php
							// $_GET variables
							foreach($_GET as $key => $value) {
								?>
								<tr>
									<td> $_GET <?php echo $key; ?> </td>
									<td> <?php echo $value; ?> </td>
								</tr>
								<?php
							}
							// $_POST variables
							foreach($_POST as $key => $value) {
								?>
								<tr>
									<td> $_POST <?php echo $key; ?> </td>
									<td> <?php echo $value; ?> </td>
								</tr>
								<?php
							}

							?>
						</tbody>

					</table>

				</div>

			</div>
		</div>
	</body>

</html>