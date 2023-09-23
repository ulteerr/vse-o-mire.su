<?php

namespace app\lib\common;

use Redis;

class RedisHelper
{
    protected $redis;

    public function __construct()
    {
        $redis_connect = config('redis');
        $this->redis = new Redis();
        $this->redis->connect($redis_connect['host'], $redis_connect['port']);
    }

    public function exists($key)
    {
        return $this->redis->exists($key);
    }

    public function get($key)
    {
        $serializedData = $this->redis->get($key);
        if ($serializedData !== false) {
            return unserialize($serializedData);
        } else {
            return null;
        }
    }

    public function set($key, $value)
    {
        $serializedValue = serialize($value);
        $this->redis->set($key, $serializedValue);
    }
}
