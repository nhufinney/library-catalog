<?php
    class Book
    {
        private $id;
        private $title;

        function __construct($id, $title)
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
    }

?>
