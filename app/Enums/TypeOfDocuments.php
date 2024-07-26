<?php

namespace App\Enums;
// le indico a este archivo donde se encuentra


enum TypeOfDocuments: int
{
    // enum es una clase que contiene constantes, para acceder a sus valores, utilizo el name
    case DNI = 1;
    case CE = 2;
    case RUC = 3;
    case PP = 4;
    case LE = 5;
    case ID = 6;


}


