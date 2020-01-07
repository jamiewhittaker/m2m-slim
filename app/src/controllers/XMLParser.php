<?php

class XMLParser{
    private $xmlParser;
    private $toParse;
    private $currentElementName;
    private $tempAttributes;
    private $parsedData = array();

    public function __construct($toParse)
    {
        $this->xmlParser = xml_parser_create();
        $this->toParse = $toParse;
    }

    public function __destruct()
    {
        xml_parser_free($this->xmlParser);
    }

    public function parse(){
        //allows for the parser to be used within an object
        xml_set_object($this->xmlParser, $this);

        //sets element handler functions for when each new element is started and ended
        xml_set_element_handler($this->xmlParser, "startElementHandler", "endElementHandler");

        //sets function to be called when an element contains data
        xml_set_character_data_handler($this->xmlParser, "processElementData");

        xml_parse($this->xmlParser, $this->toParse);
    }

    /**
     * Processes an element, stores the tag name and extracts the names and values of attributes.
     */
    private function startElementHandler($parser, $elementName, $attributes){
        $this->currentElementName = $elementName;

        if (sizeof($attributes) > 0) {
            foreach ($attributes as $attributeName => $attributeValue) {
                $tagAttribute = $elementName . "." . $attributeName;
                $this->tempAttributes[$tagAttribute] = $attributeValue;
            }
        }
    }


    private function processElementData($parser, $elementData){
        $this->parsedData[$this->currentElementName] = $elementData;

        if (sizeof($this->tempAttributes) > 0) {
            foreach ($this->tempAttributes as $name => $value){
                $this->parsedData[$name] = $value;
            }
        }
    }

    private function endElementHandler($parser, $elementName){
        // leave empty
    }

    public function getParsedData(){
        return $this->parsedData;
    }
}