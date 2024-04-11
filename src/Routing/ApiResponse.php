<?php

declare(strict_types=1);

namespace TestApp\Routing;



class ApiResponse extends Response
{
    private $responseData = null;

    public function __construct()
    {
        parent::__construct('', []);
    }


    public function setResponseData(string $data): void
    {
        $this->responseData = $data;
    }

    public function getResponseData(): string
    {
        return $this->responseData;
    }

    public function render(): void
    {
        if (empty($this->responseData)) {
            return;
        }

        ob_start();
        echo $this->responseData;
        $output = ob_get_clean();
        echo $output;
    }
}
