<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Edit Book</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/edit.css">
        <script src="js/buttons.js"></script>
    </head>
    <body>
        <div id="formContainer">
            <form action="edit_action.php" method="post">
                <?php
                    echo "<input type='hidden' name='bookId' value='" . $_GET["id"] . "'>";
                ?>
                <div id="headerText">Edit Book</div>
                <div id="inputRow">Title:<input type="text" id="inputField" name="title"></div>
                <div id="inputRow">Author:<input type="text" id="inputField" name="author"></div>
                <div id="inputRow">Publish Date:<input type="date" id="inputField" name="publish_date"></div>
                <div id="inputRow">ISBN<input type="text" id="inputField" name="isbn"></div>
                <input type="submit" id="submitButton" value="Edit Book">
            </form>
            <button onclick="GoToDashboard()" id="indexButton">Back to Dashboard</button>
        </div>
    </body>
</html>