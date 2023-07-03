<?php 
    class Validator {
        private $data;
        private $errors;
    
        public function __construct($data) {
            $this->data = $data;
            $this->errors = new stdClass();
        }
    
        public function validateRequired($field) {
            $value = $this->getValue($field);
    
            if (empty($value)) {
                $this->addError($field, "The $field field is required.");
            }
        }
    
        public function validateEmail($field) {
            $value = $this->getValue($field);
    
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $this->addError($field, "The $field field must be a valid email address.");
            }
        }
    
        public function validateEmailRegex($field) {
            $value = $this->getValue($field);
    
            // Email validation using regular expression
            if (!preg_match('/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/i', $value)) {
                $this->addError($field, "The $field field must be a valid email address.");
            }
        }

        public function validateMinLength($field, $minLength) {
            $value = $this->getValue($field);
    
            if (strlen($value) < $minLength) {
                $this->addError($field, "The $field field must be at least $minLength characters long.");
            }
        }
    
    
        // Add more validation methods as needed
        public function isValid() {
            return empty((array) $this->errors);
        }
    
        public function getErrors() {
            return $this->errors;
        }
    
        private function getValue($field) {
            return isset($this->data[$field]) ? $this->data[$field] : null;
        }
    
        private function addError($field, $message) {
            $this->errors->$field = $message;
        }
    }
    

?>