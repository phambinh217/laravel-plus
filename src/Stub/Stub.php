<?php

namespace Phambinh217\LaravelPlus\Stub;

class Stub
{
    private $template;
    private $variables;
    private $outputPath;

    private function __construct($template, array $variables, $outputPath)
    {
        $this->template = $template;
        $this->variables = $variables;
        $this->outputPath = $outputPath;
    }

    public static function make($inputs)
    {
        return new static($inputs['template'], $inputs['data'], $inputs['output_path']);
    }

    public function save()
    {
        $variableNames = collect(array_keys($this->variables))->map(function ($variableName) {
            return "{{ $variableName }}";
        })->toArray();

        $variableValues = array_values($this->variables);

        $compiledTemplate = str_replace($variableNames, $variableValues, $this->template);

        if (!is_dir(dirname($this->outputPath))) {
            mkdir(dirname($this->outputPath), 0777, true);
        }
        file_put_contents($this->outputPath, $compiledTemplate);
    }
}
