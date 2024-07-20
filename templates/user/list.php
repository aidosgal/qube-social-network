<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User List</title>
</head>
<body>
    <h1>User List</h1>
    <ul>
        <?php foreach ($users as $user): ?>
            <li>
                <a href="index.php?action=showUser&id=<?php echo htmlspecialchars($user['id']); ?>">
                    <?php echo htmlspecialchars($user['username']); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
