<?php

class BulletBoardCodeParser {

    /**
     * Converts BB-Code to html
     * @param $text string the text to convert
     * @return mixed string the converted text
     */
    public static function convertToHtml($text){

        // Bold
        $text =  preg_replace("/\[b\](.*)\[\/b\]/Usi", "<b>\\1</b>", $text);

        // Italic
        $text =  preg_replace("/\[i\](.*)\[\/i\]/Usi", "<em>\\1</em>", $text);

        // Paragraphs
        $text = "<p>$text</p>";
        $text = preg_replace("/(\r\n){2}|(\n){2}/", "</p><p>", $text); // Replace empty line

        return $text;
    }
}