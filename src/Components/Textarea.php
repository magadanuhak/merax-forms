<?php

namespace MeraxForms\Components;

class Textarea extends Component
{

    /**
     * Input constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->setComponent('textarea');
        parent::__construct($name);
    }

    /**
     * @param string $name
     *
     * @return Textarea
     */
    public static function create(string $name): self
    {
        return new self($name);
    }

    /**
     * @param array $props = [
     *                     'type' => 'textarea',
     *                     'readonly' ?: 'no-title' ?: 'scrollable' => bool,
     *                     'readonly' => bool,
     *                     'prepend_icon' => 'icon',
     *                     'placeholder' => string,
     * ]
     *
     * @return $this
     */
    public function setProps(array $props): self
    {
        $this->props = $props + $this->props;

        return $this;
    }


    public function toArray(): array
    {
        return [
            'name'        => $this->getName(),
            'title'       => $this->getTitle(),
            'description' => $this->getDescription(),
            'rules'       => $this->getRules(),
            'props'       => $this->getProps(),
            'component'   => $this->getComponent()
        ];
    }

}
