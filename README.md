## What is safeContainer ?

This package disables inline javascript and css codes, javascript, css and iframe tags contained in a string data.

data:
```php
$data = '
    <img style="display:none;" src="foo.jpg" onload="something"/>
    <img onmessage="javascript:foo()"><style>body{ background-color:#000;}</style>
    <a notonmessage="nomatch-here">
    <p><script></script>
    things that are just onfoo="bar" shouldn\'t match either, outside of a tag
    </p><iframe src=".."></iframe>
';
```
**Out-of-class use:**

code:
```php
require_once('Mind.php');
$m = new Mind();
echo $m::aliyilmaz('safeContainer')->safeContainer($data);
// echo $m::aliyilmaz('safeContainer')->safeContainer($data, 'inlinecss');
// echo $m::aliyilmaz('safeContainer')->safeContainer($data, 'inlinejs');
// echo $m::aliyilmaz('safeContainer')->safeContainer($data, 'tagjs');
// echo $m::aliyilmaz('safeContainer')->safeContainer($data, 'tagcss');
// echo $m::aliyilmaz('safeContainer')->safeContainer($data, 'iframe');
// echo $m::aliyilmaz('safeContainer')->safeContainer($data, array('inlinecss', 'inlinejs', 'tagjs', 'tagcss', 'iframe'));
```

**When using it in the class:**

code:
```php
echo self::aliyilmaz('safeContainer')->safeContainer($data);
// echo self::aliyilmaz('safeContainer')->safeContainer($data, 'inlinecss');
// echo self::aliyilmaz('safeContainer')->safeContainer($data, 'inlinejs');
// echo self::aliyilmaz('safeContainer')->safeContainer($data, 'tagjs');
// echo self::aliyilmaz('safeContainer')->safeContainer($data, 'tagcss');
// echo self::aliyilmaz('safeContainer')->safeContainer($data, 'iframe');
// echo self::aliyilmaz('safeContainer')->safeContainer($data, array('inlinecss', 'inlinejs', 'tagjs', 'tagcss', 'iframe'));
```

output:
```php
// Source Code
<img style="display:none;" src="foo.jpg" onload="something"/>
    <img onmessage="javascript:foo()"><style>body{ background-color:#000;}</style>
    <a notonmessage="nomatch-here">
    <p><script></script>
    things that are just onfoo="bar" shouldn't match either, outside of a tag
    </p><iframe src=".."></iframe>
```

---

### Dependencies
1. [is_htmlspecialchars 1.0.0](https://github.com/aliyilmaz/is_htmlspecialchars)

---

### License
Instructions and files in this directory are shared under the [GPL3](https://github.com/aliyilmaz/safeContainer/blob/main/LICENSE) license.