<?php

namespace App\Http\Controllers\Api;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Validation\Validator;

class ApiResponse
{
    /**
     * HTTP Status code
     *
     * @var int
     */
    protected $statusCode = 200;

    protected $headers = [];

    /**
     */
    public function __construct()
    {
    }

    /**
     * Getter for statusCode
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Setter for status code
     *
     * @param int $statusCode
     * @return ApiResponse
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * Setter for status code
     *
     * @param int $statusCode
     * @return ApiResponse
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * Respond data with format is json
     *
     * @param array $arr
     * @param array $headers
     * @return ResponseFactory
     */
    public function respond($code, $message, $data, array $headers = array())
    {
        $meta = [
            'status_code' => $code,
            'msg' => $message
        ];

        if (!empty($data)) {
            $meta['data'] = $data;
        }

        $content = $meta;

        if (!empty($this->headers)) {
            $headers = array_merge($this->headers, $headers);
        }

        return response()->json($content, $this->statusCode, $headers);
    }

    /**
     * Respond data with format is json
     *
     * @param array $arr
     * @param array $headers
     * @return ResponseFactory
     */
    public function respondV1($data, array $headers = array())
    {
        $content = [];
        if (!empty($data)) {
            $content = $data;
        }

        if (!empty($this->headers)) {
            $headers = array_merge($this->headers, $headers);
        }

        return response()->json($content, $this->statusCode, $headers);
    }


    /**
     * Response for message
     *
     * @param array $data
     * @return ResponseFactory
     */
    public function withMessage($message, $data = '', $code = 0)
    {
        return $this->respond($code, $message, $data);
    }

    /**
     * Response for data
     *
     * @param string $message
     * @return ResponseFactory
     */
    public function withCreated($message = 'Created successfully.')
    {
        return $this->setStatusCode(201)->respond(0, $message, '');
    }

    /**
     * Generates a response with a 403 HTTP header and a given message.
     *
     * @param string $message
     * @return mixed
     */
    public function errorForbidden($message = 'Forbidden')
    {
        return $this->setStatusCode(403)->withMessage($message, '', 403);
    }

    /**
     * Generates a response with a 500 HTTP header and a given message.
     *
     * @param string $message
     * @return mixed
     */
    public function errorInternalError($message = 'Internal Error')
    {
        return $this->setStatusCode(500)->withMessage($message, '', 500);
    }

    /**
     * Generates a response with a 404 HTTP header and a given message.
     *
     * @param string $message
     * @return mixed
     */
    public function errorNotFound($message = 'Resource Not Found')
    {
        return $this->setStatusCode(404)->withMessage($message, '', 404);
    }

    /**
     * Generates a response with a 401 HTTP header and a given message.
     *
     * @param string $message
     * @return mixed
     */
    public function errorUnauthorized($message = 'Unauthorized')
    {
        return $this->setStatusCode(401)->withMessage($message, '', 401);
    }

    /**
     * Generates a response with a 400 HTTP header and a given message.
     *
     * @param string $message
     * @return mixed
     */
    public function errorWrongArgs($message = 'Wrong Arguments')
    {
        return $this->setStatusCode(400)->withMessage($message, '', 400);
    }

    /**
     * Generates a Response with a 400 HTTP header and a given message from validator
     *
     * @param Validator $validator
     * @return ResponseFactory
     */
    public function errorWrongArgsValidator(Validator $validator)
    {
        $message = $validator->getMessageBag()->first();
        return $this->errorWrongArgs($message);
    }

    /**
     * Generates a response with a 410 HTTP header and a given message.
     *
     * @param string $message
     * @return mixed
     */
    public function errorGone($message = 'Resource No Longer Available')
    {
        return $this->setStatusCode(410)->withMessage($message);
    }

    /**
     * Generates a response with a 405 HTTP header and a given message.
     *
     * @param string $message
     * @return mixed
     */
    public function errorMethodNotAllowed($message = 'Method Not Allowed')
    {
        return $this->setStatusCode(405)->withMessage($message);
    }

    /**
     * Generates a Response with a 431 HTTP header and a given message.
     *
     * @param string $message
     * @return mixed
     */
    public function errorUnwillingToProcess($message = 'Server is unwilling to process the request')
    {
        return $this->setStatusCode(431)->withMessage($message);
    }
}
