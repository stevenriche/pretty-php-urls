<!DOCTYPE html>
<head>

<!-- Define Charset -->
<meta charset="utf-8"/>

<!-- Responsive Metatag -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

<!-- WebSite Page Title -->
<title> Pretty PHP URLs Example </title>


<!-- Stylesheets - since we passed the $base_url variable into the controller, we can have absolute paths -->

<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/style.css"/>
 
<!-- Javascript  -->
<script type="text/javascript" src="<?php echo $base_url; ?>js/js.js"></script>

</head>
<body>
	<h1>Example Home Page</h1>
</body>
</html>