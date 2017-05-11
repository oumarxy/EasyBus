<?php

namespace UsersBundle\MyService;

class PasswordGenerator {
    
    public function passwordCreate() {
        for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789') - 1; $i != 8; $x = rand(0, $z), $s .= $a{$x}, $i++)
            ;
        return $s;
    }

    public function loginCreate($text) {
        $caracteresSpeciaux = new CaracteresSpeciaux();
        $string = $caracteresSpeciaux->nettoyerChaine($text);
        $string = trim($string);
        if (strlen($string) <= 7) {
            return $string;
        }
        return substr($string, 0, 7);
    }

}
