<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ImageController extends BaseController
{
    public function serve($filename)
    {
        $path = FCPATH . 'products/' . $filename; // Mengubah path ke folder 'public/products'
        if (file_exists($path)) {
            return $this->response->setHeader('Content-Type', mime_content_type($path))
                ->setBody(file_get_contents($path));
        }
        return $this->response->setStatusCode(404, 'File Not Found');
    }
}
