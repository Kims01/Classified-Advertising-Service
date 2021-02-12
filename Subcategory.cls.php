<?php

class Subcategory extends Category
{
    private $subcategoryId;
    private $englishDesc;
    private $frenchDesc;
    
    function __construct($englishDesc,$frenchDesc)
    {
        parent::__construct();
        $this->subcategoryId = self::$sequence++;
        $this->englishDesc = $englishDesc;
        $this->frenchDesc = $frenchDesc;
    }
    
    function __construct($catEnglishDesc,$catfrenchDesc,$englishDesc,$frenchDesc)
    {
        parent::__construct($catEnglishDesc,$catfrenchDesc);
        $this->subcategoryId = self::$sequence++;
        $this->englishDesc = $englishDesc;
        $this->frenchDesc = $frenchDesc;
    }
    
    /**
     * @return mixed
     */
    public function getSubcategoryId()
    {
        return $this->subcategoryId;
    }

    /**
     * @return mixed
     */
    public function getEnglishDesc()
    {
        return $this->englishDesc;
    }

    /**
     * @return mixed
     */
    public function getFrenchDesc()
    {
        return $this->frenchDesc;
    }

    /**
     * @param mixed $subcategoryId
     */
    public function setSubcategoryId($subcategoryId)
    {
        $this->subcategoryId = $subcategoryId;
    }

    /**
     * @param mixed $englishDesc
     */
    public function setEnglishDesc($englishDesc)
    {
        $this->englishDesc = $englishDesc;
    }

    /**
     * @param mixed $frenchDesc
     */
    public function setFrenchDesc($frenchDesc)
    {
        $this->frenchDesc = $frenchDesc;
    }

    
    
    
}

?>