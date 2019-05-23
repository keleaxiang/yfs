<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'type';

    protected $primaryKey = 'tid';

    public $timestamps = false;

    protected $guarded = [];
}
