
<?php
require_once __DIR__.'/../../core/Database.php';
class Topic{
 private $db;
 function __construct(){$this->db=Database::getInstance();}
 function all(){
  $t=$this->db->query("SELECT * FROM topics ORDER BY created_at DESC")->fetchAll();
  foreach($t as &$x){$x['replies']=$this->replies($x['id']);}
  return $t;
 }
 function find($id){
  $s=$this->db->prepare("SELECT * FROM topics WHERE id=?");
  $s->execute([$id]);$t=$s->fetch();
  if(!$t)return null;$t['replies']=$this->replies($id);return $t;
 }
 function create($d){
  $s=$this->db->prepare("INSERT INTO topics(user_id,username,title,content,category,created_at) VALUES(?,?,?,?,?,NOW())");
  $s->execute([$d['user_id'],$d['username'],$d['title'],$d['content'],$d['category']]);
  return $this->find($this->db->lastInsertId());
 }
 function updateT($id,$d){
  $s=$this->db->prepare("UPDATE topics SET title=?,content=?,category=?,updated_at=NOW() WHERE id=?");
  $s->execute([$d['title'],$d['content'],$d['category'],$id]);
  return $this->find($id);
 }
 function deleteT($id){
  $this->db->prepare("DELETE FROM replies WHERE topic_id=?")->execute([$id]);
  return $this->db->prepare("DELETE FROM topics WHERE id=?")->execute([$id]);
 }
 function reply($tid,$d){
  $s=$this->db->prepare("INSERT INTO replies(topic_id,user_id,username,content,created_at) VALUES(?,?,?,?,NOW())");
  $s->execute([$tid,$d['user_id'],$d['username'],$d['content']]);
  return $this->db->query("SELECT * FROM replies WHERE id=".$this->db->lastInsertId())->fetch();
 }
 function replies($tid){
  $s=$this->db->prepare("SELECT * FROM replies WHERE topic_id=? ORDER BY created_at ASC");
  $s->execute([$tid]);return $s->fetchAll();
 }
}
