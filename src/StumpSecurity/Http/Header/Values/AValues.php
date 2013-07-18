<?php
/**
 * @author Barrington Henry <stump500@gmail.com>
 */


namespace StumpSecurity\Http\Header\Values;


abstract class AValues
{
    protected $keyWordValues = array();

    protected $values;

    /**
     * @var ValuesInterface
     */
    protected $valObject;

    /**
     * @var String
     */
    protected $valueString = '';

    public function __construct( ValuesInterface $valObject)
    {
        $this->valObject = $valObject;
    }

    public function setValues( array $values )
    {
        $this->values = $values;
        return $this;
    }

    public function generate()
    {
        $this->filterKeyWords();
        if(!empty($this->values) && is_array($this->values))
        {
            $this->values   = array_merge(array(static::DIRECTIVE), $this->values, $this->keyWordValues);
            $this->valueString = implode(' ', $this->values);
        }
    }

    protected function filterKeyWords()
    {
        $map = $this->valObject->getKeywordMap();
        $keywordValues =& $this->keyWordValues;

        $this->values = array_filter($this->values,
                        function($val) use ($map, &$keywordValues)
                        {
                            if(array_key_exists($val, $map))
                            {
                                $keywordValues[] = $map[$val];
                                return false;
                            }else{
                                return true;
                            }
                        }
         );
    }
}