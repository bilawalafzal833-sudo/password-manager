<?php

class PasswordGenerator {

    public function generate(
    int $uppercase,
    int $lowercase,
    int $numbers,
    int $special
    ): string
    {

        $upper =
        "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        $lower =
        "abcdefghijklmnopqrstuvwxyz";

        $num =
        "0123456789";

        $spec =
        "!@#$%^&*";

        $password = "";

        for($i=0;$i<$uppercase;$i++){

            $password .=
            $upper[rand(
                0,
                strlen($upper)-1
            )];
        }

        for($i=0;$i<$lowercase;$i++){

            $password .=
            $lower[rand(
                0,
                strlen($lower)-1
            )];
        }

        for($i=0;$i<$numbers;$i++){

            $password .=
            $num[rand(
                0,
                strlen($num)-1
            )];
        }

        for($i=0;$i<$special;$i++){

            $password .=
            $spec[rand(
                0,
                strlen($spec)-1
            )];
        }

        return str_shuffle($password);
    }
}
?>