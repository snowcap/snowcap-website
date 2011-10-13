<?php
namespace Snowcap\AdminBundle\Admin;

abstract class Content {
    abstract public function getContentName();
    abstract public function getEntityName();
    abstract public function getGridFields();
}