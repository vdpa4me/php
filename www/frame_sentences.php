<?php
echo <<<_END
    <html lang="ko">
      <head>
      <meta charset="utf-8">
      </head>
      <frameset cols="20%,80%">
        <frame src="menu_sentences.php" name="left" scrolling="yes" noresize>
        <frame src="sentences.php?lv=1" name="right" scrolling="yes" noresize>
      </frameset>
    </html>
_END
?>