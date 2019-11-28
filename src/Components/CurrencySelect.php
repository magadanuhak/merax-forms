<?php


namespace MeraxForms\Components;


class CurrencySelect extends Component
{
    private $data = [];

    /**
     * Input constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->setComponent('currencyselect');
        parent::__construct($name);
    }

    /**
     * @param string $name
     *
     * @return CurrencySelect
     */
    public static function create(string $name): self
    {
        return new CurrencySelect($name);
    }


    /**
     * @param array $props = [
     *                     'multiple' => true,
     *                     'type' => 'select',
     *                     'hide_no_data' => true
     *
     * ]
     *
     * @return $this
     */
    public function setProps(array $props): self
    {
        $this->props = array_replace($this->props, $props);

        return $this;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data = [
     *                    [
     *                    'value' => int,
     *                    'text' => string
     *                    ]
     *                    ]
     *
     * @return $this
     */
    public function setData(array $data): parent
    {
        $this->data = $data;

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
            'component'   => $this->getComponent(),
            'data'        => $this->getData(),
        ];
    }

}
