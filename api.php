<!DOCTYPE html>
<?php
	include('header.php');
	include('db.php');
?>
<html>
	<head>
		<style>
		html {
			background: #E6E1DF;
			color: black;
			font-size: 20px;
			font-family: verdana;
		}
		.content {
			width: 80%;
			margin-left: auto;
			margin-right: auto;
		}
		table {
			width: 100%;
			border-collapse: collapse;
			border: 3px solid black;
		}
		tr, td {
			text-align: center;
		}
		img {
			padding: 1em;
		}
		</style>
	</head>
	<?php
			$url = 'photos.json';
			$jsondata = file_get_contents($url);
			$data = json_decode($jsondata);
			foreach($data as $final) {
				$albumId = $final->albumId;
				$id = $final->id;
				$title = $final->title;
				$url = $final->url;
				$thumbnailUrl = $final->thumbnailUrl;
				$query = "INSERT INTO data VALUES ('$albumId','$id','$title','$url','$thumbnailUrl')";
				if(mysqli_query($conn, $query))
					echo "";
			}
			$url2 = 'users.json';
			$jsondata2 = file_get_contents($url2);
			$data2 = json_decode($jsondata2);
			foreach($data2 as $final2) {
				$id = $final2->id;
				$name = $final2->name;
				$username = $final2->username;
				$email = $final2->email;
				$street = $final2->address->street;
				$suite = $final2->address->suite;
				$city = $final2->address->city;
				$zipcode = $final2->address->zipcode;
				$lat = $final2->address->geo->lat;
				$lng = $final2->address->geo->lng;
				$phone = $final2->phone;
				$website = $final2->website;
				$cname = $final2->company->name;
				$catchPhrase = $final2->company->catchPhrase;
				$bs = $final2->company->bs;
				$query2 = "INSERT INTO users VALUES ('$id','$name','$username','$email','$street','$suite','$city','$zipcode','$lat','$lng','$phone','$website','$cname','$catchPhrase','$bs')";
				if(mysqli_query($conn, $query2))
					echo "";
			}
	?>
	<body class="content">
		<input type = "hidden" name = "id" value = "<?php echo $_POST['id']; ?>">
		<?php
			$id = $_POST['id'];
			$query_search = "SELECT * FROM data WHERE id = $id";
			$result = mysqli_query($conn, $query_search);
			$row = mysqli_fetch_assoc($result);
			$count = mysqli_num_rows($result);
			if($count==1) {
		?>
		<h2>API 1</h2>
		<table border = 1>
		<tr><td><b>Album ID:</b></td> <td><p><?php echo $row['albumId'];?></p></td></tr> 
		<tr><td><b>ID:</b></td> <td><p><?php echo $row['id'];?></p></td></tr>
		<tr><td><b>Title:</b></td> <td><p><?php echo $row['title'];?></p></td></tr>
		<tr><td><b>URL:</b></td> <td><p><img src="<?php echo $row['url'];?>"></p></td></tr>
		<tr><td><b>Thumbnail URL:</b></td> <td><p><img src="<?php echo $row['thumbnailUrl'];?>"></p></td></tr>
		<?php
			}
			else {
				echo "<p style='color:red';>"."No records found"."</p>";
			}
		?>
		<?php
			$id = $_POST['id'];
			$query_search2 = "SELECT * FROM users WHERE id = $id";
			$result2 = mysqli_query($conn, $query_search2);
			$row2 = mysqli_fetch_assoc($result2);
			$count2 = mysqli_num_rows($result2);
			if($count2==1) {
		?>
		</table>
		<h2> API 2 </h2>
		<table border = 1>
		<tr><td><b>ID:</b></td> <td><p><?php echo $row2['id'];?></p></td></tr> 
		<tr><td><b>Name:</b></td> <td><p><?php echo $row2['name'];?></p></td></tr> 
		<tr><td><b>Username:</b></td> <td><p><?php echo $row2['username'];?></p></td></tr> 
		<tr><td><b>Email:</b></td> <td><p><?php echo $row2['email'];?></p></td></tr> 
		<tr><td><b>Address:</b></td> 
		<td>
		<b>Street: </b><p><?php echo $row2['street'];?></p>
		<b>Suite: </b><p><?php echo $row2['suite'];?></p>
		<b>City: </b><p><?php echo $row2['city'];?></p>
		<b>Zipcode: </b><p><?php echo $row2['zipcode'];?></p>
		</td>
		</tr> 
		<tr><td><b>Geography:</b></td> 
		<td>
		<b>Latitude: </b><p><?php echo $row2['lat'];?></p> 
		<b>Longitude: </b><p><?php echo $row2['lng'];?></p>
		</td>
		</tr> 
		<tr><td><b>Phone:</b></td> <td><p><?php echo $row2['phone'];?></p></td></tr> 
		<tr><td><b>Website:</b></td> <td><p><?php echo $row2['website'];?></p></td></tr> 
		<tr><td><b>Comapny:</b></td> 
		<td>
		<b>Name: </b><p><?php echo $row2['cname'];?></p> </br>
		<b>Catch Phrase: </b><p><?php echo $row2['catchPhrase'];?></p> </br>
		<b>BS: </b><p><?php echo $row2['bs'];?></p></td></tr> 
		</table>
		<?php
			}
			else {
				echo "";
			}
		?>
	</body>
</html>