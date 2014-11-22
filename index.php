<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Add a new site pattern</title>
<link rel="stylesheet" type="text/css" href="view.css" media="all">
<script type="text/javascript" src="view.js"></script>
<style type="text/css">
.tag_cloud { padding: 3px; text-decoration: none; }
.tag_cloud:link  { color: #81d601; }
.tag_cloud:visited { color: #019c05; }
.tag_cloud:hover { color: #ffffff; background: #69da03; }
.tag_cloud:active { color: #ffffff; background: #ACFC65; }
</style>
</head>
<body id="main_body" >
<?php 
	include_once 'config.inc.php';
	include_once 'analyticstracking.php';
?>
<?php function get_tag_data() {
    $arr = Array('Pirate Bay' => 35, 'Kickass Torrents' => 22, 'Primewire' => 44, 'EZTV' => 43, 
	'BayIMG' => 18, 'BeeMP3' => 33, 'FileServe' => 15, 'Newzbin' => 11, 'Vlooz' => 42, 
	'TorLock' => 13);
    return $arr;
}
function get_tag_cloud() {
// Default font sizes
$min_font_size = 14;
$max_font_size = 30;
// Pull in tag data
$tags = get_tag_data();
// Get weights and spread tags
$minimum_count = min(array_values($tags));
$maximum_count = max(array_values($tags));
$spread = $maximum_count - $minimum_count;

if($spread == 0) {
    $spread = 2;
}

$cloud_html = '';
$cloud_tags = array(); // create an array to hold tag code
foreach ($tags as $tag => $count) {
	$size = $min_font_size + ($count - $minimum_count) 
		* ($max_font_size - $min_font_size) / $spread;
	$cloud_tags[] = '<a style="padding-top:3px;font-size: '. floor($size) . 'px' 
		. '" class="tag_cloud" href="http://www.google.com/search?q=' . $tag 
		. '" title="\'' . $tag  . '\' returned a count of ' . $count . '">' 
		. htmlspecialchars(stripslashes($tag)) . '</a>';
}
shuffle($cloud_tags);
$cloud_html = join("\n", $cloud_tags) . "\n";
return $cloud_html;
}
?>
	<img id="top" src="top.png" alt="">
	<div id="form_container">
	
	  <h1><a>Add a new site pattern</a></h1>
		<form id="addsite" class="appnitro"  method="post" action="update.php">
					<div class="form_description">
			<h2>Add a new site to the list!</h2>
			<!-- BEGIN Tag Cloud -->
				<div style="padding: 10px 0px 10px 0px; min-height:70px;"><?php print get_tag_cloud(); ?></div>
			<!-- END Tag Cloud -->
			<p>If you believe that we have missed a site please send an email to <a href="mailto:<?php echo $EMAIL?>"><?php echo $EMAIL?><a> with the site's url and a screenshot of the block  screen. Please note we will only add censored content to this list. We will also only add sites with content that does not breach  our moral code; we will not entertain requests to sites on child protection lists. To use this list you will need to <a href="http://getfoxyproxy.org/subscriptions/patterns/import.html" title="help adding a new pattern subscription" target="new">add a pattern subscription</a> in  <a href="http://getfoxyproxy.org/downloads.html" title="FoxyProxy Standard Download" target="new">FoxyProxy Standard</a> that points to <b><?php echo $HOST ?>patterns.json</b> with a refresh  time of no less than 200 minutes. For best results we recommend the latest version of <a href="https://www.mozilla.org/en-GB/firefox/new/">Mozilla Firefox!<a> Need <a href="<?php echo $HOST ?>help.html" title="help adding a new pattern subscription" target="new">Help?</a> </p>
			<p>At a minimum; this list will contain all sites listed on <a href="http://en.wikipedia.org/wiki/Websites_blocked_in_the_United_Kingdom">this wiki page<a> that have been continuously blocked for 28 days or more.
</div>						
			<ul >
			
					<li id="li_1" >
		<label class="description" for="name">Site Name <inline class="Ast">*</inline></label>
		<div>
		  <input id="name" name="name" class="element text medium" type="text" maxlength="255" value="Site" required="required"/>
		</div><p class="guidelines" id="guide_1"><small>What is the name of the site you wish to add</small></p> 
		</li>		<li id="li_2" >
		<label class="description" for="domain">Site Domain <inline class="Ast">*</inline></label>
		<div>
			<input id="domain" name="domain" class="element text large" type="text" maxlength="255" value="example" required="required"/> 
		</div><p class="guidelines" id="guide_2"><small>What is the domain name for this site without the subdomain or TLD? For example for http://www.subdomin.example.com/index you should only put "example" here. </small></p> 
		</li>		<li id="li_3" >
		<label class="description" for="element_3">TLD  <inline class="Ast">*</inline></label>
		<div>
			<input id="tld" name="tld" class="element text medium" type="text" maxlength="255" value="com" required="required"/> 
		</div><p class="guidelines" id="guide_3"><small>What is the Top-level Domain for this site? For example for http://www.subdomin.example.com/index you should only put "com" here.  </small></p> 
		</li>		<li id="li_4" style="padding-top:20px;" >
		<label class="description" for="password">Password  <inline class="Ast">*</inline></label>
		<div>
			<input id="password" name="password" class="element text large" type="password" maxlength="255" value="" required="required"/> 
		</div><p class="guidelines" id="guide_4"><small>Enter the administration password to add a new site. This is to stop abuse. </small></p> 
		</li>
			
					<li class="buttons"></li>
					<span class="buttons">
					<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
					</span>
			</ul>
		</form>
      <div><p class="Ast" style="text-align:left;">&nbsp;&nbsp;&nbsp; * Required</p>	
		</div><div id="footer">
		  <a href="<?php echo $HOST ?>file.php" title="JSON Parsed!" target="_self">Update JSON?</a> | <a href="<?php echo $HOST ?>all.php" title="All listed sites!" target="_self">View all sites?</a>
		</div>
	</div>
	<img id="bottom" src="bottom.png" alt="">
	</body>
</html>
