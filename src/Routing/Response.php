<?php

declare(strict_types=1);

namespace TestApp\Routing;

use TestApp\Api\ResponseInterface;

class Response implements ResponseInterface
{
    private string $template;

    public function __construct(
        private readonly string $templateDir,
        private array $vars = []
    ) {
    }

    public function template(string $name, $vars = []): void
    {
        $this->addVars($vars);
        $this->template = $this->templateDir . '/' . $name . '.php';
    }

    public function addVars($vars): void
    {
        $this->vars = array_merge($this->vars, $vars);
    }

    public function render(): void
    {
        if (empty($this->template)) {
            return;
        }

        extract($this->vars, EXTR_SKIP);

        ob_start();
        include $this->template;
        $output = ob_get_clean();
        echo $output;
    }
}
