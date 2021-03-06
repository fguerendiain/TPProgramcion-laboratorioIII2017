<?php

    require_once dirname(__FILE__)."/JWTHandler.php";
    require_once dirname(__FILE__)."/../dal/SessionDal.php";
    require_once dirname(__FILE__)."/../dal/UserDal.php";


    class ValidatorHandler{

        /*
         *  Esta regla es para permitir solo letras y espacios.
         */
        public static function ValidateOnlyLetters($data){
            $expression = '/[a-zA-Z]/';
            if (preg_match($expression,$data)){
                return true;
            }else{
                return false;
            }
        }


        /*
         *  Esta regla es para permitir credenciales de 8 hasta 10 caracteres de longitud, alfanuméricos y permitir guiones bajos.
         */
        public static function ValidateUserCredentials($data){
            $expression = '/^[a-z\\d_]{4,28}$/i';
            if (preg_match($expression,$data)){
                return true;
            }else{
                return false;
            }
        }

        /*
         *  Comprueba si todos caracteres del string son dígitos.
         *  Permitiendo la cadena vacia
         */
        public static function ValidateInteger($data){
            $expression = '/^[0-9]*$/';
            if (preg_match($expression,$data)){
                return true;
            }else{
                return false;
            }
        }


        /*
         *  Esta es una extensión la anterior. Acepta tanto número positivos como negativos
         *  y que el separador de decimales sea coma o punto
         */
        public static function ValidateFloat($data){
            $expression = '/^-?[0-9]+([,\.][0-9]*)?$/';
            if (preg_match($expression,$data)){
                return true;
            }else{
                return false;
            }
        }


        /*
         *  Valida que la cadena contenga un formato de correo electronico
         */
        public static function ValidateEmail($data){
            $expression = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
            if (preg_match($expression,$data)){
                return true;
            }else{
                return false;
            }
        }

        /*
         *  Verifica que si la seccion existe, esta vigente o vencida
         */
        public static function ValidateSession($token)
        {
            $validSession = SessionDal::Update($token);
            return $validSession;
        }


        /*
         * Valida si los permisos del usuario
        */
        public static function ValidateUserPermission($token)
        {
            $validSession = SessionDal::Update($token);
            if($validSession !== NULL && $validSession !== true)
            {
                $user = UserDal::get($validSession['owner']);
                if($user['admin'] == 1)
                {
                    return true;
                }
            }
            return false;
        }
    }

?>