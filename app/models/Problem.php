<?php

class Problem {
    const DB_PATH = '/var/www/database/problems.txt';

    private array $errors = [];

    public function __construct(
        private string $title = '', 
        private int $id = -1
    ){
        
    }

    public function setID(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setTitle(string $title) {
        $this->title = $title;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function save() {
        file_put_contents(self::DB_PATH, $this->title . PHP_EOL, FILE_APPEND);
        return true;
    }
}