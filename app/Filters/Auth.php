<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // If user is not logged in, either redirect to login (for normal requests)
        // or return a 401 JSON response for AJAX requests.
        $session = service('session');
        $isLoggedIn = $session->get('isLoggedIn');

        // Detect AJAX request
        $isAjax = $request->isAJAX();

        if (!$isLoggedIn) {
            if ($isAjax) {
                // Return a minimal JSON response for AJAX calls
                $response = service('response');
                $response->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
                $response->setJSON([
                    'success' => false,
                    'message' => 'Unauthorized. Please login to continue.'
                ]);

                return $response;
            }

            // For normal requests, redirect to login page
            return redirect()->to(base_url('login'));
        }

        // If logged in, continue
        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No-op
    }
}
