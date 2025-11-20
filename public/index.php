
<?php
spl_autoload_register(function($c){
 foreach([__DIR__.'/../core/'.$c.'.php',__DIR__.'/../app/controllers/'.$c.'.php',__DIR__.'/../app/models/'.$c.'.php'] as $p)
  if(file_exists($p))require $p;
});
$c=$_GET['controller']??'forum';
$a=$_GET['action']??'index';
$C=ucfirst($c).'Controller';
$x=new $C;$x->$a();
