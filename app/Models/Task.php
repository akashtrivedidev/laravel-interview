<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nette\Utils\Arrays;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TasksFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'priority',
    ];

    static public $Status = [
        'pending' => 0,
        'completed' => 1
    ];
    static public $Priorities = [
        'low' => 0,
        'medium' => 1,
        'high' => 2
    ];
}
