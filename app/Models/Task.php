<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'description',
        'creator_id',
        'assignee_id',
        'tester_id',
        'status_id',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function tester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tester_id', 'id');
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assignee_id', 'id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'task_id', 'id');
    }

    public function issueTypes(): HasOne
    {
        return $this->hasOne(IssueTypes::class, 'id', 'type');
    }

    public function worklogs(): HasMany
    {
        return $this->hasMany(Worklog::class);
    }
}
