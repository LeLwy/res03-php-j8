<?php

class PostCategory{
    
    private ?int $id;
    private string $name;
    private string $description;
    private array $posts;
    
    public function __construct(string $name,string $description,array $posts){
        
        $this->id = null;
        $this->name = $name;
        $this->description = $description;
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
    
        public function getName() : string
    {
        return $this->name;
    }

    public function setName(string $name) : void
    {
        $this->name = $name;
    }
    
        public function getDescription() : string
    {
        return $this->description;
    }

    public function setDescription(string $description) : void
    {
        $this->description = $description;
    }
    
    public function getPosts() : array
    {
        return $posts->posts;
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