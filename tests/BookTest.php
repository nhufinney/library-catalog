<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttribues disabled
    */
    // require_once "src/Author.php";
    require_once "src/Book.php";

    $DB = new PDO('pgsql:host=localhost;dbname=library_test');

    class BookTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Book::deleteAll();
        }

        function test_getId()
        {
            //Arrange
            $id = null;
            $title = "Modern PHP";
            $test_book = new Book($id, $title);
            $test_book->save();

            //Act
            $result = $test_book->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_setId()
        {
            //Arrange
            $id = null;
            $title = "Modern PHP";
            $test_book = new Book($id, $title);
            $test_book->save();

            //Act
            $result = $test_book->setId(1);

            //Assert
            $this->assertEquals(1, $test_book->getId());
        }


        function test_getTitle()
        {
            //Arrange
            $id = null;
            $title = "Modern PHP";
            $test_book = new Book($id, $title);
            $test_book->save();

            //Act
            $result = $test_book->getTitle();

            //Assert
            $this->assertEquals("Modern PHP", $result);
        }

        function test_setTitle()
        {
            //Arrange
            $id = null;
            $title = "Modern PHP";
            $test_book = new Book($id, $title);
            $test_book->save();

            //Act
            $result = $test_book->setTitle("MySQL, PHP, and JS");

            //Assert
            $this->assertEquals("MySQL, PHP, and JS", $test_book->getTitle());
        }

        function test_getAll()
        {
            //Arrange
            $id = null;
            $title = "Modern PHP";
            $test_book = new Book($id, $title);
            $test_book->save();

            $id2 = null;
            $title2 = "MySQL, PHP, and JS";
            $test_book2 = new Book($id2, $title2);
            $test_book2->save();

            $id3 = null;
            $title3 = "Crazy PHP";
            $test_book3= new Book($id, $title3);
            $test_book3->save();

            //Act
            $result = Book::getAll();
            //Assert
            $this->assertEquals([$test_book, $test_book2, $test_book3], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $id = null;
            $title = "Modern PHP";
            $test_book = new Book($id, $title);
            $test_book->save();

            $id2 = null;
            $title2 = "MySQL, PHP, and JS";
            $test_book2 = new Book($id2, $title2);
            $test_book2->save();

            $id3 = null;
            $title3 = "Crazy PHP";
            $test_book3= new Book($id, $title3);
            $test_book3->save();

            //Act
            Book::deleteAll();
            $result = Book::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $id = null;
            $title = "Modern PHP";
            $test_book = new Book($id, $title);
            $test_book->save();

            $id2 = null;
            $title2 = "MySQL, PHP, and JS";
            $test_book2 = new Book($id2, $title2);
            $test_book2->save();

            $id3 = null;
            $title3 = "Crazy PHP";
            $test_book3= new Book($id, $title3);
            $test_book3->save();

            //Act
            $result = Book::find($test_book->getId());

            //Assert
            $this->assertEquals($test_book, $result);
        }

        function test_deleteBook()
        {
            //Arrange
            $id = null;
            $title = "Modern PHP";
            $test_book = new Book($id, $title);
            $test_book->save();

            $id2 = null;
            $title2 = "MySQL, PHP, and JS";
            $test_book2 = new Book($id2, $title2);
            $test_book2->save();

            $id3 = null;
            $title3 = "Crazy PHP";
            $test_book3= new Book($id, $title3);
            $test_book3->save();

            //Act
            $test_book2->deleteBook();
            $test_book3->deleteBook();

            $result = Book::getAll();

            //Assert
            $this->assertEquals([$test_book], $result);
        }

        function testUpdate()
        {
            //Arrange
            $id = 1;
            $title = "Modern PHP";
            $test_book = new Book($id, $title);
            $test_book->save();

            $new_book = "Crazy PHP";

            //Act
            $test_book->update($new_book);

            //Assert
            $this->assertEquals("Crazy PHP", $test_book->getTitle());
        }

        function testAddAuthor()
        {
            //Arrange
            $author = "Nhu Finney";
            $id = null;
            $test_author = new Author($id, $author);
            $test_author->save();

            $id = 1;
            $title = "Crazy PHP";
            $test_book = new Book($id, $title);
            $test_book->save();

            //Act
            $test_book->addAuthor($test_author);

            //Assert
            $this->assertEquals($test_book->getAuthors(), [$test_author]);
        }

        function testGetAuthors()
        {
            //Arrange
            $id = 1;
            $title = "Crazy PHP";
            $test_book = new Book($id, $title);
            $test_book->save();

            $author = "Nhu Finney";
            $id = null;
            $test_author = new Author($id, $author);
            $test_author->save();

            $author2 = "Liz Beacham";
            $id2 = null;
            $test_author2 = new Author($id, $author2);
            $test_author2->save();

            //Act
            $test_book->addAuthor($test_author);
            $test_book->addAuthor($test_author2);


            //Assert
            $this->assertEquals($test_book->getAuthors(), [$test_author, $test_author2]);
        }

        function testSearchBooks()
        {
            //Arrange
            $id = 1;
            $title = "Crazy PHP";
            $test_book = new Book($id, $title);
            $test_book->save();

            $id = 2;
            $title2 = "Crazy Java";
            $test_book2 = new Book($id, $title2);
            $test_book2->save();

            $id = 3;
            $title3 = "Ruby in Rail";
            $test_book3 = new Book($id, $title3);
            $test_book3->save();

            $id = 4;
            $title4 = "Crazy PHP";
            $test_book4 = new Book($id, $title4);
            $test_book4->save();


            //Act
            $search_book = "Crazy PHP";
            $result= Book::searchBooks($search_book);
            var_dump($result);

            //Assert
            $this->assertEquals([$test_book, $test_book4], $result);
        }


    }
?>
