<?php require('core/init.php'); ?>

<?php
//Create Topics Object
$topic = new Topic;

$user = new User;



//Get category from URL
$category = isset($_GET['category']) ? $_GET['category'] : null;

//Get user from URL
$user_id = isset($_GET['user']) ? $_GET['user'] : null;

//Get template and assign variables
$template = new Template('templates/topics.php');

if(isset($category)) {
    $template->topics = $topic->getByCategory($category);
    $template->title = 'Posts In '.$topic->getCategory($category)->name;
}

if(isset($user_id)) {
    $template->topics = $topic->getByUser($user_id);
    $template->title = 'Posts By ' . $user->getUser($user_id)->username;
}

if(!isset($category) && !isset($user_id)) {
    $template->topics = $topic->getAllTopics();
}

$template->totalUsers = $user->getTotalUsers();
$template->totalTopics = $topic->getTotalTopics();
$template->totalCategories = $topic->getTotalCategories();

//Display Template
echo $template;