<?php
namespace Snowcap\AdminBundle\Admin;
/**
 * Content admin class
 *
 * Instances of this class are used as configuration for specific models
 */
abstract class Content {
    /**
     * Class constructor
     *
     * @param string $contentName
     * @param string$entityName
     */
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
    /**
     * Return the "title" (as displayed to the end-user) of a model instance
     * in the admin context
     *
     * @abstract
     * @param $content
     * @return string
     */
    abstract public function getContentTitle($content);
}