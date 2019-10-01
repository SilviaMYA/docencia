<?php

/**
 * 
 * @param type $date to format
 * @return type date with the format we specific 
 */
function showDate($date) {
    $new_date = date_create($date);
    return date_format($new_date, 'd-m-Y H:i');
}

/**
 * 
 * @param type $date to format
 * @return type date with the format we specific 
 */
function insertDate($date) {
    $new_date = date_create($date);
    return date_format($new_date, 'Y-m-d H:i');
}
/**
 * @return type all activities
 */
function getActivities() {
    $connection = to_connect();
    $result = consult($connection, "SELECT *  FROM activity INNER JOIN subject ON activity.subject_id_subject = subject.id_subject ORDER BY deadline DESC");
    disconnect($connection);
    return $result;
}

/**
 * @param type $id_activity is the activity answered
 * @return type the activity done with id $id_activity
 */
function getAnswer($id_activity) {
    $connection = to_connect();
    $result = consult($connection, "SELECT * FROM activity_done INNER JOIN user ON activity_done.user_id_user = user.id_user "
            . "INNER JOIN activity ON activity_done.activity_id_activity = activity.id_activity "
            . "WHERE activity.id_activity = '" . $id_activity . "'");
    disconnect($connection);
    return $result;
}

/**
 * @param type $id_activity is the activity answered
 * @param type $user is the user who answered the activity 
 * @return type the activity_done with id $id_activity and answered by $user 
 */
function getAnswerUser($id_activity, $user) {
    $connection = to_connect();
    $result = consult($connection, "SELECT * FROM activity_done INNER JOIN user ON activity_done.user_id_user = user.id_user "
            . "INNER JOIN activity ON activity_done.activity_id_activity = activity.id_activity "
            . "WHERE activity.id_activity = '" . $id_activity . "' AND activity_done.user_id_user = '" . $user . "'");
    disconnect($connection);
    return $result;
}

/**
 * @param type $id_activity
 * @return type the activity whit id $id_activity
 */
function getActivity($id_activity) {
    $connection = to_connect();
    $result = consult($connection, "SELECT * FROM activity WHERE id_activity='" . $id_activity . "'");
    disconnect($connection);
    return $result;
}

/**
 * 
 * @return role all users whit role = students
 */
function getStudents() {
    $connection = to_connect();
    $result = consult($connection, "SELECT * FROM user WHERE role='student'");
    disconnect($connection);
    return $result;
}

/**
 * @param type $role
 * @return users with role $role
 */
function getUser($role) {
    $connection = to_connect();
//    var_dump($connection);
//    die();
    $result = consult($connection, "SELECT * FROM user WHERE role ='" . $role . "'");
    disconnect($connection);
    return $result;
}

/**
 * @return all subjects
 */
function getSubjects() {
    $connection = to_connect();
    $query = consult($connection, "SELECT * FROM subject");

    return $query;
}

/**
 * @param type $title activity title
 * @param type $description activity description
 * @param type $created date the activity is created
 * @param type $deadline activity deadline
 * @param type $subject activity subject
 * @param type $idUser current user, must be a professor
 * @param type $edit check if is to create o edit an activity
 * @return type result of insertion or update
 */
function createActivity($title, $description, $created, $deadline, $subject, $idUser, $edit = "") {
    $connection = to_connect();
    $deadlineInsert = insertDate($deadline);

    if ($edit != "") {
        $insertion = 'UPDATE activity SET title ="' . $title . '", '
                . 'description="' . $description . '", '
                . 'date_created="' . $created . '", '
                . 'deadline="' . $deadlineInsert . '", '
                . 'subject_id_subject="' . $subject . '" WHERE id_activity ="' . $edit . '"';
    } else { //to create a new activity
        $insertion = "INSERT INTO activity (title, description, date_created, deadline, user_id_professor, subject_id_subject)";
        $insertion .= "VALUES ('" . $title . "','" . $description . "','" . $created . "','" . $deadlineInsert . "','" . $idUser . "','" . $subject . "' )";
    }

    $query = consult($connection, $insertion);
    return $query;
}


?>