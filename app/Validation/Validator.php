<?php

namespace App\Validation;

use Respect\Validation\Validator as Respect;
use Respect\Validation\Exceptions\NestedValidationException;

class Validator
{

    protected $errors;

    public function validate($request, array $rules)
    {
        foreach($rules as $filed => $rule) {
            try {
                $rule->setName(ucfirst($filed))->assert($request->getParam($filed));
            } catch (NestedValidationException $e) {
                $this->errors[$filed] = $e->getMessages();
            }
        }

        $_SESSION['errors'] = $this->errors;

        return $this;
    }

    public function failed()
    {
        return !empty($this->errors);
    }

}