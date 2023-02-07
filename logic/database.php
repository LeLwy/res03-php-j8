<?php

/********** REQUIRE **********/

require 'models/User.php';
require 'models/Post.php';
require 'models/PostCategory.php';

/********** CONNECTION À LA BASE DE DONNÉES **********/

$host = "db.3wa.io";
$port = "3306";
$dbname = "louischancioux_phpj8";
$connexionString = "mysql:host=$host;port=$port;dbname=$dbname";

$user = "louischancioux";
$password = "e1657392b3cd3a9bb9acef7eddd5a20c";

$db = new PDO(
    $connexionString,
    $user,
    $password,
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
);

/********** FONCTIONS USER **********/

function loadUser(string $email, PDO $db) : ?User
{
    
    $query = $db->prepare('SELECT * FROM users WHERE email = :email');

    $parameters = [
    'email' => $email
    ];

    $query->execute($parameters);
    
    $user = $query->fetch(PDO::FETCH_ASSOC);
    
    if($user === false){
        
        return null;
        
    }else{
        
        $loggedUser = new User($user['first_name'], $user['last_name'], $user['email'], $user['password']);
        $loggedUser->setId($user['id']);
        
        
        return $loggedUser;
    }
    
}

function saveUser(User $user, PDO $db) : User
{
    
    $query = $db->prepare('INSERT INTO users VALUES(NULL, :first_name, :last_name, :email, :password)');

    $parameters = [
    'first_name' => $user->getFirstName(),
    'last_name' => $user->getLastName(),
    'email' => $user->getEmail(),
    'password' => $user->getPassword(),
    ];

    $query->execute($parameters);
    
    return loadUser($user->getEmail(), $db);
}

function loadUserById(int $id, PDO $db) : User
{
    $query = $db->prepare('SELECT * FROM users WHERE id = :id');
    $parameters = [
    'id' => $id
    ];
    $query->execute($parameters);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if($user === false) {
        return null;
    }
    else
    {
        $logUser = new User($user['first_name'], $user['last_name'], $user['email'], $user['password']);
        $logUser->setId($user['id']);

        return $logUser;
    }
}

/********** FONCTIONS POST **********/

function loadPostsFromDb(PDO $db)
{
    
    $query = $db->prepare('SELECT * FROM posts');
    $query->execute();
    
    $allPosts -> fetch(PDO::FETCH_ASSOC);
    
    $allPostsArray = [];
    
    foreach($allPosts as $post){
        
        $newPost = new Post($post['title'],$post['content'],loadUserById($post['author'], $db),loadPostCategory($post['category'], $db));
        $allPostsArray[] = $newPost;
    }
    
    return $allPostsArray;
}

function loadPostById(int $id, PDO $db) : ?Post
{
    
    $query = $db->prepare('SELECT * FROM posts WHERE id = :id');

    $parameters = [
    'id' => $id
    ];

    $query->execute($parameters);
    
    $post = $query->fetch(PDO::FETCH_ASSOC);
    
    if($post === false){
        
        return null;
        
    }else{
        
        $loadedPost = new Post($post['title'], $post['content'], $post['author'], $post['category']);
        $loadedPost->setId($post['id']);
        
        
        return $loadedPost;
    }
    
}

function createPost(Post $post, PDO $db) : Post
{
    
    $query = $db->prepare('INSERT INTO posts VALUES(NULL, :title, :content, :author, :category)');

    $parameters = [
    'title' => $post->getTitle(),
    'content' => $post->getContent(),
    'category' => $post->getCategory(),
    'author' => $post->getAuthor(),
    ];

    $query->execute($parameters);
    
    return loadPost($post->getId(), $db);
}

/********** FONCTIONS POSTCATEGORY **********/

function loadPostCategoriesFromDb(PDO $db)
{
    
    $query = $db->prepare('SELECT * FROM post_categories');
    $query->execute();
    
    $allPostCategories -> fetch(PDO::FETCH_ASSOC);
    
    $allPostCategoriesArray = [];
    
    foreach($allPostCategories as $postCategory){
        
        $newPostCategory = new Post($postCategory['title'],$postCategory['description']);
        $allPostCategoriesArray[] = $newPostCategory;
    }
    
    return $allPostCategoriesArray;
}

function loadPostCategoryById(int $id, PDO $db) : PostCategory
{
    $query = $db->prepare('SELECT * FROM post_categories WHERE id = :id');
    $parameters = [
    'id' => $id
    ];
    $query->execute($parameters);
    $postCategory = $query->fetch(PDO::FETCH_ASSOC);

    if($postCategory === false) {
        return null;
    }
    else
    {
        $newPostCategory = new PostCategory($postCategory['name'], $postCategory['description']);
        $newPostCategory->setId($postCategory['id']);

        return $newPostCategory;
    }
}

function createPostCategory(PostCategory $postCategory, PDO $db) : PostCategory
{
    
    $query = $db->prepare('INSERT INTO post_categories VALUES(NULL, :name, :description)');

    $parameters = [
    'name' => $postCategory->getName(),
    'description' => $postCategory->getDescription()
    ];

    $query->execute($parameters);
    
    return loadPostCategory($postCategory->getId(), $db);
}