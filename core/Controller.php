
<?php
class Controller {
    protected function view($v,$d=[]){$p=__DIR__.'/../app/views/'.$v.'.php';extract($d);require $p;}
    protected function json($d,$c=200){http_response_code($c);header('Content-Type: application/json');echo json_encode($d);exit;}
}
