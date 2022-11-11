<?php

namespace App\Helpers;

enum RegisterErrorMessages {
    case Correct;
    case UsedName;
    case UsedEmail;
    case DifferentPasswords;
    case SimplePassword;
    case LongName;
    case LongEmail;
    case LongPassword;
}