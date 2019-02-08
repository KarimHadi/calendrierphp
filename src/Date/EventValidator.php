<?php
namespace Calendar;

use App\Validator;

class EventValidator extends Validator {

    public function validates(array $data) {
        parent::validates($date);
        $this->validate('name', 'minLength', 3);
        return $this->errors;
    }
}
