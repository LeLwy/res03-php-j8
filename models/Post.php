<?php

class Post{
    
    private ?int $id;
    private string $title;
    private string $content;
    private User $author;
    private PostCategory $category;
    
    public function __construct(string $title,string $content,User $author,PostCategory $category){
        
        $this->id = null;
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        $this->category = $category;
        
    }
    
        public function getId() : ?int
    {
        return $this->id;
    }

    public function setId(int $id) : void
    {
        $this->id = $id;
    }
    
        public function getTitle() : string
    {
        return $this->title;
    }

    public function setTitle(string $title) : void
    {
        $this->title = $title;
    }
    
        public function getContent() : string
    {
        return $this->content;
    }

    public function setContent(string $content) : void
    {
        $this->content = $content;
    }
    
        public function getAuthor() : User
    {
        return $author->author;
    }

    public function setAuthor(string $author) : void
    {
        $this->author = $author;
    }
    
        public function getCategory() : PostCategory
    {
        return $this->category;
    }

    public function setPassword(string $category) : void
    {
        $this->category = $category;
    }
    
}