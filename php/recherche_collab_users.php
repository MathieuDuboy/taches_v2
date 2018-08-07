<?php
define("DB_HOST", "localhost");
define("DB_USER", "of2ds84i_robert");
define("DB_PASS", "Pm7xojnz");
define("DB_NAME", "of2ds84i_wp587");
$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($db->connect_errno > 0) {
    die('Unable to connect to database 1 [' . $db->connect_error . ']');
}
$db->set_charset("utf8");
$type_de_recherche = $_GET['type'];
$recherche         = $_GET['recherche'];
$entreprise        = $_GET['entreprise'];
global $db;
global $label_obj;
if ($type_de_recherche == 'manager') {
    $query = "SELECT * from users WHERE user_type = 'admin'";
    $result = $db->query($query) or die($db->error);
    $content = '';
    $count   = 0;
    $tab     = array();
    while ($row = $result->fetch_array()) {
        extract($row);
        $val = $first_name . ' ' . $last_name . ' / ' . $company . ' : ' . $email . ' ##Id::' . $user_id . ' - ##cid:';
        array_push($tab, $val);
    }
} else if ($type_de_recherche == 'client') {
    $query = "SELECT * from users WHERE user_type = 'client'";
    $result = $db->query($query) or die($db->error);
    $content = '';
    $count   = 0;
    $tab     = array();
    while ($row = $result->fetch_array()) {
        extract($row);
        $val = $first_name . ' ' . $last_name . ' / ' . $company . ' : ' . $email . ' ##Id::' . $user_id . ' - ##cid:';
        array_push($tab, $val);
    }
} else if ($type_de_recherche == 'tech') {
    if ($entreprise != '') {
        $query = "SELECT * from collab INNER JOIN users ON collab.collab_clientid = users.user_id WHERE collab.collab_t = 1 AND users.company = '" . $entreprise . "' ";
    } else {
        $query = "SELECT * from collab INNER JOIN users ON collab.collab_clientid = users.user_id WHERE collab.collab_t = 1";
    }
    $result = $db->query($query) or die($db->error);
    $content = '';
    $count   = 0;
    $tab     = array();
    while ($row = $result->fetch_array()) {
        extract($row);
        $val = $collab_name . ' ' . $collab_pname . ' / ' . $company . ' : ' . $collab_mail . ' ##Id::' . $collab_id . ' - ##cid:' . $collab_clientid;
        array_push($tab, $val);
    }
}
echo json_encode($tab);
?>
