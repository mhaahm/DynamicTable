<?php
/**
 * Created by PhpStorm.
 * User: Dell_PC
 * Date: 7/31/2019
 * Time: 22:17
 */

namespace Event;


class Emiter
{

    private static $the_instance;
    private $listeners = [];

    public static function getInstance():self
    {
        if (!self::$the_instance) {
            self::$the_instance = new self();
        }
        return self::$the_instance;
    }

    public function emit(string $event,...$args)
    {
        if(isset($this->listeners[$event])) {

            foreach ($this->listeners[$event] as $listener)
            {
                call_user_func_array($listener,$args);
            }
        }
    }

    public function on(string $event,callable $callable)
    {
        if(!isset($this->listeners[$event])) {
            $this->listeners[$event] = [];
        }
        $this->listeners[$event][] = $callable;
    }
}