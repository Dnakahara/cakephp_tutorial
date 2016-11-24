<?php

$lines = file('./default.po');
$tmpmsg = '';

foreach($lines as $line_num => $line){
	if(mb_substr($line,0,5,"utf-8")==='msgid'){
		$body = mb_substr($line,7,mb_strlen($line,"utf-8")-8,"utf-8");
		echo $body;
		echo PHP_EOL;

	}
	else if(mb_substr($line,0,6,"utf-8") === 'msgstr'){
	}
}

