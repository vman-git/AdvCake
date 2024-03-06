<?php
// Техническое задание
// Напиши метод, который принимает на вход строку и меняет порядок букв в каждом слове на обратный с сохранением регистра и пунктуации.

// Например:
// $result = revertCharacters("Привет! Давно не виделись.");
// echo $result; // Тевирп! Онвад ен ьсиледив.

// Также напиши unit-тесты для этого метода.
class StringManipulation
{
    public function __construct(){
        mb_regex_encoding('UTF-8');
    }
    public function revertCharacters(string $strSample){
        $words = mb_split("\s", $strSample); //Получаем массив слов
        $result = "";
        foreach ($words as $word){
            $word = mb_str_split($word); //Получаем из слова массив чаров
            $word = array_reverse($word); //Реверсируем массив чаров
            $word = $this->getStringFromCharArray($word); //Получаем слово из массива чаров
            $word = $this->transferPunctuationMarks($word); //Переносим знаки препинания, если необходимо
            $word = $this->transferCapitalLetter($word); //Начинаем слово с заглавной буквы, если необходимо
            $result .= $word." "; //Получаем инвертированную строку
        }
        $result = rtrim($result); //Обрезаем лишний пробел
        return $result;
    }

    private function getStringFromCharArray(array $arr){
        $result = "";
        for ($i = 0; $i < count($arr); $i++) {
            $result .= $arr[$i];
        }
        return $result;
    }
    
    private function transferCapitalLetter(string $strSample){
        $result = $strSample;
        if (mb_ereg('[А-ЯA-Z]', $strSample)) {
            $result = mb_strtolower($strSample);
            $result = mb_strtoupper(mb_str_split($result)[0]).mb_substr($result, 1);
        }
        return $result;
    }
    
    private function transferPunctuationMarks(string $strSample){
        $result = $strSample;
        $charArray = mb_str_split($result);
        $marks = [];
        $chars = [];
        for($i = 0; $i < count($charArray); $i++) {
            if (mb_ereg('[!.,]', $charArray[$i])){
                array_push($marks,$charArray[$i]);
            } else {
                array_push($chars,$charArray[$i]);
            }  
        }
        $marks = array_reverse($marks);
        $res = array_merge($chars, $marks);    
        $result = $this->getStringFromCharArray($res);
        return $result;
    }


}