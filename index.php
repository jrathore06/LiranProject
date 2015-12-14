<?php include 'Verification.php'?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Liran Project</title>
		<link rel="stylesheet" href="css/style.css" type="text/css"/>
	</head>
	<body>
		<div class="container">
			<div id="input">
					<h1>Return Meta Tags</h1>
					<p>Input a URL in the form below and it will output the the content of the google verification token <p>
					<p>If the site does not have a token then it will output that it does not and also all of the meta tags that it does have.</p>
					<form method="post" action="">
						<input name="site_url" type="text" placeholder="Enter URL Here"/>
						<br/>
						<input type="submit" class="submit-btn" name="submit" value="Submit"/>
					</form>
					<p id = "output">
						<?php
							$meta = new Verification();
							echo $meta->getGoogleVer($_POST['site_url']);
							?>
					</p>
			</div>
		</div>
		<div class="container">
				<div id="input">
						<h1>Update/Add Google Verification Meta Tag</h1>
						<p>Input the URL and meta tag token below and it will update or append to the Google Site Verification Meta tag.</p>
						<form method="post" action="">
							<input id="value" name="site_url_add" type="text" placeholder="Enter URL Here"/>
							<input id="keyword" name="keyword" type="text" placeholder="Enter Keyword Here"/>
							<br/>
							<input id="submitAdd" type="submit" class="submit-btn" name="submitAdd" value="Submit"/>
						</form>
						<p id="output2">
							<?php
								$meta = new Verification();
								$meta->updateGoogleVer($_POST['site_url_add'],$_POST['keyword']);
								echo "The token has been added";
							?>
						</p>
				</div>	
		</div>
		<div class="container">
				<div id="input">
						<h1>Delete Google Verification Meta Tag</h1>
						<p>Input the URL below and the Google Site Verification token will be deleted</p>
						<form id="update" action="index.php">
							<input name="site_url_delete" type="text" placeholder="Enter URL Here"/>
							<br/>
							<input id="submitDelete" type="submit" class="submit-btn" name="submitDelete" value="Submit"/>
						</form>
						<p id="output3">
							<?php
								$meta = new Verification();
								if($meta->deleteGoogleVer($_POST['site_url_delete'])){
									echo "The token has been added";
								}
								else{
									echo "No token to delete";
								}
							?>
						</p>
				</div>
		</div>
	</body>
</html>

