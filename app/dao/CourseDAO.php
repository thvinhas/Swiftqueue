<?php 
class CourseDAO {

  public function create (Course $course) {
    try {
      $sql = "INSERT INTO course (
        startDate, endDate, name, status) 
        VALUES(
          :sartDate, :endDate, :name, :status)";
      
      $p_sql = Connection::getConnection()->prepare($sql);
      $p_sql->bindValue("sartDate", date('Y-m-d', strtotime($course->getStartDate())));
      $p_sql->bindValue(":endDate", date('Y-m-d', strtotime($course->getEndDate())));
      $p_sql->bindValue(":name", $course->getName());
      $p_sql->bindValue(":status", $course->getStatus());
      // var_dump($p_sql);exit;
      return $p_sql->execute();
      
    } catch (Exception $e){
      print "error $e";
    }
  }

  public function read() {
    try {
      $sql = "SELECT * FROM course";
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

  public function update(Course $course) {
    // var_dump($course);exit;
    try {
      $sql = "UPDATE course SET 
                startDate= :startDate,
                endDate= :endDate,
                name= :name,
                status= :status

                
                WHERE id= :id";

      $p_sql = Connection::getConnection()->prepare($sql);
      $p_sql->bindValue(":startDate", date('Y-m-d', strtotime($course->getStartDate())));
      $p_sql->bindValue(":endDate", date('Y-m-d', strtotime($course->getEndDate())));
      $p_sql->bindValue(":name", $course->getName());
      $p_sql->bindValue(":status", $course->getStatus());
      $p_sql->bindValue(":id", $course->getId());
      $ee = $p_sql->execute();
      // var_dump($p_sql->debugDumpParams());exit;
      return $ee;
    } catch (Exception $e) {
      print "error $e";
    }
  }
  public function delete(Course $course) {
    try {
      $sql = "DELETE FROM course WHERE id=:id";
      $p_sql = Connection::getConnection()->prepare($sql);
      $p_sql->bindValue(":id", $course->getId());

      return $p_sql->execute();
    } catch (Exception $e) {
      print "error $e";
    }
  }

  private function listCourses($row){
    $course = new Course();
    $course->setId($row['id']);
    $course->setName($row['name']);
    $course->setEndDate($row['endDate']);
    $course->setStartDate($row['startDate']);
    $course->setStatus($row['status']);
    return $course;
  }

}

