<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Cross-Origin Resource Sharing (CORS) Configuration
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
 */
class Cors extends BaseConfig
{
    /**
     * The default CORS configuration.
     *
     * @var array{
     *      allowedOrigins: list<string>,
     *      allowedOriginsPatterns: list<string>,
     *      supportsCredentials: bool,
     *      allowedHeaders: list<string>,
     *      exposedHeaders: list<string>,
     *      allowedMethods: list<string>,
     *      maxAge: int,
     *  }
     */
    public array $default = [
        /**
         * Origins for the `Access-Control-Allow-Origin` header.
         *
         * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Access-Control-Allow-Origin
         *
         * Membolehkan akses dari semua origin
         */
        'allowedOrigins' => ['*'], // Membolehkan semua origin

        /**
         * Origin regex patterns for the `Access-Control-Allow-Origin` header.
         *
         * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Access-Control-Allow-Origin
         *
         * Anda bisa menambahkan regex untuk origin jika diperlukan.
         */
        'allowedOriginsPatterns' => [],

        /**
         * Weather to send the `Access-Control-Allow-Credentials` header.
         *
         * Mengatur apakah credentials (misalnya cookies) diizinkan untuk dikirim
         * dalam request cross-origin.
         */
        'supportsCredentials' => false, // Tidak perlu untuk aplikasi tanpa kredensial

        /**
         * Set headers to allow.
         *
         * Mengatur header yang diizinkan untuk diminta oleh client.
         */
        'allowedHeaders' => [
            'X-API-KEY',
            'Origin',
            'X-Requested-With',
            'Content-Type',
            'Access-Control-Requested-Method',
            'Access-Control-Allow-Origin',
            'Authorization'
        ],

        /**
         * Set headers to expose.
         *
         * Mengatur header yang akan diekspos ke client dari respons server.
         */
        'exposedHeaders' => [],

        /**
         * Set methods to allow.
         *
         * Metode HTTP yang diizinkan untuk diakses.
         */
        'allowedMethods' => [
            'GET',
            'POST',
            'PUT',
            'DELETE'
        ],

        /**
         * Set how many seconds the results of a preflight request can be cached.
         *
         * Menetapkan waktu cache untuk permintaan preflight.
         */
        'maxAge' => 7200,
    ];
}
