<?php


namespace MeraxForms\Components;

class TimePicker extends Component
{

    /**
     * Input constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->setComponent('timepicker');

        parent::__construct($name);
    }

    /**
     * @param string $name
     *
     * @return TimePicker
     */
    public static function create(string $name): self
    {
        return new self($name);
    }


    /**
     * @param array $props = [
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
