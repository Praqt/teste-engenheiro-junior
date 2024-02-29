<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case open = "Em Aberto";
    case paid = "Pago";
    case cancelled = "Cancelado";
}