<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Interview;

class Response extends Model
{
    use HasFactory;
    protected $fillable = [
        'interview_id',
        'status',
        'pesan',
        'schedule',
    ];

    public function interview()
{
	return $this->belongsTo(Interview::class);
}

}
