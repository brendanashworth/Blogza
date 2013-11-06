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
		<div class="row">

			<div class="col-md-4">
				<ul class="nav nav-pills nav-stacked nav-error-files">
					<li><a href="#1">
						<?php echo $exception->err_file; ?> : <?php echo $exception->err_line; ?>
					</a></li>
				</ul>
			</div>

			<div class="col-md-8">
				<div class="error-overview">
					<h1>Error level <?php echo $exception->err_level; ?></h1>
					<h4> <?php echo $exception->err_msg; ?></h4>
				</div>

				<div class="code-overview">
					<h2>Code <a href="#culprit" align="right" class="btn btn-warning">#<?php echo $exception->err_line; ?></a></h2>
					<div class="pre-fix">
						<p> <?php echo $exception->err_file; ?> </p>
					</div>
					<pre class="pre-scrollable">
						<ol class="linenums">

							<?php
							foreach($exception->err_file_lines as $linenum => $line) {
								$line = htmlentities($line);
								// Is this the culprit :O
								// $linenum+1 - the +1 is an ugly hack to make the actual line show.
								if($linenum+1 == $exception->err_line) {
									echo '<li class="culprit" id="culprit">' . $line . '</li>';
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
				</div>

				<div class="var-overview">
					<h2>Variables</h2>

					<table class="table table-striped table-bordered table-condensed">
						<tbody>
							<tr>
								<th>Key</th>
								<th>Value</th>
							</tr>

							<?php
							// Get all the variables.
							$vars = array();

							/* Go through all the vars. */
							while (list($var,$value) = each ($_SERVER)) {
								$vars[$var] = $value;
							}

							$out = array();

							foreach($vars as $key => $value) {
								echo "<tr>";
								echo "<td> $key </td>";
								echo "<td> $value </td>";
								echo "</tr>";
							}

							?>
						</tbody>

					</table>
				</div>

			</div>

		</div>
	</body>

</html>