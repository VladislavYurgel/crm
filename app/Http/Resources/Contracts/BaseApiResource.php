<?php

namespace App\Http\Resources\Contracts;

use Illuminate\Http\Resources\Json\Resource;

class BaseApiResource extends Resource
{
    const DATA_WRAP_FIELD = 'result';

    private $messages = [];
    private $errNumber = 0;
    private $token;
    private $status = ResponseStatuses::SUCCESS;

    public function __construct($resource = null)
    {
        parent::__construct(optional($resource));
        static::wrap(static::DATA_WRAP_FIELD);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    /**
     * Additional request params, basic structure for api response
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function with($request)
    {
        $response = [
            'status' => $this->status,
            'message' => $this->getFirstMessage(),
            'token' => $this->token
        ];

        if ($this->status === ResponseStatuses::ERROR) {
            $response['error'] = $this->errNumber;
        }

        return $response;
    }

    /**
     * Update messages array
     *
     * @param array $messages
     *
     * @return $this
     */
    public function setMessages(array $messages)
    {
        $this->messages = $messages;
        return $this;
    }

    /**
     * Save message for response
     *
     * @param $message
     *
     * @return $this
     */
    public function addMessage($message)
    {
        $this->messages[] = $message;
        return $this;
    }

    /**
     * Add multiple messages for response
     *
     * @param array $messages
     *
     * @return $this
     */
    public function addMessages(array $messages)
    {
        $this->messages = array_merge($this->messages, $messages);
        return $this;
    }

    /**
     * Update response status
     *
     * @param $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get response status
     *
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }


    /**
     * Get all messages
     *
     * @return array
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     *
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @param $errorNumber
     *
     * @return $this
     */
    public function setErrorNumber($errorNumber)
    {
        $this->errNumber = $errorNumber;
        return $this;
    }

    public function getFirstMessage()
    {
        $messagesMessages = array_values($this->messages);
        return array_shift($messagesMessages);
    }

    public function setData($data)
    {
        $this->resource = $data;
        return $this;
    }
}