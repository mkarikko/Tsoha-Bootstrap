<?php
class BaseModel {
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;
    public function __construct($attributes = null) {
        // Käydään assosiaatiolistan avaimet läpi
        foreach ($attributes as $attribute => $value) {
            // Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
                // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
    }
    public function errors() {
        // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
        $errors = array();
        foreach ($this->validators as $validator) {
            // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
            
            $validator_errors = $this->{$validator}();
            $errors = array_merge($errors, $validator_errors);
        }
        return $errors;
    }
    public function validate_string_length($string) {
        $errors = array();
        if ($string == '' || $string == null) {
            $errors[] = 'Merkkijono ei saa olla tyhjä!';
        }
        if (strlen($string) < 3) {
            $errors[] = 'Vähimmäismerkkimäärä on 3!';
        }
//        if (strlen($string) > $length) {
//            $errors[] = 'Merkkijono on liian pitkä';
//        }
        return $errors;
    }
    
    public function validate_date($date) {
		$errors = array();
		if ($date == '' || $date == null) {
            $errors[] = 'Aseta päivämäärä!';
        }
        return $errors;
	}
    
    
//    public function validate_integer($luku, $min, $max) {
//        $errors = array();
//        if (is_numeric($luku)) {
//            $errors[] = 'Ei ole luku';
//        }
//        if ($luku == null) {
//            $errors[] = 'luku ei saa olla tyhjä!';
//        }
//        if (luku < $min || luku > $max) {
//            $errors[] = 'luku on liian suuri tai pieni';
//        }
//        return $errors;
//    }
    
}
