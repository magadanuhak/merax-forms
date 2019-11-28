<?php

namespace MeraxForms\Components;

class Input extends Component
{

    /**
     * Input constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->setComponent('input');
        $this->setProps(['type' => 'text']);
        parent::__construct($name);
    }


    /**
     * @param string $name
     *
     * @return Input
     */
    public static function create(string $name): self
    {
        return new self($name);
    }

    /**
     * @param array $props = [
     *                     'type' => 'text' ?: 'number' ?: 'email' ?: 'hidden' ?: 'checkbox',
     *                     'readonly' ?: 'no-title' ?: 'scrollable' => bool,
     *                     'prepend_icon' => 'icon',
     *                     'placeholder' => string,
     *
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
