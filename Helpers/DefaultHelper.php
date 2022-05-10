<?php

class DefaultHelper
{
    public static $message = [
            'unknown_command'=>"unknown command, try ./command redis add/delete {key} {value}\n",
            'empty_command'=>"the required add/del parameter was not entered, try ./command redis add/delete {key} {value}\n",
            'empty_parametrs'=>"required parameters are not entered, try ./command redis add/delete {key} {value}\n",
            'wrong_command'=>"the required add/del parameter is not entered correctly, try ./command redis add/delete {key} {value}\n",
        ];
}