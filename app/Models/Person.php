<?php

namespace Models;
class Person {
    
    protected $id;
    protected $firstname;
    protected $surname;
    protected $sex;
    protected $birthday;

    public function __construct(int $id, string $firstname, string $lastName, string $sex, \DateTime $birthday) {
        $this
            ->setId($id)
            ->setFirstname($firstname)
            ->setSurname($lastName)
            ->setSex(strtoupper($sex))
            ->setBirthDday($birthday)
        ;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    protected function setFirstname($firstname) {
        $this->firstname = $firstname;
        return $this;
    }

    public function getSurname(){
        return $this->surname;
    }

    protected function setSurname(string $surname) {
        $this->surname = $surname;
        return $this;
    }

    public function getSex(){
        return $this->sex;
    }

    protected function setSex($sex) {
        $this->sex = $sex;
        return $this;
    }

    public function getBirthday() {
        return $this->birthday;
    }

    protected function setBirthDday(\DateTime $birthday) {
        $this->birthday = $birthday;
        return $this;
    }

    public function getName() {
        return $this->getFirstname() . " " . $this->getSurname();
    }

    // datum od kdy chceme zjisti délku života a druhý praram je v jakých jednotkách, default jsou dny
    public function getLengthOfLife(\DateTime $from, string $units = '%a') {
        $interval = $from->diff($this->getBirthDay());
        return $interval->format($units);
    }

    public function __toString() {
        return $this->getName() . " | " .  $this->getSex() . " | " . $this->getBirthday();
    }
}