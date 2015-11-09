<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="/assets/styles.css">
	<meta charset="utf-8">
	<title><?= $wishers[0]['item'] ?></title>
</head>
<body>
	<a href="/dashboard"><p>Home</p></a>
	<a href="/Items/logout_user"><p>Logout</p></a>
	<div id="wrapper">
		<h1><?= $wishers[0]['item'] ?></h1>
		<h3>Users who added this product/item under their wishlist:</h3>
		<div>
			<?php foreach($wishers as $wisher) { ?>
				<p><?= $wisher['name'] ?></p>
        	<?php } ?>
		</div>
	</div>
</body>
</html>