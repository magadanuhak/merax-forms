<?php

namespace MeraxForms\Components;

class TreeSelect extends Component
{
    public $data = [];
    public $dataSource = [];

    /**
     * Input constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->setComponent('treeSelect');
        $this->setProps([
            'defaultExpandLevel' => 1
        ]);
        parent::__construct($name);
    }

    /**
     * @param string $name
     *
     * @return TreeSelect
     */
    public static function create(string $name): self
    {
        return new self($name);
    }

    /**
     * @param array $props = [
     *                     'multiple' => true,
     *                     'type' => 'select',
     *                     'hideNoData' => true,
     *                     'defaultExpandLevel' => 1,
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

    /**
     * @return array [
     *     [
     *          'id' => int,
     *          'label' => string,
     *          'children' => [
     *               'id' => int,
     *               'label' => string
     *          ]
     *     ]
     * ]
     */
    public function getData(): array
    {
        return $this->data;
    }


    /**
     *
     * @param array $data = [
     *                    [
     *                    'id' => int,
     *                    'label' => string,
     *                    'children' => [
     *                    'id' => int,
     *                    'label' => string
     *                    ]
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
        ];
    }

    /**
     *
     * @return array
     */
    public function getDataSource(): array
    {
        return $this->dataSource;
    }

}
