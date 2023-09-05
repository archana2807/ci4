
<!DOCTYPE html>
<html lang="en">
<head>
<title>CSS Template</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

</style>
</head>
<body>
<?= $validation ?>
<section>
<h1>form validation</h1>
    <?= form_open(); ?>
	name<input type="text" name="username" value=""><br>
   member <input type="text" name="member_id" value=""><br>
	<input type="submit" name="submit" value="submit">
    <?= form_close(); ?>
</section>

<footer>
  <p>Footer</p>
</footer>

</body>
</html>
