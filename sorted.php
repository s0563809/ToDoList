<?php
include 'init.php';
global $db;


    $pStmt = $db->prepare("
    select id, text, duedate, status
    from task 
    where user = :user
    order by duedate asc;
    ");

    $pStmt->execute([
        'user' => $_SESSION['user_id']
    ]);

    $rs = $pStmt->rowCount() ? $pStmt : [];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="stylesheet.css">
    <title>ToDo List</title>
</head>
<body>
<div id="list">
    <h1>To Do List</h1>
    <form name="form" action="add.php" method="post">
        <div id="inputBox">
            <input type="text" id="inputTask" name="inputTask" placeholder="Insert your task here..."
                   autocomplete="off" required>
            <input type="text" id="inputDate" name="inputDate" placeholder="Due until..." min="2020-01-01"
                   max="2030-12-31" onfocus="(this.type='date')" onblur="(this.type='text')" required>
            <input type="hidden" name="sort">
            <input type="submit" class="inputSubmit" value="Add">
        </div>
    </form>
    <br>
    <a class="inputSubmit" href="index.php">unsort</a>

    <?php if (!empty($rs)): ?>
        <ul class="items">
            <?php foreach ($rs as $value): ?>
                <li id="item<?php echo $value['status'] ? 'Done' : '' ?>">
                    <span id="text"><?php echo $value['text'] ?></span>
                    <span id="date"><?php
                        $date = strtotime($value['duedate']);
                        echo date('d.m.Y', $date);
                        ?>
                    </span>
                    <span id="buttonsRight">
                    <?php if (!$value['status']): ?>
                        <a href="mark.php?as=done&sort&id=<?php echo $value['id']; ?>" id="buttonDone">Done</a>
                    <?php endif; ?>
                        <?php if ($value['status']): ?>
                            <a href="mark.php?as=notdone&id=<?php echo $value['id']; ?>" id="buttonDone">Undo</a>
                        <?php endif; ?>
                    <a href="del.php?id=<?php echo $value['id']; ?>" id="buttonDel">X</a>
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No tasks added, so far.</p>
    <?php endif; ?>
</div>
</body>
</html>

