<?php include 'filesLogic.php'; ?>


<!DOCTYPE html>
<html>
<head>
	<title>PHP File upload</title>
	<link rel="stylesheet"  href="styles.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<form action="index.php" method="post" enctype="multipart/form-data">
				<h3>Upload Files</h3>
				<input type="file" name="myfile"><br>
				<button type="submit" name="save">Subir</button>
				
			</form>
			
		</div>
		<div class="row">
			<table>

				<thead>
					<th>Nombre del archivo</th>
					<th>Tamaño (en mb)</th>
					<th>Descargar</th>
				</thead>
				<tbody>
					<?php foreach($files as $file): ?>
					<tr>
						
						<td><?php echo $file['name'];?></td>
						<td><?php echo $file['size'] /1000 ."KB";?></td>
						<td>
							<a href="index.php?file_id=<?php echo $file['id']?>">Descargar</a>
						</td>
					</tr>
				   <?php endforeach ;?>
				</tbody>
				
			</table>
			
		</div>
	</div>

</body>
</html>