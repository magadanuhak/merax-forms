<?php


namespace MeraxForms\Layouts;


class NamedAreas extends Layout
{
    protected $type = 'namedAreas';
    protected $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function get(): array
    {
        return [
            'type'    => $this->type,
            'content' => $this->content
        ];
    }
}
