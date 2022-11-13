<?php

namespace App\Helpers;

enum InputErrorMessages : String {
    case Correct = "";
    case UsedName = "Meno je uz pouzite!";
    case UsedEmail = "E-mail je uz pouzity!";
    case DifferentPasswords = "Hesla sa nezhoduju!";
    case SimplePassword = "Heslo musi mat aspon 6 znakov a obsahovat cislo!";
    case LongName = "Meno moze mat maximalne 30 znakov!";
    case LongEmail = "Email moze mat maximalne 75 znakov!";
    case LongPassword = "Heslo moze mat maximalne 50 znakov!";
}