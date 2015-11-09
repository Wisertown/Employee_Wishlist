<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="/assets/styles.css">
	<meta charset="utf-8">
	<title>My Wishlist</title>
</head>
<body>
	<a href="/Items/logout_user"><p>Logout</p></a>
	<h1>Hello, <?= $user['name'] ?>!</h1>
	<div id="your_wishlist">
		<h3>Your Wishlist:</h3>
		<div>
			<table border=>
				<tr>
					<th>Item</th>
					<th>Added by</th>
					<th>Date Added</th>
					<th>Action</th>
				</tr>
			<? foreach($my_list as $my_item) { ?>
				<tr>
					<td>
						<a href="/item_view/<?php $my_item['item'] ?>"><p><?= $my_item['item'] ?></p></a>
					</td>
					<td><?= $my_item['name'] ?></td>
					<?php $date = strtotime($my_item["created_at"]); ?>
					<td><?= date('M d Y', $date) ?></td>
					<td>
						<form action="/logins/remove_from_wishlist" method="post">
			        		<input type="hidden" value="<?= $my_item['id'] ?>" name="wish_id">
			        		<input type="submit" value="Remove from my Wishlist">
			        	</form>
					</td>
    			</tr>
        	<?php } ?>
        	</table>
        </div>
	</div>
	<div id="others_wishlist">
		<h3>Other Users' Wishlists</h3>
		<div>
			<table border=>
				<tr>
					<th>Item</th>
					<th>Added by</th>
					<th>Date Added</th>
					<th>Action</th>
				</tr>
			<? foreach($others_list as $others_item) { ?>
				<tr>
					<td>
						<a href="/item_view/<?= $others_item['item'] ?>"><p><?= $others_item['item'] ?></p></a>
					</td>
					<td><?= $others_item['name'] ?></td>
					<?php $date = strtotime($others_item['created_at']); ?>
					<td><?= date('M d Y', $date) ?></td>
					<td>
						<form action="/Items/add_to_wishlist" method="post">
			        		<input type="hidden" value="<?= $others_item['id'] ?>" name="item_id">
			        		<input type="submit" value="Add to my Wishlist">
			        	</form>
					</td>
        		</tr>
        	<?php } ?>
        	</table>
        </div>
	</div>
	<a href="/add_item_view"><button>Add Item</button></a>
</body>
</html>