<?php


function createRedirect($where) {
  $s='<html><head>';
  $s.='<meta http-equiv="refresh" content="1; url='.$where.'">';
  $s.='</head><body>If you are not automatically redirected click <a href="'.$where.'">here</a>';
  $s.='</body></html>';
  return $s;
}

?>