<?php

class BulletBoardCodeParser {

    /**
     * Converts BB-Code to html
     * @param $text string the text to convert
     * @return mixed string the converted text
     */
    public static function convertToHtml($text){

        // h1
        $text =preg_replace("/\[h1\](.*)\[\/h1\]/m", "<h1>\\1</h1>", $text);

        // h2
        $text =preg_replace("/\[h2\](.*)\[\/h2\]/m", "<h2>\\1</h2>", $text);

        // h3
        $text =preg_replace("/\[h3\](.*)\[\/h3\]/m", "<h3>\\1</h3>", $text);

        // Paragraphs
        $text = preg_replace("/^([^\<].+)$/m", "<p>\\1</p>", $text);


        // Bold
        $text =  preg_replace("/\[b\](.*)\[\/b\]/Usi", "<b>\\1</b>", $text);

        // Italic

        $text =  preg_replace("/\[i\](.*)\[\/i\]/Usi", "<em>\\1</em>", $text);

        return $text;
    }
}