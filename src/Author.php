<?php
    class Author
    {
        private $id;
        private $author;

        function __construct($id, $author)
        {
            $this->id = $id;
            $this->author = $author;
        }

        function setId($new_id)
        {
            $this->id = $new_id;
        }

        function getId()
        {
            return $this->id;
        }

        function setAuthor($new_author)
        {
            $this->author = $new_author;
        }

        function getAuthor()
        {
            return $this->author;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO authors (author) VALUES ('{$this->getAuthor()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        static function getAll()
        {
            $returned_authors = $GLOBALS['DB']->query("SELECT * FROM authors;");
            $authors = array();
            foreach($returned_authors as $author) {
                $id = $author['id'];
                $author = $author['author'];
                $new_author = new Author($id, $author);
                array_push($authors, $new_author);
            }
            return $authors;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM authors *;");
        }

        static function find($search_id)
        {
            $found_authors = null;
            $authors = Author::getAll();
            foreach($authors as $author) {
                $author_id = $author->getId();
                if ($author_id == $search_id) {
                    $found_authors = $author;
                }
            }
            return $found_authors;
        }

        function deleteAuthor()
        {
            $GLOBALS['DB']->exec("DELETE FROM authors WHERE id = {$this->getId()};");
        }

        function update($new_author)
        {
            $GLOBALS['DB']->exec("UPDATE authors SET author = '{$new_author}' WHERE id = {$this->getId()};");
            $this->setAuthor($new_author);
        }

    }

?>
