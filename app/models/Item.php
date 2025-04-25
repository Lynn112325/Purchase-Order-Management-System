<?php
declare(strict_types = 1);

class Item extends supplierItem
{
    private $itemId;
    protected $category;
    protected $type;

    function __construct(array $data, $itemId, 	$category, $type)
    {
        parent::__construct($data);
        $this->itemId = $itemId;
        $this->category = $category;
        $this->type = $type;
    }
    
    // Getter 方法
    public function getItemId(): int
    {
        return $this->itemId;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getType(): string
    {
        return $this->type;
    }

    // Setter 方法
    public function setItemId(int $itemId)
    {
        $this->itemId = $itemId;
    }

    public function setCategory(string $category)
    {
        $this->category = $category;
    }

    public function setType(string $type)
    {
        $this->type = $type;
    }

}