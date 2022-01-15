<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\RedirectResponse;


class AccessDeniedHandler implements \Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface
{

    /**
     * @inheritDoc
     */
    public function handle(Request $request, AccessDeniedException $accessDeniedException):Response
    {
        // TODO: Implement handle() method.
        return $this->redirectToRoute('homepage');
    }
}