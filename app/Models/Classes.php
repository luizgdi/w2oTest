<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Classes extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_subject',
        'day_of_week'
    ];


    public function subject()
    {
        return $this->hasOne(Subject::class, 'id', 'id_subject');
    }


    public function getAvailableSubjects($dayOfWeek)
    {
        $limitedOnes = DB::select(
            'SELECT id_subject, COUNT(*) as count FROM classes GROUP BY id_subject HAVING count = 3'
        );

        if (count($limitedOnes) == 4) {
            $count = '< 2';
        } else {
            $count = '< 3';
        }

        $results = DB::select(
            'SELECT
                s.id, s.name, COUNT(*) as count
            FROM
                subjects AS s
                LEFT JOIN classes AS c ON (c.id_subject = s.id)
            GROUP BY
                c.id_subject, s.name, s.id
            HAVING count ' . $count
        );

        $subjectsInDay = DB::select('SELECT id_subject FROM classes WHERE day_of_week = ?', [$dayOfWeek]);

        foreach ($results as $key => $result) {
            foreach ($subjectsInDay as $subjectInDay) {
                if ($result->id == $subjectInDay->id_subject) {
                    unset($results[$key]);
                }
            }
        }

        return $results;
    }
}
