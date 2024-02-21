/*
 function that accepts a 2D array representing a Sudoku board, and returns true if it is a valid solution, or false otherwise.
*/

<?php
  function valid_solution(array $m): bool {
    for($i = 0; $i < 9; $i++){
        for($j = 0; $j < 9; $j++){
          $squares = [0, 3, 6];
          if(in_array($i, $squares) && in_array($j, $squares)){
             $square = [];
             for($f = 0; $f < 3; $f++){
               $cell = $i + $f;
               $square[] = $m[$cell][$j];
               $square[] = $m[$cell][$j+1];
               $square[] = $m[$cell][$j+2];
             } 
             if(count(array_unique($square)) < 9)return false;
          }
        }
      return true;
    }
  }
?>
