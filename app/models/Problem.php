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

    public function setTitle(string $title) 
    {
        $this->title = $title;
    }

    public function getTitle(): string 
    {
        return $this->title;
    }

    public function save(): bool 
    {
        if ($this->isValid()){
            $this->id = count(file(self::DB_PATH)); 
            file_put_contents(self::DB_PATH, $this->title . PHP_EOL, FILE_APPEND);
        return true;
        }
        return false;
    }

    public function isValid(): bool 
    {
        $this->errors = [];

        if (empty($this->title))
            $this->errors['title'] = 'O campo não pode estar vazio';


        return empty($this->errors);
    }

    public function hasErrors() : bool 
    {
        return empty($this->errors);
    }

    public function errors($index): string|null
    {
        if(isset($this->errors[$index]))
            return $this->errors[$index];

        return null;
    }

    public static function all() : array
    {
        $problems = file(self::DB_PATH, FILE_IGNORE_NEW_LINES);

        return array_map(function($line, $title){
            return new Problem(id: $line, title: $title);
        }, array_keys($problems), $problems);
    }

    public static function findById(int $id) : Problem|null
    {
        $problems = self::all();

        foreach ($problems as $problem) {
            if ($problem->getId() === $id)
                return $problem;
        }
        return null;
    }
}