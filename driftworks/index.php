<?php require('core/init.php'); ?>

<?php
//Create Topic Object
$topic = new Topic;

//Create User Object
$user = new User;

//Get template and assign variables
$template = new Template('templates/frontpage.php');

$template->topics = $topic->getAllTopics();
$template->totalUsers = $user->getTotalUsers();
$template->totalTopics = $topic->getTotalTopics();
$template->totalCategories = $topic->getTotalCategories();


//Display Template
echo $template;