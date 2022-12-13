<?php

  function checkAndOutput($word, $suggestion) {
    global $a;
    if ($word) {
      $word = strtolower($word);
      $wordLen = strlen($word);
      
      foreach ($a as $output) {
        if (stristr($word, substr($output, 0, $wordLen))) {
          if (!$suggestion) {
            $suggestion = $output;
          } else {
            $suggestion .= ", $output";
          }
        }
      }
    }
    echo !$suggestion ? "Impossible :(" : $suggestion;
  }
  
  $a[] = 'polytech';
  $a[] = 'array';
  $a[] = 'javascript';
  $a[] = 'php';
  $a[] = 'html';
  $a[] = 'css';
  $a[] = 'blur';
  $a[] = 'programming';
  $a[] = 'Fedor';
  $a[] = 'homework';
  $a[] = 'amazing';
  $a[] = 'assessHomeworkPlease';
  $a[] = 'asparagus';
  $a[] = 'assert';
  $a[] = 'believe';
  $a[] = 'prediction';
  $a[] = 'probability';
  $a[] = 'problem';
  $a[] = 'youtube';
  $a[] = 'you';
  $a[] = 'workout';
  $a[] = 'wellness';

  // get word with xmlhttp.open()
  $word = $_GET["word"];
  $suggestion = "";
  checkAndOutput($word, $suggestion);
?>