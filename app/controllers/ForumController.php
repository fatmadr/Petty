
<?php
require_once __DIR__.'/../../core/Controller.php';
require_once __DIR__.'/../models/Topic.php';
class ForumController extends Controller{
 private $m;
 function __construct(){$this->m=new Topic();}
 function index(){$this->view('forum/index');}
 function topics(){$this->json($this->m->all());}
 function topic(){
  $id=$_GET['id']??0;if(!$id)$this->json(['err'=>'no id'],400);
  $t=$this->m->find($id);if(!$t)$this->json(['err'=>'nf'],404);
  $this->json($t);
 }
 function create(){
  $b=json_decode(file_get_contents('php://input'),true);
  $u=['id'=>1,'username'=>'alice'];
  $this->json($this->m->create([
   'user_id'=>$u['id'],
   'username'=>$u['username'],
   'title'=>$b['title'],
   'content'=>$b['content'],
   'category'=>$b['category']??'general'
  ]),201);
 }
 function update(){
  $b=json_decode(file_get_contents('php://input'),true);
  $id=$b['id']??0;
  $this->json($this->m->updateT($id,$b));
 }
 function delete(){
  $b=json_decode(file_get_contents('php://input'),true);
  $this->json(['ok'=>$this->m->deleteT($b['id'])]);
 }
 function reply(){
  $b=json_decode(file_get_contents('php://input'),true);
  $u=['id'=>1,'username'=>'alice'];
  $this->json($this->m->reply($b['topicId'],[
   'user_id'=>$u['id'],
   'username'=>$u['username'],
   'content'=>$b['reply']['content']
  ]),201);
 }
}
