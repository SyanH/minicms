<?php

namespace vendor;

class Acl
{
    protected $resources = [];
    protected $groups    = [];
    protected $rights    = [];

    /**
     * 添加资源和动作
     * @param string $resource
     * @param array $actions
     */
    public function addResource($resource, $actions = [])
    {
        $this->resources[$resource] = $actions;
    }

    /**
     * 添加组
     * @param string $name
     * @param boolean $isSuperAdmin
     */
    public function addGroup($name, $isSuperAdmin = false)
    {
        $this->groups[$name] = $isSuperAdmin;
    }
    
    /**
     * 验证组是否存在
     * @param string $group
     * @return boolean
     */
    public function hasGroup($group)
    {
        return isset($this->groups[$group]);
    }
    
    /**
     * 获取所有组
     * @return array
     */
    public function getGroups()
    {
        return $this->groups;
    }
    
    /**
     * 获取所有资源
     * @return array
     */
    public function getResources()
    {
        return $this->resources;
    }
    
    /**
     * 设置允许资源
     * @param string $group
     * @param string $resource
     * @param array $actions
     */
    public function allow($group, $resource, $actions = [])
    {
        $actions = (array) $actions;
        if(!count($actions)){
            $actions = $this->resources[$resource];
        }
        foreach($actions as &$action){
            $this->rights[$group][$resource][$action] = true;
        }
    }
    
    /**
     * 禁用组资源
     * @param string $group
     * @param string $resource
     * @param array $actions
     */
    public function deny($group, $resource, $actions = [])
    {
        $actions = (array) $actions;
        if(!count($actions)){
            $actions = $this->resources[$resource];
        }
        foreach($actions as &$action){
            if(isset($this->rights[$group][$resource][$action])){
                unset($this->rights[$group][$resource][$action]);
            }
        }

    }
    
    /**
     * 验证是否有权限
     * @param array|string $groups
     * @param string $resource
     * @param array|String $actions
     * @return boolean
     */
    public function hasAccess($groups, $resource, $actions)
    {
        $groups  = (array) $groups;
        $actions = (array) $actions;
        if(!isset($this->resources[$resource])) {
            return false;
        }
        foreach($groups as $g) {
            if(!isset($this->groups[$g])) continue;
            if($this->groups[$g]==true) return true; // isSuperAdmin
            foreach($actions as $action) {
                if(isset($this->rights[$g][$resource][$action])) {
                    return true;
                }
            }
        }
        return false;
    }

}