brainfuck_to_c("[>>[<<]]");
return =>
if (*p) do {\n
  p += 2;\n
  if (*p) do {\n
    p -= 2;\n
  } while (*p);\n
} while (*p);\n

<?php
function brainfuck_to_c($source_code){
  if(strlen($source_code) > 30000)return '';
  if(substr_count($source_code, '[') !== substr_count($source_code, ']'))return 'Error!';
  $ops = FuckSplit($source_code);
  $return = '';
  $level = 0;
  
  foreach ($ops[0] as $value) {
    switch ($value[0]) {
      case '-':
      case '+':
        $return .= str_repeat('  ', $level).'*p '.$value[0].'= '.strlen($value).";\n";
      break;

      case '<':
        $return .= str_repeat('  ', $level).'p -= '.strlen($value).";\n";
      break;

      case '>':
        $return .= str_repeat('  ', $level).'p += '.strlen($value).";\n";
      break;

      case '.':
        $return .= str_repeat('  ', $level)."putchar(*p);\n";
      break;

      case ',':
        $return .= str_repeat('  ', $level)."*p = getchar();\n";
      break;

      case '[':
        $return .= str_repeat('  ', $level)."if (*p) do {\n";
        $level++;
      break;

      case ']':
        if ($level == 0)return 'Error!';
        $level--;
        $return .= str_repeat('  ', $level)."} while (*p);\n";
      break;
    }
  }
  return $return;
}


function FuckSplit($source_code){
  $returnode = preg_replace('/[^-+<>,.\[\]]/', '', $source_code);
  while(preg_match('/\+-|-\+|\<\>|><|\[\]/', $returnode) > 0)
  $returnode = str_replace([' ', '-+', '+-', '<>', '><', '[]' ], '', $returnode);
  preg_match_all('/-+|\++|<+|>+|,+|\.+|\[|\]/', $returnode, $return);
  return $return;
}
