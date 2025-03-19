<?php
class virtualItem extends Item
{
    private $virtualId;

    function __construct(array $data, $virtualId)
    {
        parent::__construct($data); // 调用父类构造函数
        $this->virtualId = $virtualId;
    }

    public function getVirtualId()
    {
        return $this->virtualId;
    }

    public function setVirtualId($virtualId)
    {
        $this->virtualId = $virtualId;
    }
}