<?php 
include_once '../connection/connection.php';
class UserDAO {

  public function create (User $user) {
    try {
      $sql = "INSERT INTO user (
        name, username, password) 
        VALUES(
          :name, :username, :password)";
      
      $p_sql = Connection::getConnection()->prepare($sql);
      $p_sql->bindValue(":name", $user->getName());
      $p_sql->bindValue(":username", $user->getUsername());
      $p_sql->bindValue(":password", base64_encode($user->getPassword()));

      return $p_sql->execute();
      
    } catch (Exception $e){
      print "error $e";
    }
  }

  public function read() {
    try {
      $sql = "SELECT * FROM user";

      $result = Connection::getConnection()->query($sql);
      $list = $result->fetchAll(PDO::FETCH_ASSOC);
      $f_list = array();
      foreach ($list as $l) {
        $f_list[] = $this->listCourses($l);
      }
      return $f_list;
    } catch (Exception $e) {
      print "error $e";
    }
  }

  public function update(User $user) {
    try {
      $sql = "UPDATE user SET 
                name= :name,
                username = :username,";
      if(empty($user->getPassword())){
        $sql.= " password = :password";
      }
      $sql.= "WHERE id= :id";

      $p_sql = Connection::getConnection()->prepare($sql);
      $p_sql->bindValue(":name", $user->getName());
      $p_sql->bindValue(":username", $user->getUsername());
      if(empty($user->getPassword())){
        $p_sql->bindValue(":password", base64_encode($user->getPassword()));
      }
      $p_sql->bindValue(":id", $user->getId());
      $ee = $p_sql->execute();
      return $ee;
    } catch (Exception $e) {
      print "error $e";
    }
  }
  public function delete(User $user) {
    try {
      $sql = "DELETE FROM user WHERE id=:id";
      $p_sql = Connection::getConnection()->prepare($sql);
      $p_sql->bindValue(":id", $user->getId());

      return $p_sql->execute();
    } catch (Exception $e) {
      print "error $e";
    }
  }

  private function listCourses($row){
    $user = new User();
    $user->setId($row['id']);
    $user->setName($row['name']);
    $user->setUsername($row['username']);
    $user->setPassword($row['password']);
 
    return $user;
  }

}

