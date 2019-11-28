<?php

namespace MeraxForms\Components;

class Select extends Component
{
    private $data = [];
    private $dataSource = [];
    private $parents = [];
    private $children = [];

    /**
     * Input constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->setComponent('select');
        $this->setProps(['type' => 'select']);
        parent::__construct($name);
    }

    /**
     * @param string $name
     *
     * @return Select
     */
    public static function create(string $name): self
    {
        return new self($name);
    }

    /**
     * @param array $options = [
     *                       'url' => string,
     *                       'field' => string,
     *                       'minLength' => 2,
     *                       'method' => string
     *                       ]
     *
     * @return $this
     */
    public function setDataSource(array $options): self
    {
        $this->dataSource = $options;

        return $this;
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
            'dataSource'  => $this->getDataSource(),
            'children'    => $this->getChildren(),
        ];
    }

    /**
     * @return array
     */
    public function getDataSource(): array
    {
        return $this->dataSource;
    }

    /**
     * @param array $parents
     *
     * @return $this
     */
    public function setParents(array $parents): self
    {
        $this->parents = $parents;

        return $this;
    }

    /**
     *
     * @param array $children
     *
     * @return $this
     */
    public function setChildren(array $children): self
    {
        $this->children = $children;

        return $this;
    }

    /**
     * @return array
     */
    public function getChildren(): array
    {
        return $this->children;
    }

}
