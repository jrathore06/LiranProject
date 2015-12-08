<?php
		function parseUrl($url){
				//Trim whitespace of the url to ensure proper checking.
				$url = trim($url);
				//Check if a protocol is specified at the beginning of the url. If it's not, prepend 'http://'.
				if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
						$url = "http://" . $url;
				}
				//Check if '/' is present at the end of the url. If not then append '/'.
				if (substr($url, -1)!=="/"){
						$url .= "/";
				}
				//Return the processed url.
				return $url;
		}
		//If the form was submitted
		if(isset($_GET['siteurl'])){
				//Put every new line as a new entry in the array
				$urls = explode("\n",trim($_GET["siteurl"]));
				//Iterate through urls
				foreach ($urls as $url) {
						//Parse the url to add 'http://' at the beginning or '/' at the end if not already there, to avoid errors with the get_meta_tags function
						$url = parseUrl($url);
						//Get the meta data for the url
						global $tags;
						$tags = get_meta_tags($url);
				}
		}
?>
<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8" />
		<title>Liran Project</title>
		<link rel="stylesheet" href="css/style.css" type="text/css"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	</head>
	<body>
		<div class="container">
			<div id="input">
					<h1>Return Meta Tags</h1>
					<p>Input a URL in the form below and it will output the the content of the google verification token <p>
					<p>If the site does not have a token then it will output that it does not and also all of the meta tags that it does have.</p>
					<form method="get" action=<?php echo "'".$_SERVER['PHP_SELF']."'";?> >
						<input name="siteurl" type="text" placeholder="Enter URL Here"/>
						<br/>
						<input type="submit" class="submit-btn" name="submit" value="Submit"/>
						<p id = "output">
							<?php 				
							//Check to see if the google verification tag is present						
							if(isset($tags['google-site-verification']))
							{
								echo ($tags['google-site-verification']);
							}
							//if not then say that it is not present and echo out the other tags.
							else{
								echo "No Google site verification for this url<br>\n";
								print_r ($tags);
								
							}?>
						</p>
					</form>
			</div>
		</div>
		<div class="container">
				<div id="input">
						<h1>Update/Add Google Verification Meta Tag</h1>
						<p>Input the URL and meta tag token below and it will update or append to the Google Site Verification Meta tag.</p>
						<form id="update" action="index.php">
							<input id="value" name="siteurl2" type="text" placeholder="Enter URL Here"/>
							<input id="keyword" name="keyword" type="text" placeholder="Enter Keyword Here"/>
							<br/>
							<input id="submitAdd" type="submit" class="submit-btn" name="submitAdd" value="Submit"/>
							<p id="output2"></p>
						</form>
				</div>	
		</div>
		<div class="container">
				<div id="input">
						<h1>Delete Google Verification Meta Tag</h1>
						<p>Input the URL below and the Google Site Verification token will be deleted</p>
						<form id="update" action="index.php">
							<input name="siteurl" type="text" placeholder="Enter URL Here"/>
							<br/>
							<input id="submitDelete" type="submit" class="submit-btn" name="submitDelete" value="Submit"/>
							<p id="output3"></p>
						</form>
				</div>
		</div>
		<script>
				$("#submitAdd").click(function(event) 
				{
				   $keyword = $('#keyword');
				   //changes the content of the meta tag to the input value of keyword
				   $('meta[name=google-site-verification]').attr('content', $keyword.val()); 
				   $("#output2").text("Value has been updated");
				   event.preventDefault();
				}); 

				$("#submitDelete").click(function(event) 
				{
					//deletes the meta tag
					 $('meta[google-site-verification]').remove();
					 $("#output3").text("Value has been Deleted");
					 event.preventDefault();
				})			
				
		</script>
	</body>
</html>

