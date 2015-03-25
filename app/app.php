<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Book.php";
    require_once __DIR__."/../src/Author.php";

    $app = new Silex\Application();
    $app['debug'] = true;

    $DB = new PDO('pgsql:host=localhost;dbname=library');

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();


    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

//BOOKS**************************
    $app->get("/books", function() use ($app) {
        return $app['twig']->render('books.html.twig', array('books' => Book::getAll(), 'found_books'=>[]));
    });

    $app->post("/books", function() use ($app) {
        $title = $_POST['title'];
        $id = null;
        $book = new Book($id, $title);
        $book->save();
        return $app['twig']->render('books.html.twig', array('books' => Book::getAll(), 'found_books'=>[]));
    });

    $app->delete("/delete_books", function() use ($app){
        Book::deleteAll();
        return $app['twig']->render('index.html.twig');
    });

    $app->get("/books/{id}", function($id) use ($app) {
        $book = Book::find($id);
        return $app['twig']->render('book.html.twig', array('book' => $book, 'authors' => $book->getAuthors(), 'all_authors' => Author::getAll()));
    });

    $app->get("/books/{id}/edit", function($id) use ($app) {
        $book = Book::find($id);
        return $app['twig']->render('book_edit.html.twig', array('book' => $book));
    });

    $app->patch("/books/{id}", function($id) use ($app) {
        $book_edited = $_POST['book'];
        $book = Book::find($id);
        $book->update($book_edited);
        return $app['twig']->render('book_edit.html.twig', array('book' => $book, 'authors' => $book->getAuthors(), 'all_authors' => Author::getAll()));
    });

    $app->delete("/delete_books", function() use ($app){
        Book::deleteAll();
        return $app['twig']->render('index.html.twig');
    });

    $app->delete("/books/{id}", function($id) use ($app){
       $book = Book::find($id);
       $book->deleteBook();
       return $app['twig']->render('books.html.twig', array('books' => Book::getAll()));
   });

   // $app->get("/search", function() use ($app){
   //    $search_book = $_GET['search'];
   //    $found_books = Book::searchBooks($search_book);
   //
   //    return $app['twig']->render('books.html.twig', array('books' => Book::getAll() ,  'found_books'=>$found_books));
   // });
   // $app->get("/search", function() use ($app){
   //    $search_book = $_GET['search'];
   //
   //    $query = $GLOBALS['DB']->query("SELECT * FROM books WHERE title LIKE '%$search_book%';");
   //    $returned_books = $query->fetchAll(PDO::FETCH_ASSOC);
   //    $books = array();
   //
   //    foreach($returned_books as $book)
   //    {
   //        $id = $book['id'];
   //        $title = $book['title'];
   //        $new_book = new Book($id, $title);
   //        array_push($books, $new_book);
   //    }
   //    return $books;
   //    if (count($books) == 0)
   //    {
   //        $query = $GLOBALS['DB']->query("SELECT * FROM authors WHERE author LIKE '%$search_book%';");
   //        $returned_authors = $query->fetchAll(PDO::FETCH_ASSOC);
   //        foreach($returned_authors as $author)
   //        {
   //            $id = $author['id'];
   //            $author = $author['author'];
   //            $new_author = new Author($id, $author);
   //            array_push($books, $new_author);
   //        }
   //        return $books;
   //    }
   //
   //      }
   //
   // });

   $app->post("/add_books", function() use ($app) {
       $book = Book::find($_POST['book_id']);
       $author = Author::find($_POST['author_id']);
       $author->addBook($book);
       return $app['twig']->render('author.html.twig', array('author' =>$author, 'authors'=> Author::getAll(), 'books' => $author->getBooks(), 'all_books'=> Book::getAll()));
   });



//AUTHORS*********************************
    $app->get("/authors", function() use ($app) {
        return $app['twig']->render('authors.html.twig', array('authors' => Author::getAll()));
    });

    $app->post("/authors", function() use ($app) {
        $author = $_POST['author'];
        $id = null;
        $author = new Author($id, $author);
        $author->save();
        return $app['twig']->render('authors.html.twig', array('authors' => Author::getAll()));
    });

    $app->delete("/delete_authors", function() use ($app){
        Author::deleteAll();
        return $app['twig']->render('index.html.twig');
    });

    $app->get("/authors/{id}", function($id) use ($app) {
        $author = Author::find($id);
        return $app['twig']->render('author.html.twig', array('author' => $author, 'books' => $author->getBooks(), 'all_books' => Book::getAll()));
    });

    $app->get("/authors/{id}/edit", function($id) use ($app) {
        $author = Author::find($id);
        return $app['twig']->render('author_edit.html.twig', array('author' => $author));
    });

    $app->patch("/authors/{id}", function($id) use ($app) {
        $author_edited = $_POST['author'];
        $author = Author::find($id);
        $author->update($author_edited);
        return $app['twig']->render('author_edit.html.twig', array('author' => $author, 'books' => $author->getBooks(), 'all_books' => Book::getAll()));
    });

    $app->delete("/delete_authors", function() use ($app){
        Author::deleteAll();
        return $app['twig']->render('index.html.twig');
    });

    $app->delete("/authors/{id}", function($id) use ($app){
        $author = Author::find($id);
        $author->deleteAuthor();
        return $app['twig']->render('authors.html.twig', array('authors' => Author::getAll()));
    });




    return $app;
?>
