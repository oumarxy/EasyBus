<?php

namespace UsersBundle\MyService;

class CaracteresSpeciaux {

    private function enleverCaracteresSpeciaux($text) {
        $utf8 = array(
            '/[áàâãªä]/u' => 'a',
            '/[ÁÀÂÃÄ]/u' => 'A',
            '/[ÍÌÎÏ]/u' => 'I',
            '/[íìîï]/u' => 'i',
            '/[éèêë]/u' => 'e',
            '/[ÉÈÊË]/u' => 'E',
            '/[óòôõºö]/u' => 'o',
            '/[ÓÒÔÕÖ]/u' => 'O',
            '/[úùûü]/u' => 'u',
            '/[ÚÙÛÜ]/u' => 'U',
            '/ç/' => 'c',
            '/Ç/' => 'C',
            '/ñ/' => 'n',
            '/Ñ/' => 'N',
            '/–/' => '-', // conversion d'un tiret UTF-8 en un tiret simple
            '/[‘’‚‹›]/u' => ' ', // guillemet simple
            '/[“”«»„]/u' => ' ', // guillemet double
            '/ /' => ' ', // espace insécable (équiv. à 0x160)
        );
        return preg_replace(array_keys($utf8), array_values($utf8), $text);
    }

    public function nettoyerChaine($text) {
        /*$sansCaracteresSpeciaux = $this->enleverCaracteresSpeciaux($text);	
        $string = preg_replace("/[^A-Za-z0-9]/", '', $sansCaracteresSpeciaux);	
		$string = str_replace(' ', '', $string);
		$sansEspace = str_replace('-', '', $string);
		*/
		$clean_code = preg_replace('/[^a-zA-Z0-9]/', '', $text);
        return $clean_code ;
    }

}
