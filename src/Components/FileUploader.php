<?php

use MeraxForms\Components\Component;

class FileUploader extends Component
{

    protected $uploadURL = '';
    private $data = [];

    protected $props = [
        'maxFiles'     => 0,
        'maxFileSize'  => 0,
        'maxTotalSize' => 0,
        'multiSelect'  => false,
        'allowedTypes' => [],
        'useClipboard' => false,
        'canDrop'      => false,
        'useTitle'     => false
    ];

    /**
     * Input constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->setComponent('file');
        parent::__construct($name);
    }

    /**
     * @param string $name
     *
     * @return FileUploader
     */
    public static function create(string $name): self
    {
        return new FileUploader($name);
    }

    /**
     * @param string $url
     *
     * @return FileUploader
     */
    public function setUploadURL(string $url = ''): self
    {
        $this->uploadURL = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getUploadURL(): string
    {
        return $this->uploadURL;
    }

    /**
     * @param int $maxFiles
     *
     * @return FileUploader
     */
    public function setMaxFiles(int $maxFiles = 0): self
    {
        $this->props['maxFiles'] = $maxFiles;

        return $this;
    }

    /**
     * @param int $size KB
     *
     * @return FileUploader
     */
    public function setMaxFileSize(int $size = 0): self
    {
        $this->props['maxFileSize'] = $size * 1024;

        return $this;
    }

    /**
     * @param int $size KB
     *
     * @return FileUploader
     */
    public function setMaxTotalSize(int $size = 0): self
    {
        $this->props['maxTotalSize'] = $size * 1024;

        return $this;
    }

    /**
     * @param bool $multiSelect
     *
     * @return FileUploader
     */
    public function setCanMultiSelect(bool $multiSelect = false): self
    {
        $this->props['multiSelect'] = $multiSelect;

        return $this;
    }

    /**
     * @param bool $useClipboard
     *
     * @return FileUploader
     */
    public function setCanUseClipboard(bool $useClipboard = false): self
    {
        $this->props['useClipboard'] = $useClipboard;

        return $this;
    }

    /**
     * @param bool $canDrop
     *
     * @return FileUploader
     */
    public function setCanDrop(bool $canDrop = false): self
    {
        $this->props['useClipboard'] = $canDrop;

        return $this;
    }

    /**
     * @param bool $useTitle
     *
     * @return FileUploader
     */
    public function setUseTitle(bool $useTitle = false): self
    {
        $this->props['useTitle'] = $useTitle;

        return $this;
    }

    /**
     * @param bool $auto
     *
     * @return FileUploader
     */
    public function setAutoUpload(bool $auto = false): self
    {
        $this->props['autoUpload'] = $auto;

        return $this;
    }

    /**
     * @param array $types
     *
     * @return FileUploader
     */
    public function setAllowedTypes(array $types = []): self
    {
        $this->props['allowedTypes'] = $types;

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
    public function setProps(array $props)
    {
        $this->props = array_replace($this->props, $props);

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
            'uploadURL'   => $this->getUploadURL(),
            'component'   => $this->getComponent(),
            'data'        => $this->getData()
        ];
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     *
     * @return FileUploader
     */
    public function setData(array $data): parent
    {
        $this->data = $data;

        return $this;
    }

}
