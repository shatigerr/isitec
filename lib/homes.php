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
        if($courses)
        {
            foreach($courses as $item){
                $html .=    "<div class='card'>";
                $html .=    "<div class='card-header'><img src='". "$item[course_image]" . "' alt='"."$item[title]"."'></div>";
                $html .=    "<div class='card-content'>";
                $html .=    "<div><h3 class='card-title'>"."$item[title]"."</h3><p class='card-description truncate'>"."$item[description]"."</p></div>";
                $html .=    $id == null ?"<div><p class='card-date'>"."$item[publicationDate]"."</p> <a href='"."/views/courseDetails.php?id=$item[idCourse]"."'><button class='primary'>Ver más</button></a></div>" :"<div><p class='card-date'>"."$item[publicationDate]"."</p> <a href='"."/views/myCourseDetails.php?id=$item[idCourse]"."'><button class='primary'>Ver más</button></a></div>";
                $html .=    "</div></div>";
            }
    
        }
        
        return $html;
    }

    function getMyCourseById($id){
        global $db;
        $res = $db->getCourseById($id,2);
        
        $tags = strlen($res[0]["tags"])> 0 ? explode(",",$res[0]["tags"]) : "No tags";
        array_pop($tags);
        $temp = $res[0];
        $html  = "<section class='course'>";
        $html .= " <h1>"."$temp[title]"."</h1><img src='". "$temp[course_image]" . "' alt='"."$temp[title]"."'>";
        $html .= "<div class='tagContainer'>";
        if($tags != "No tags"){

            foreach($tags as $tag){
                $html .= "<span class='tag'>#$tag</span>";
            };
        }
        $html .= "</div>";
        $html .= "<div class='course_content'><div class='description'><h4>Description</h4><p>"."$temp[description]"."</p></div><div class='options'><button id='add' class='primary'>Add video</button><a href=''><button class='secondary'>Cancel</button></a></div></div></section>";
        $html .= "<section class='videos'><h2>Course videos</h2><div>";
        if($res[0]["name"] != null){

            foreach($res as  $index => $video){
                $index += 1;
                $html .= "<form class='video' method='POST' action='". $_SERVER['PHP_SELF'] ."'><p>$index - $video[name]</p><button type='submit'><i class='fa-solid fa-trash'></i></button><input name='deleted' type='hidden' course='"."$video[id]"."'><input name='id' type='hidden' value='". $temp["idCourse"] ."'></form>";
            };
        }else{
            $html .= "No videos yet</h4>";
        }

        $html .= "</div></section>";

        return $html;
    }

    function getCourseById($id){
        global $db;
        $res = $db->getCourseById($id,2);
        
        $tags = strlen($res[0]["tags"])> 0 ? explode(",",$res[0]["tags"]) : "No tags";
        array_pop($tags);
        $temp = $res[0];
        $html  = "<section class='course'>";
        $html .= " <h1>"."$temp[title]"."</h1><img src='". "$temp[course_image]" . "' alt='"."$temp[title]"."'>";
        $html .= "<div class='tagContainer'>";
        if($tags != "No tags"){

            foreach($tags as $tag){
                $html .= "<span class='tag'>#$tag</span>";
            };
        }
        $html .= "</div>";
        $html .= "<div class='course_content'><div class='description'><h4>Description</h4><p>"."$temp[description]"."</p></div><div class='form_container'><form method='POST' class='options'><button id='add' class='primary'>Enroll</button><input name='idCourse' type='hidden' value='".$id."'></form><form method='POST'><button type='submit' class='secondary'><i class='fa-solid fa-heart-circle-plus'></i></button><input name='fav' type='hidden' value='".$id."'></form></div></div></section>";
        $html .= "<section class='videos'><h2>Course videos</h2><div>";
        if($res[0]["name"] != null){

            foreach($res as  $index => $video){
                $index += 1;
                $html .= "<div><p>$index - $video[name]</p></div>";
            };
        }else{
            $html .= "No videos yet</h4>";
        }

        $html .= "</div></section>";

        return $html;
    }

    function getCourseByIdEnrolled($id){
        global $db;
        $res = $db->getCourseById($id,2);
        
        $tags = strlen($res[0]["tags"])> 0 ? explode(",",$res[0]["tags"]) : "No tags";
        array_pop($tags);
        $temp = $res[0];
        $html  = "<section class='course'>";
        $html .= " <h1>"."$temp[title]"."</h1><img src='". "$temp[course_image]" . "' alt='"."$temp[title]"."'>";
        $html .= "<div class='tagContainer'>";
        if($tags != "No tags"){

            foreach($tags as $tag){
                $html .= "<span class='tag'>#$tag</span>";
            };
        }
        $html .= "</div>";
        $html .= "<div class='course_content'><div class='description'><h4>Description</h4><p>"."$temp[description]"."</p></div><div class='options'><form method='POST'><button class='primary likes'>".$temp["likes"]."<i class='fa-regular fa-heart'></i></button><input name='likes' value='".$temp["likes"].",".$id."' type='hidden'></form><form method='POST'><button class='secondary likes'>".$temp["dislikes"]."<i class='fa-solid fa-heart-crack'></i></button><input name='dislikes' value='".$temp["dislikes"].",".$id."' type='hidden'></form><form method='POST'><button class='secondary'><i class='fa-solid fa-heart-circle-plus'></i></button><input name='fav' type='hidden' value='".$id."'></form></div></div></section>";
        $html .= "<section class='videos'><h2>Course videos</h2><div>";
        if($res[0]["name"] != null){

            foreach($res as  $index => $video){
                $index += 1;
                $html .= "<div class='video'><p>$index - $video[name]</p><a href='/views/courseVideo.php?idC=".$id."&idV=".$video["id"]."'><button class='primary'><i class='fa-solid fa-arrow-right'></i></button></a></div>";
            };
        }else{
            $html .= "No videos yet</h4>";
        }

        $html .= "</div></section>";

        return $html;
    }

    function updateFavourite($idUser,$idCourse,$value){
        global $db;

        $db->updateUserCourseLikeDislike("favourite",$value,$idUser,$idCourse);
    }

    function getVideoCourse($idCourse,$id)
    {
        global $db;

        $videos = $db->getCourseVideos($idCourse);
        $video = $db->getVideoById($id);

        $html  = "<section class='video'><h2>".$video["name"]."</h2><video id='videoPlayer' src='".$video["video"]."' controls autoplay></video><input id='idCourse' value=".$idCourse.",".$id." type='hidden'></section>";
        $html .= "<section class='videos'><h2>Course videos</h2><div>";
        foreach($videos as  $index => $vid){
            $index += 1;
            $html .= "<div class='vid'><p>$index - $vid[name]</p><a href='/views/courseVideo.php?idC=".$idCourse."&idV=".$vid["id"]."'><button class='primary'><i class='fa-solid fa-arrow-right'></i></button></a></div>";
        };
        $html .= "</div></section>";

        return $html;


    }

    function deleteVideoById($id){
        global $db;
        if($db->deleteOne("videos",$id))
        {
            return true;
        }
        return false;
    }

    function insertVideo($name,$idCourse,$filePath){
        global $db;
        $filePath = substr($filePath,2);
        $data = ["name" =>$name,"idCourse" =>$idCourse, "video"=>$filePath];
        $db->insertOne("videos",$data);
    }

    function insertUserCourse($idUser,$idCourse)
    {
        global $db;
        
        $data = ["idUser" =>$idUser,"idCourse" =>$idCourse];
        $db->insertOne("usercourse",$data);
    }

    function userEnrolled($idUser,$idCourse){
        global $db;

        return $db->userEnrolled($idCourse,$idUser);
    }

    function updateLikes(){
        global $db;
        $data = ["idUser" =>$idUser,"idCourse" =>$idCourse];
        $db->insertOne("courses",$data);
    }

    function updateLikeDislike($currLikes,$idCourse,$type,$idUser,$value,$sum){
        global $db;

        $db->updateCourseLikesDislikes($currLikes,$idCourse,$type[0],$sum);
        $db->updateUserCourseLikeDislike($type[1],$value,$idUser,$idCourse);
    }

    function selectUserCourseLikeDislike($idCourse,$idUser,$type)
    {
        global $db;
        return $db->selectUserCourseLikeDislike($idCourse,$idUser,$type);
    }

    function isVideo($file) {
        $allowedExtensions = array('mp4', 'mov', 'avi', 'mkv'); // Agrega aquí las extensiones de video permitidas
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        return in_array($fileExtension, $allowedExtensions);
    }

    function insertEndedVideo($idUser,$idCourse,$idVideo){
        global $db;
        
        $data = ["idUser" =>$idUser ,"idCourse" =>$idCourse,"idVideo" => $idVideo];
        $db->insertOne("uservideo",$data);
    }

    function getCourseAndProgress($id){
        global $db;

        $res = $db->getCourseByUserEnrolled($id);
        if($res)
        {
            $html ="<section>";

            foreach ($res as $key => $course) {
                $courseAndVideos = $db->getCourseById($course["idCourse"],2);
                $title = $courseAndVideos[0]["title"];
                $totalVideos = count($courseAndVideos);
                $totalVideosWatched = $db->getCountVideosWatched($course["idCourse"],$id);
                $ptg = ($totalVideosWatched/$totalVideos)*100;
                $html .= "<div class='card_container'><progress max='100' value=".$ptg."></progress><a href='/views/courseDetails.php?id=".$course["idCourse"]."' class='progress_card'><div class='title'><h5>$title</h5></div><div class='progress'><p>".$totalVideosWatched."/".$totalVideos."</p></div></a></div>";
            }
        }else{
            $html = "<p class='p'>You are not enrolled to any course</p>";
        }

        return $html;
    }

    function getMostLikesCourses()
    {
        global $db;
        $res = $db->getMorseLikedCourses(2);
        $html="";
        foreach($res as $item)
        {
            $html .= "<div class='section_main_info_card'><div class='section_main_info_card_div'>";
            $html.= "<h2>".$item["title"]."</h2><p class='truncate'>".$item["description"]."</p><a href='/views/courseDetails.php?id=".$item["idCourse"]."'><button class='primary'>Details</button></a></div>";
            $html .= "<div class='section_main_info_card_div'><img src='".$item["course_image"]."' alt='".$item["title"]."'></div>";    
            $html .= "</div>";
        }
        return $html;
    }

    function getCourses()
    {
        global $db;

        $res = $db->getCourses();
        $html ="";
        foreach ($res as $key => $value) {
            $html .= "<div class='card'><div class='card-header'><img src='".$value["course_image"]."' alt='".$value["title"]."'></div>";
            $html .= "<div class='card-content'><div><h3 class='card-title'>".$value["title"]."</h3><p class='card-description truncate'>".$value["description"]."</p></div>";
            $html .= "<div><p class='card-date'>".$value["publicationDate"]."</p> <a href='/views/courseDetails.php?id=".$value["idCourse"]."'><button class='primary'>Details</button></a></div></div></div>";

        }

        return $html;
    }

    function getUserEnrolledCourses($id,$search = null)
    {
        global $db;

        $res = $db->getCourseByUserEnrolled($id);
        $html ="";
        if($res)
        {

            foreach($res as $value) {
                
                $courses = $db->getCourseById($value["idCourse"]);
                foreach($courses as $course){
                    if($search)
                    {
                        if((str_contains($course["title"],$search) || str_contains($course["description"],$search) || str_contains($course["tags"],$search)))
                        {
    
                            $html .= "<div class='card'><div class='card-header'><img src='".$course["course_image"]."' alt='".$course["title"]."'></div>";
                            $html .= "<div class='card-content'><div><h3 class='card-title'>".$course["title"]."</h3><p class='card-description truncate'>".$course["description"]."</p></div>";
                            $html .= "<div><p class='card-date'>".$course["publicationDate"]."</p> <a href='/views/courseDetails.php?id=".$course["idCourse"]."'><button class='primary'>Details</button></a></div></div></div>";
                        }
                    }else{
                        $html .= "<div class='card'><div class='card-header'><img src='".$course["course_image"]."' alt='".$course["title"]."'></div>";
                        $html .= "<div class='card-content'><div><h3 class='card-title'>".$course["title"]."</h3><p class='card-description truncate'>".$course["description"]."</p></div>";
                        $html .= "<div><p class='card-date'>".$course["publicationDate"]."</p> <a href='/views/courseDetails.php?id=".$course["idCourse"]."'><button class='primary'>Details</button></a></div></div></div>";
                    }
                }
    
            }
        }

        if($html == "")
            {
                $html = "<p class='no_course'>You are not enrolled in courses</p>";
            }

        return $html;

    }

    function getCourseBySearch($search)
    {
        global $db;
        $search = strtolower($search);
        $courses = $db->getCoursesBySearch($search);
        $html="";
        if($courses){

            foreach($courses as $course){
    
                $html .= "<div class='card'><div class='card-header'><img src='".$course["course_image"]."' alt='".$course["title"]."'></div>";
                $html .= "<div class='card-content'><div><h3 class='card-title'>".$course["title"]."</h3><p class='card-description truncate'>".$course["description"]."</p></div>";
                $html .= "<div><p class='card-date'>".$course["publicationDate"]."</p> <a href='/views/courseDetails.php?id=".$course["idCourse"]."'><button class='primary'>Details</button></a></div></div></div>";
            }
        }else{
            $html = "<p class='no_course'>No courses with <b>$search</b></p>";
        }

        return $html;
    }

    function getFavouriteById($idUser,$idCourse)
    {
        global $db;

        return $db->getFavouriteById($idUser,$idCourse);
    }

    function insertFavouriteCourse($idUser,$idCourse)
    {
        global $db;
        
        $data = ["idUser" =>$idUser,"idCourse" =>$idCourse];
        $db->insertOne("favouriteCourses",$data);
    }

    function deleteFavouriteCourse($idUser,$idCourse)
    {
        global $db;
        $db->deleteFavouriteCourse($idUser,$idCourse);
    }

    function getFavouriteCourses($id,$search = null)
    {
        global $db;

        $res = $db->getFavouriteCoursess($id);
        $html ="";
        if($res)
        {

            foreach($res as $value) {
                
                $courses = $db->getCourseById($value["idCourse"]);
                foreach($courses as $course){
                    if($search)
                    {
                        if((str_contains($course["title"],$search) || str_contains($course["description"],$search) || str_contains($course["tags"],$search)))
                        {
    
                            $html .= "<div class='card'><div class='card-header'><img src='".$course["course_image"]."' alt='".$course["title"]."'></div>";
                            $html .= "<div class='card-content'><div><h3 class='card-title'>".$course["title"]."</h3><p class='card-description truncate'>".$course["description"]."</p></div>";
                            $html .= "<div><p class='card-date'>".$course["publicationDate"]."</p> <a href='/views/courseDetails.php?id=".$course["idCourse"]."'><button class='primary'>Details</button></a></div></div></div>";
                        }
                    }else{
                        $html .= "<div class='card'><div class='card-header'><img src='".$course["course_image"]."' alt='".$course["title"]."'></div>";
                        $html .= "<div class='card-content'><div><h3 class='card-title'>".$course["title"]."</h3><p class='card-description truncate'>".$course["description"]."</p></div>";
                        $html .= "<div><p class='card-date'>".$course["publicationDate"]."</p> <a href='/views/courseDetails.php?id=".$course["idCourse"]."'><button class='primary'>Details</button></a></div></div></div>";
                    }
                }
    
            }
        }

        if($html == "")
            {
                $html = "<p class='no_course'>You are not enrolled in courses</p>";
            }

        return $html;

    }

