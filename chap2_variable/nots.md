# Notes for variable


## 1 中文

在开头写入
```php
header('content-type:text/html;charset=utf-8');
```

## 2 String

```php
$username = 'king';


echo '$username', '<hr/>';
echo "$username", '<hr/>';
```


单引号不会解析，双引号会解析。
```php
$username
king
```

php 会尽可能多的取变量的名字，变量后面空格
```php
$username = 'king';

// php 会尽可能多的取变量的名字，变量后面空格
echo "username: $usernameis me.", '<hr/>';
echo "username: $username is me.", '<hr/>';

// 更好的方法是把变量放入花括号中 {}，花括号中间不要有空格。
echo "username: {$username}is me.", '<hr/>';
```