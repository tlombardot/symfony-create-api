<?php

namespace App\Exception\Document;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class DocumentNotFoundException extends HttpException
{

    public function __construct()
    {
	return parent::__construct(
	    Response::HTTP_NOT_FOUND,
		'Document non trouvé'
	);
    }
}
