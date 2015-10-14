<?php
/*
 * This class provides methods to handle articles
 */
class article_service {

    public function get_all(){

        #Testdaten
        $article1 = new Article('1', 'Test1', 'Pati', array('PHP', 'HTML'), 'Das ist ein unglaublich beschissener Blogeintrag');
        $article2 = new Article('2', 'Test2', 'Pati', array('CSS', 'JS'), 'Und hier kommt auch schon der nächste nicht ganz so beschissene Eintrag');
        $article3 = new Article('3', 'Test3', 'Andi', array('CSS', 'JS', 'PHP', 'HTML'), 'Andis Eintrag is ebenfalls nicht berauschend');

        $articles = array(
            $article1->get_id() => $article1,
            $article2->get_id() => $article2,
            $article3->get_id() => $article3
        );

        return $articles;
    }

    public function add_article($article){

    }

    public function remove_article(){

    }
}