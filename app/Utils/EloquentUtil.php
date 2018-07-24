<?php

namespace App\Utils;

use \Illuminate\Database\Eloquent\Builder;

class EloquentUtil
{
    public static function getSql(Builder $model) {
        $sql = $model->toSql();
        $bindings = $model->getBindings();
        $needle = '?';
        foreach ($bindings as $replace) {
            $pos = strpos($sql, $needle);
            if ($pos !== false) {
                if(gettype($replace) == 'string') {
                    $replace = "'$replace'";
                }
                $sql = substr_replace($sql, $replace, $pos, strlen($needle));
            }
        }
        return $sql;
    }
}