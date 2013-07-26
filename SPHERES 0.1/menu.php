<!-- Copyright Philipp Grozinger GRAPHITE 2013 -->
<!-- Spheres -->

<?php
	function writeLibraries(){ // connects to the database and writes javascript objects for later parsing
		$library_connection = mysqli_connect("mysql.fhost.com.au", "u872569273_club", "leckerseaford", "u872569273_club");
		getCategoryLibrary($library_connection);
		getItemLibrary($library_connection);
		mysqli_close($library_connection);
	}
	function getCategoryLibrary($library_connection){ // writes a javascript object containing all sql data from the category library
		$request_library = "SELECT * FROM category_library";
		$library = mysqli_query($library_connection, $request_library);
		$library_array = mysqli_fetch_array($library, MYSQLI_ASSOC);
		echo "var category_library = new Object();";
		foreach ($library_array as $_category){
			echo "category_library['".$_category['cid']."'] = '".$_category['json_string']."'";
		}
		mysqli_free_result($library_array);
	}
	function getItemLibrary($library_connection){ // writes a javascript object containing all sql data from the item library
		$request_library = "SELECT * FROM item_library";
		$library = mysqli_query($library_connection, $request_library);
		$library_array = mysqli_fetch_array($library, MYSQLI_ASSOC);
		echo "var item_library = new Object();";
		foreach ($library_array as $_item){
			echo "item_library['".$_item['cid']."'] = '".$_item['json_string']."'";
		}
		mysqli_free_result($library_array);
	}
?>

<html>
	<head>
		<title><!-- php here --></title>
		<link href="global.css" rel="stylesheet" /><!-- use the global stylesheet -->
		<script src="global.js" type="text/javascript"></script><!-- use the global javascript -->
		<script type="text/javascript">
			function getMenuObject(){ // returns the menu object which contains the entirety of the parsed json
				var menu = new Object();
				for (category in catergory_library){
					category_object = parseJSON(category);
					menu[category.cid] = category;
				}
				for (item in item_library){
					item_object = parseJSON(item);
					item_category = menu[category.cid];
					item_category[item.sid] = item;
				}
				return menu;
			}
		</script>
	</head>
	<body>
		
		<!-- requires html framework for javascript to manipulate or write into -->
		<!-- PG 26/7 below is a prototype item structure, used article tag to display an item -->
		<article>
			<img src="" /><!-- feature image of the item -->
			<div>
				<h2><!-- name of the item --></h2>
				<p><!-- description of the item --></p>
				<div><!-- this is the price tag - needs further customisation --></div>
				<button>+</button>
			</div>
		</article>
		<!-- /PG 26/7 -->
	</body>
</html>