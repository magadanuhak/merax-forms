<?php


namespace MeraxForms\Components;

class DateRangePicker extends Component
{

    /**
     * Input constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->setComponent('daterangepicker');
        $this->setProps([
            'readonly'          => true,
            'no-title'          => true,
            'scrollable'        => true,
            'first_day_of_week' => 1
        ]);
        parent::__construct($name);
    }

    /**
     * @param string $name
     *
     * @return DateRangePicker
     */
    public static function create(string $name): self
    {
        return new DateRangePicker($name);
    }


    /**
     * @param array $props = [
     *                     'readonly' ?: 'no-title' ?: 'scrollable' => bool,
     *                     'prepend_icon' => 'icon',
     *                     'placeholder' => string,
     *                     'first_day_of_week' => 1
     *                     ]
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
