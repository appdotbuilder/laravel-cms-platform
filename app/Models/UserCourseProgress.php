<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\UserCourseProgress
 *
 * @property int $id
 * @property int $user_id
 * @property int $course_id
 * @property int $lesson_id
 * @property bool $is_completed
 * @property int $time_spent_minutes
 * @property \Illuminate\Support\Carbon|null $completed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Course $course
 * @property-read \App\Models\Lesson $lesson
 * @property-read \App\Models\User $user
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|UserCourseProgress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCourseProgress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCourseProgress query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCourseProgress whereCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCourseProgress whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCourseProgress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCourseProgress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCourseProgress whereIsCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCourseProgress whereLessonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCourseProgress whereTimeSpentMinutes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCourseProgress whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCourseProgress whereUserId($value)
 * 
 * @mixin \Eloquent
 */
class UserCourseProgress extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'course_id',
        'lesson_id',
        'is_completed',
        'time_spent_minutes',
        'completed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_completed' => 'boolean',
        'time_spent_minutes' => 'integer',
        'completed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the progress.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the course that owns the progress.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the lesson that owns the progress.
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }
}