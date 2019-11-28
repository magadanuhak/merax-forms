<?php


namespace MeraxForms\Layouts;


abstract class Layout
{

    protected $type;
    protected $content = [];
    protected $allFields = [];


    public function setFields($fields): void
    {
        $this->allFields = $fields;
    }

    public function getFields(): array
    {
        return $this->allFields;
    }

    public function get(): array
    {
        return [
            'type'    => $this->type,
            'content' => $this->content
        ];
    }
}
