<?php

namespace App\Exception\Cart;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CartAlreadyPaidException extends HttpException{

    public function __construct()
    {
	return parent::__construct(
	    Response::HTTP_CONFLICT,
	    "Panier déjà payé"
	);
    }
}
