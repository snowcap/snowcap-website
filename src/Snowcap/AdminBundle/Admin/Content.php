<?php
namespace Snowcap\AdminBundle\Admin;

abstract class Content {

    public function __construct($contentName, $entityName)
    {
        $this->contentName = $contentName;
        $this->entityName = $entityName;
    }
    /**
     * Return the readable name of the managed content
     *
     * @return string
     */
    public function getContentName(){
        return $this->contentName;
    }
    /**
     * Return the name of the managed entity
     *
     * @return string
     */
    public function getEntityName(){
        return $this->entityName;
    }
    /**
     * Return the config array for the grid
     *
     * @abstract
     * @return array
     */
    abstract public function getGridFields();
    /**
     * Return the config array for the form
     *
     * @abstract
     * @return array
     */
    abstract public function getFormFields();
}