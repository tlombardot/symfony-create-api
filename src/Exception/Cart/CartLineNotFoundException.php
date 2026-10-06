<?php

namespace App\Exception\Cart;

use Symfony\Component\HttpFoundation\Response;

class CartLineNotFoundException extends \Exception
{
    public function __construct()
    {
        parent::__construct(
            Response::HTTP_NOT_FOUND,
            "Ligne de panier non trouvée"
        );
    }
}
