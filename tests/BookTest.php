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



    }
?>
