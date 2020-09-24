<?PHP
$user_id = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_a.id = '$user_id'");
$prof_data = $db->FetchArray();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
	<link rel="SHORTCUT ICON" type="image/png" href="/assets/img/favicon.png">
        <link rel="stylesheet" type="text/css" href="/assets/cabinet/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/assets/cabinet/css/roboto.css">
        <link rel="stylesheet" type="text/css" href="/assets/cabinet/css/material-design.css">
        <link rel="stylesheet" type="text/css" href="/assets/cabinet/css/small-n-flat.css">
        <link rel="stylesheet" type="text/css" href="/assets/cabinet/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="/assets/cabinet/css/sweet-alert.css">
        <title>Мой кабинет | {!TITLE!}</title>
    </head>

<?PHP include("inc/_user_menu.php"); ?>
