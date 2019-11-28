<?php


namespace MeraxForms\Components;


class Range extends Component
{
    protected $component = 'range';
    private $title = [];
    private $description = [];
    private $rules = [];

    /**
     * @return array = ['from' => string, 'to' => 'string']
     */
    public function getCustomTitle(): array
    {
        return $this->title;
    }

    /**
     * @param array $title = ['from' => string, 'to' => 'string']
     *
     * @return $this
     */
    public function setCustomTitle(array $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return array = ['from' => string, 'to' => 'string']
     */
    public function getCustomDescription(): array
    {
        return $this->description;
    }

    /**
     * @param array $description = ['from' => string, 'to' => 'string']
     *
     * @return $this
     */
    public function setCustomDescription(array $description): self
    {
        $this->description = $description;

        return $this;

    }

    /**
     * @return array = ['from' => string, 'to' => 'string']
     */
    public function getCustomRules(): array
    {
        return $this->rules;
    }

    /**
     * @param array $rules = ['from' => string, 'to' => 'string']
     *
     * @return $this
     */
    public function setCustomRules(array $rules): self
    {
        $this->rules = $rules;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return Range
     */
    public static function create(string $name): self
    {
        return new self($name);
    }


    /**
     * @param array $props = [
     *                     'type' => 'text' ?: 'number' ?: 'email' ?: 'hidden' ?: 'checkbox',
     *                     'readonly' ?: 'no-title' ?: 'scrollable' => bool,
     *                     'readonly' => bool,
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
            'title'       => $this->getCustomTitle(),
            'description' => $this->getCustomDescription(),
            'rules'       => $this->getCustomRules(),
            'props'       => $this->getProps(),
            'component'   => $this->getComponent()
        ];
    }

}
