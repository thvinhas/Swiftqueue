<?php
class Course
{
  private $id;
  private $name;
  private $startDate;
  private $endDate;
  private $status;

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    $this->name = $name;
  }

  public function getStartDate()
  {
    return $this->startDate;
  }

  public function setStartDate($startDate)
  {
    $this->startDate = $startDate;
  }

  public function getEndDate()
  {
    return $this->endDate;
  }

  public function setEndDate($endDate)
  {
    $this->endDate = $endDate;
  }

  public function getStatus()
  {
    return $this->status;
  }

  public function setStatus($status)
  {
    $this->status = $status;
  }
}
