<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/important/config.inc.php"); ?>
<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/lib/new/base.php"); ?>
<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/lib/new/fetch.php"); ?>
<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/lib/new/insert.php"); ?>
<?php
    $_user_fetch_utils = new user_fetch_utils();
    $_video_fetch_utils = new video_fetch_utils();
    $_video_insert_utils = new video_insert_utils();
    $_user_insert_utils = new user_insert_utils();
    $_base_utils = new config_setup();
    
    $_base_utils->initialize_db_var($conn);
    $_video_fetch_utils->initialize_db_var($conn);
    $_video_insert_utils->initialize_db_var($conn);
    $_user_fetch_utils->initialize_db_var($conn);
    $_user_insert_utils->initialize_db_var($conn);
?>
<?php
if($_user_fetch_utils->is_admin($_SESSION['siteusername'])) {
    $_user_insert_utils->send_logs("DELETEVID " . $_GET['vid'] . " by " . $_SESSION['siteusername']);

    $stmt = $conn->prepare("DELETE FROM videos WHERE rid = ?");
    $stmt->bind_param("s", $_GET['vid']);
    $stmt->execute();
    $stmt->close();

    header("Location: /admin/");
}
?>