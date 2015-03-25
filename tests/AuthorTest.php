<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttribues disabled
    */

    require_once "src/Book.php";
    require_once "src/Author.php";

    $DB = new PDO('pgsql:host=localhost;dbname=library_test');

    class AuthorTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Author::deleteAll();
        }

        function test_getId()
        {
            //Arrange
            $id = null;
            $author = "Liz";
            $test_author = new Author($id, $author);
            $test_author->save();

            //Act
            $result = $test_author->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_setId()
        {
            //Arrange
            $id = null;
            $author = "Liz";
            $test_author = new Author($id, $author);
            $test_author->save();

            //Act
            $result = $test_author->setId(1);

            //Assert
            $this->assertEquals(1, $test_author->getId());
        }


        function test_getTitle()
        {
            //Arrange
            $id = null;
            $author = "Liz";
            $test_author = new Author($id, $author);
            $test_author->save();

            //Act
            $result = $test_author->getAuthor();

            //Assert
            $this->assertEquals("Liz", $result);
        }

        function test_setAuthor()
        {
            //Arrange
            $id = null;
            $author = "Liz";
            $test_author = new Author($id, $author);
            $test_author->save();

            //Act
            $result = $test_author->setAuthor("Nhu");

            //Assert
            $this->assertEquals("Nhu", $test_author->getAuthor());
        }

        function test_getAll()
        {
            //Arrange
            $id = null;
            $author = "Liz";
            $test_author = new Author($id, $author);
            $test_author->save();

            $id2 = null;
            $author2 = "Nhu";
            $test_author2 = new Author($id2, $author2);
            $test_author2->save();

            $id3 = null;
            $author3 = "Crazy PHP";
            $test_author3= new Author($id, $author3);
            $test_author3->save();

            //Act
            $result = Author::getAll();
            //Assert
            $this->assertEquals([$test_author, $test_author2, $test_author3], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $id = null;
            $author = "Liz";
            $test_author = new Author($id, $author);
            $test_author->save();

            $id2 = null;
            $author2 = "Nhu";
            $test_author2 = new Author($id2, $author2);
            $test_author2->save();

            $id3 = null;
            $author3 = "Crazy PHP";
            $test_author3= new Author($id, $author3);
            $test_author3->save();

            //Act
            Author::deleteAll();
            $result = Author::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $id = null;
            $author = "Liz";
            $test_author = new Author($id, $author);
            $test_author->save();

            $id2 = null;
            $author2 = "Nhu";
            $test_author2 = new Author($id2, $author2);
            $test_author2->save();

            $id3 = null;
            $author3 = "Crazy PHP";
            $test_author3= new Author($id, $author3);
            $test_author3->save();

            //Act
            $result = Author::find($test_author->getId());

            //Assert
            $this->assertEquals($test_author, $result);
        }

        function test_deleteAuthor()
        {
            //Arrange
            $id = null;
            $author = "Liz";
            $test_author = new Author($id, $author);
            $test_author->save();

            $id2 = null;
            $author2 = "Nhu";
            $test_author2 = new Author($id2, $author2);
            $test_author2->save();

            $id3 = null;
            $author3 = "Crazy PHP";
            $test_author3= new Author($id, $author3);
            $test_author3->save();

            //Act
            $test_author2->deleteAuthor();
            $test_author3->deleteAuthor();

            $result = Author::getAll();

            //Assert
            $this->assertEquals([$test_author], $result);
        }

        function testUpdate()
        {
            //Arrange
            $id = 1;
            $author = "Liz";
            $test_author = new Author($id, $author);
            $test_author->save();

            $new_author = "Crazy PHP";

            //Act
            $test_author->update($new_author);

            //Assert
            $this->assertEquals("Crazy PHP", $test_author->getAuthor());
        }

        function testAddBook()
        {
            //Arrange
            $id = 1;
            $title = "Crazy PHP";
            $test_book = new Book($id, $title);
            $test_book->save();

            $id = 2;
            $title2 = "Crazy Javascript";
            $test_book2 = new Book($id, $title2);
            $test_book2->save();

            $author = "Nhu Finney";
            $id = null;
            $test_author = new Author($id, $author);
            $test_author->save();

            //Act
            $test_author->addBook($test_book);
            $test_author->addBook($test_book2);

            //Assert
            $this->assertEquals($test_author->getBooks(), [$test_book, $test_book2]);
        }

        function testGetBooks()
        {
            ///Arrange
            $id = 1;
            $title = "Crazy PHP";
            $test_book = new Book($id, $title);
            $test_book->save();

            $id = 2;
            $title2 = "Crazy Javascript";
            $test_book2 = new Book($id, $title2);
            $test_book2->save();

            $author = "Nhu Finney";
            $id = null;
            $test_author = new Author($id, $author);
            $test_author->save();


            //Act
            $test_author->addBook($test_book);
            $test_author->addBook($test_book2);


            //Assert
            $this->assertEquals($test_author->getBooks(), [$test_book, $test_book2]);
        }

    }
?>
