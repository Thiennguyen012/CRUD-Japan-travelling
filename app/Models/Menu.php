<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menu extends Model
{
    protected $table = 'table_menu';
    // khai báo primarykey
    protected $PrimaryKey = 'menu_id';
    // không cho phép ghi đè lên menu_id
    protected $guarded = ['menu_id'];

    // tạo quan hệ với restaurant
    public function Restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }
}
