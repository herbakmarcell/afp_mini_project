<?php


function check_data(string $input)
{
    $input_adatok = explode('|', $input);
    $nev = $input_adatok[0];
    $szabalyok = explode(',',$input_adatok[1]);
 
    if(array_key_exists($nev, $_POST))
    {
        $input_nev = tisztit($_POST[$nev]);
        foreach($szabalyok as $szabaly)
        {
            if(!$szabaly($input_nev))
            {
                return false;
            }
        }
        return true;
    }
    else {
        return false;
    }
}



function tisztit($value)
{
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
}

function nem_ures($input)
{
    if(empty($input))
        return false;
    return true;
}

function jelszo_megfelel($input){
    if(empty($input) ||strlen($input) < 5 || !preg_match('/[A-Za-z0-9]/', $input))
        return false;
    return true;
      
}

