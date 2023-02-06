<?php

class User{
    
    private ?int $id;
    private string $first_name;
    private string $last_name;
    private string $email;
    private string $password;
    private array $posts;
    
    public function __construct(string $first_name,string $last_name,string $email,string $password){
        
        $this->id = null;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
        $this->posts = [];
        
    }
    
        public function getId() : ?int
    {
        return $this->id;
    }

    public function setId(int $id) : void
    {
        $this->id = $id;
    }
    
        public function getFirstName() : string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name) : void
    {
        $this->first_name = $first_name;
    }
    
        public function getLastName() : string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name) : void
    {
        $this->last_name = $last_name;
    }
    
        public function getEmail() : string
    {
        return $this->email;
    }

    public function setEmail(string $email) : void
    {
        $this->email = $email;
    }
    
        public function getPassword() : string
    {
        return $this->password;
    }

    public function setPassword(string $password) : void
    {
        $this->password = $password;
    }
    
    public function getPosts() : array
    {
        return $this->posts;
    }

    public function setPosts(array $posts) : void
    {
        $this->posts = $posts;
    }
    
    public function addPost(Post $post) : array
    {
        
        array_push($this->posts, $post);
        
        return $this->posts;
        
    }
    
    public function removePost(Post $post) : array
    {
        
        $updatedPosts = [];
        
        for($i=0;$i<count($this->posts);$i++){
            
            if($this->posts[$i]->getId() !== $post->getId()){
                
                array_push($updatedPosts, $this->posts[$i]);
            }
        }
        
        $this->posts = $updatedPosts;
        
    }
}