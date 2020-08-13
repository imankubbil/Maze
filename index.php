<?php
  $getText = fopen('./text.txt', 'r');
  $index   = 0;
  $maze    = [];

  while (!feof($getText)) {
    $line = trim( fgets($getText, 4096));
    
    for ($i=0; $i < strlen($line); $i++) { 
      $maze[$index][$i] = $line[$i];
      if($line[$i] == 'S') {
        $x = $index;
        $y = $i;
      }
    }
    $index++;
  }
  
  function search($a, $b) {
    global $maze;

    if(!isset($maze[$a][$b])) { return false; }
    if($maze[$a][$b] == 'F') { return true; }
    if (($maze[$a][$b] != ' ')
    && ($maze[$a][$b] != 'S')) { return false; }

    $maze[$a][$b] = '*';

    if (search($a, $b+1)) { return true; }
    if (search($a+1, $b)) { return true; }
    if (search($a-1, $b)) { return true; }
    if (search($a, $b-1)) { return true; }

    $maze[$a][$b] = 'x';	
	  return false;
  }

  search($x, $y);
  $maze[$x][$y] = 'S';
  $output = '';

  foreach($maze as $line) {
    $output .= implode('', $line)."\n";
  }
  
  echo str_replace('x', ' ', $output);
?>