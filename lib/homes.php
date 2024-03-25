<?php
    include_once "../db/db.php";

    $db = new DB();

    function getUserData($username){
        global $db;
        return $db->getUserDataByuserOrMail($username);
    }

    function getNewCourses($id = null)
    {
        global $db;
        $courses = $id == null ? $db->getCourses(3) : $db->getCourseByAuthor($id);
        $html="";
        foreach($courses as $item){
            $html .=    "<div class='card'>";
            $html .=    "<div class='card-header'><img src='". "$item[course_image]" . "' alt='"."$item[title]"."'></div>";
            $html .=    "<div class='card-content'>";
            $html .=    "<div><h3 class='card-title'>"."$item[title]"."</h3><p class='card-description truncate'>"."$item[description]"."</p></div>";
            $html .=    $id == null ?"<div><p class='card-date'>"."$item[publicationDate]"."</p> <a href='"."/views/courseDetails.php?id=$item[idCourse]"."'><button class='primary'>Ver más</button></a></div>" :"<div><p class='card-date'>"."$item[publicationDate]"."</p> <a href='"."/views/myCourseDetails.php?id=$item[idCourse]"."'><button class='primary'>Ver más</button></a></div>";
            $html .=    "</div></div>";
        }

        return $html;
    }

?>


    


