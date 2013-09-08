<?php
/**
 * @author Barrington Henry <stump500@gmail.com>
 */


namespace StumpSecurity\Http\Header\Values;


abstract class AValues
{
    protected $directiveValueGlue = ' ';

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

    protected $listOfUnwanted = array('include', 'exclude');

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
        $this->filterKeyWordsAndUnwanted();

        if(!empty($this->values) && is_array($this->values))
        {
            $this->values   = array_merge(array(static::DIRECTIVE), $this->values, $this->keyWordValues);
            $this->valueString = implode($this->directiveValueGlue, $this->values);
        }
    }

    /**
     * Filter Remove Keywords and unwanted values
     * @return void
     */
    protected function filterKeyWordsAndUnwanted()
    {
        $map = $this->valObject->getKeywordMap();
        $keywordValues =& $this->keyWordValues;

        $this->values = array_filter($this->values,
                        function($val) use ($map, &$keywordValues)
                        {
                            if(is_string($val)){
                                if(array_key_exists($val, $map)){
                                    $keywordValues[] = $map[$val];
                                    return false;
                                }else{
                                    return true;
                                }
                            }else{
                                return false;
                            }
                        }
         );
    }


    public function __toString()
    {
        return $this->valueString;
    }

    public function setDirectiveValueGlue( $glue )
    {
        $this->directiveValueGlue = $glue;
    }
}