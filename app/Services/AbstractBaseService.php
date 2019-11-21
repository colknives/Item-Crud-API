<?php

namespace App\Services;

use Illuminate\Http\Request;

abstract class AbstractBaseService {

    protected $response = null;
    protected $request;
    protected $module = 'base';
    protected $bookToken;

    public function __construct(Request $request) 
    {
        $this->request = $request;
    }

    /**
     * @return null|object
     */
    public function response() 
    {
        return $this->response;
    }

    /**
     * @param array $with
     * @return $this
     */
    public function with(array $with)
    {
        if (! is_array($with)) {
            return $this;
        }

        foreach ($with as $key => $value) {
            $this->response->$key = $value;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function getBookToken()
    {
        return $this->bookToken;
    }

    /**
     * @param int $status
     * @param string $message
     * @return object
     */
    protected function makeResponse(int $status, string $message, $data = []) {
        return (object) [
                    "status" => $status,
                    "message" => __("messages.{$this->module}.{$message}", $data)
        ];
    }

    /**
     * @return object
     */
    protected function errorResponse() {
        return (object) [
                    "status" => 500,
                    "message" => __("messages.something_wrong")
        ];
    }

}
