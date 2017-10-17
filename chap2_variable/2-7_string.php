<?php 

$username = 'king';

echo $username, '<hr/>';
echo '$username', '<hr/>';
echo "$username", '<hr/>';


// He said "I'm fine."

echo 'He said "I\'m fine."', '<hr/>';
echo "He said \"I'm fine.\"", '<hr/>';

// 单引号直解析 /' 和 //
$str='!\r@\n#\t%a\\b\'c\$de';

echo $str, '<hr/>';

$str="!\r@\n#\t%a\\b\'c\$de";

echo $str, '<hr/>';

$var = 123;

echo "\$var的值为$var", '<hr/>';
echo "$var的值为$var", '<hr/>';

$username = 'king';

// php 会尽可能多的取变量的名字，变量后面空格
echo "username: $usernameis me.", '<hr/>';
echo "username: $username is me.", '<hr/>';

// 更好的方法是把变量放入花括号中 {}，花括号中间不要有空格。
echo "username: {$username}is me.", '<hr/>';

//也可以
echo "username: ${username}is me.", '<hr/>';

 ?>