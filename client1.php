<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Client</title>

</head>
<body>
	<div textalign="center">
		<form method="post">
			<table>
				<tr>
					<td>
						<label>Enter message:s</label>
						<input type="text" name="txtMessage">
						<input type="submit" name="btnSend" value="Dergo">
					</td>
				</tr>
				
				<tr>
					<td>
						<textarea rows="8" cols="30"><?php echo @$reply;?></textarea>
					</td>
				</tr>
			</table>
		</form>
	</div>

</body>
</html>
