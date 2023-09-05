<?=$this->extend("layout/master")?>

<?=$this->section("content")?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="<?= base_url('chat-login') ?>">
        <label for="email">Username:</label>
        <input type="email" name="email" id="username" ><br>
		<?php if(isset($validation)):?>
						<span id="messages" style="" class="text-danger"><?= display_error($validation,'email'); ?></span>
						 <?php endif;?>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
		<?php if(isset($validation)):?>
						<span id="messages" style="" class="text-danger"><?= display_error($validation,'password'); ?></span>
						 <?php endif;?>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
<?=$this->endSection()?>
<script>
var conn = new WebSocket('ws://localhost:8080');
conn.onopen = function(e) {
    console.log("Connection established!");
};

conn.onmessage = function(e) {
    console.log(e.data);
};
</script>
