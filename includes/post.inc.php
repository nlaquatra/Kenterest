<?php 
include_once("functions.inc.php");
include_once("../config.php");
session_start();

if (isset($_POST['add-post'])) {
    //print_r($_POST);
    $title = $_POST['postName'];
    $text = $_POST['postText'];
    $file = $_POST['uploadfile'];
    //print_r($getID); debugging
    createPost($db, $title, $text, $file);
}