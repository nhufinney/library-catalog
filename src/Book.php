<?php
    class Book
    {
        private $id;
        private $title;

        function __construct($id = null, $title)
        {
            $this->id = $id;
            $this->title = $title;
        }

        function setId($new_id)
        {
            $this->id = $new_id;
        }

        function getId()
        {
            return $this->id;
        }

        function setTitle($new_title)
        {
            $this->title = $new_title;
        }

        function getTitle()
        {
            return $this->title;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO books (title) VALUES ('{$this->getTitle()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        static function getAll()
        {
            $returned_books = $GLOBALS['DB']->query("SELECT * FROM books;");
            $books = array();
            foreach($returned_books as $book) {
                $id = $book['id'];
                $title = $book['title'];
                $new_book = new Book($id, $title);
                array_push($books, $new_book);
            }
            return $books;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM books *;");
        }

        static function find($search_id)
        {
            $found_books = null;
            $books = Book::getAll();
            foreach($books as $book) {
                $book_id = $book->getId();
                if ($book_id == $search_id) {
                    $found_books = $book;
                }
            }
            return $found_books;
        }

        function deleteBook()
        {
            $GLOBALS['DB']->exec("DELETE FROM books WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM books_authors WHERE book_id = {$this->getId()};");
        }

        function update($new_title)
        {
            $GLOBALS['DB']->exec("UPDATE books SET title = '{$new_title}' WHERE id = {$this->getId()};");
            $this->setTitle($new_title);
        }

        function addAuthor($author)
        {
            $GLOBALS['DB']->exec("INSERT INTO books_authors (book_id, author_id) VALUES ({$this->getId()}, {$author->getId()});");
        }

        function getAuthors()
        {
            $query = $GLOBALS['DB']->query("SELECT author_id FROM books_authors WHERE book_id = {$this->getId()};");
            $author_ids = $query->fetchAll(PDO::FETCH_ASSOC); //format author ids as an associative array.
            $authors = array();
            foreach($author_ids as $id) {
                $author_id = $id['author_id'];

                $result = $GLOBALS['DB']->query("SELECT * FROM authors WHERE id = {$author_id};");

                $returned_author = $result->fetchAll(PDO::FETCH_ASSOC);

                $new_author = new Author($returned_author[0]['id'], $returned_author[0]['author']);

                array_push($authors, $new_author);
            }
            return $authors;
        }

        static function searchBooks($search_title)
        {
            $query = $GLOBALS['DB']->query("SELECT * FROM books WHERE title LIKE '%{$search_title}%';");
            $search_books = $query->fetchAll(PDO::FETCH_ASSOC);
            $books = array();

            foreach($search_books as $book) {
                $new_book = new Book($book['id'], $book['title']);
                array_push($books, $new_book);
            }
            return $books;
        }



}

?>
