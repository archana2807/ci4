<html>
<head>
    <title><?= ($title)?></title>
</head>
<body>
    <h1><?= $heading ?></h1>

    <h2>My Todo List</h2>

    <ul>
    <?php foreach ($todo_list as $item): ?>

        <li><?= esc($item) ?></li>

    <?php endforeach ?>
	<?php foreach ($todo_list as $item): ?>
	<li><?= $item ?></li>
	<?php endforeach ?>
    </ul>

</body>
</html>