<?php


namespace MeraxForms\Layouts;


class InlineLayout extends Layout
{
    protected $type = 'inline';
    protected $content = [
        'xs' => 1,
        'sm' => 2,
        'md' => 3,
        'lg' => 4,
        'xl' => 5
    ];

    public function __construct($content)
    {
        foreach ($content as $key => $value) {
            if ($this->content[$key]) {
                $this->content[$key] = $value;
            }
        }
    }
}
