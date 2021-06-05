<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Substitute;
use DateInterval;
use DatePeriod;
use DateTime;
use Symfony\Component\HttpFoundation\Request;

class ClassController extends Controller
{
    /*
     * Calcula o range de dias a ser exibido no calendário
     */
    public function index(Classes $model, Substitute $substituteModel)
    {
        $startDate = new DateTime('first day of this month');
        $dayOfWeek = $startDate->format('w');

        while ($dayOfWeek != 1) {
            $startDate->modify('-1 day');

            $dayOfWeek = $startDate->format('w');
        }

        $endDate = new DateTime('last day of this month');
        $dayOfWeek = $endDate->format('w');

        while ($dayOfWeek != 1) {
            $endDate->modify('+1 day');

            $dayOfWeek = $endDate->format('w');
        }

        $rangeOfDays = new DatePeriod(
            $startDate,
            new DateInterval('P1D'),
            $endDate
        );

        $classes = $model::with('subject')->get()->groupBy('day_of_week');

        foreach ($classes as $key => $class) {
            $classes[$key] = $class->pluck('subject')->pluck('name')->toArray();
        }

        $substitutes = $substituteModel->with('subject')->get();

        return view('pages.classes.index', compact('classes', 'rangeOfDays', 'substitutes'));
    }


    public function edit($dayOfWeek, Classes $model)
    {
        return view('pages.classes.edit', compact('dayOfWeek'));
    }


    public function update($dayOfWeek, Classes $model, Request $request)
    {
        try {
            $model->where('day_of_week', $dayOfWeek)->delete();

            foreach ($request->get('subjects') as $subject) {
                $model->create([
                    'id_subject' => $subject,
                    'day_of_week' => $dayOfWeek
                ]);
            }

            notifySuccess('Aula cadastrada com sucesso!');
        } catch (\Exception $e) {
            notifyError("Oops, aconteceu um problema ao cadastrar! Código do erro: {$e->getCode()}");
        }

        return redirect()->route('classes.index');
    }


    public function getAvailableSubjects($dayOfWeek, Classes $model)
    {
        $availableSubjects = $model->getAvailableSubjects($dayOfWeek);

        return response()->json([
            'data' => $availableSubjects
        ], 200);
    }


    public function destroy($dayOfWeek, Classes $model)
    {
        try {
            $model->where('day_of_week', $dayOfWeek)->delete();

            notifySuccess('Aulas excluídas com sucesso');
        } catch (\Exception $e) {
            notifyError("Oops, aconteceu um problema ao excluir! Código do erro: {$e->getCode()}");
        }

        return redirect()->route('classes.index');
    }
}
