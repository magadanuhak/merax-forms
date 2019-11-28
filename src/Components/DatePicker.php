<?php


namespace MeraxForms\Components;

class DatePicker extends Component
{

    /**
     * Input constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->setComponent('datepicker');
        $this->setProps([
            'prepend_icon'      => 'date_range',
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
     * @return DatePicker
     */
    public static function create(string $name): self
    {
        return new DatePicker($name);
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
