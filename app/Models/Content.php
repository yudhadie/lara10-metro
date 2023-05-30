<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Content extends Model
{
    use SoftDeletes;
    use HasFactory;
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Content')
            ->logOnly([
                'title', 'desc'
            ]);
    }

    protected $guarded = [];
    protected $table = 'content';

    public function content_category()
    {
        return $this->belongsTo(ContentCategory::class);
    }
}
