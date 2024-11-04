<!DOCTYPE html>
<html>
<head>
    <title>Message List</title>
</head>
<body>
    <h1>Message List</h1>
    <ul>
        <?php foreach ($messages as $message): ?>
            <li><?php echo $message->content . ' (Posted on: ' . $message->created_at . ')'; ?></li>
        <?php endforeach; ?>
    </ul>
    <a href="<?php echo site_url('messagecontroller'); ?>">Add Another Message</a>
</body>
</html>
