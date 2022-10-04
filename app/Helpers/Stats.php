<?php

namespace Helpers;
class Stats {
    
    protected $persons;

    public function __construct(\Models\Group $persons) {
        $this
            ->setPersons($persons)
        ;
    }

    public function setPersons(\Models\Group $persons) {
        $this->persons = $persons;
        return $this;
    }


    public function getRelativeFrequency(string $atribut, string $value) {

        $sum = 0;
        foreach ($this->persons as $key => $person) {
            if($atribut == 'sex' && $person->getSex() == $value) {
                $sum++;
            }
        }

        return $sum / $this->persons->count();
    }
   
}