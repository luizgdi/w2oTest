<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Subject $model
     * @return View
     */
    public function index(Subject $model)
    {
        $subjects = $model::orderBy('name')->get();

        return view('pages.subjects.index', compact('subjects'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @param Subject $model
     * @return View
     */
    public function edit($id, Subject $model)
    {
        $subject = $model->findOrFail($id);

        return view('pages.subjects.edit', compact('subject'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @param Subject $model
     * @return RedirectResponse
     */
    public function update(Request $request, $id, Subject $model)
    {
        $subject = $model->findOrFail($id);

        try {
            $subject->update([
                'teacher' => $request->get('teacher'),
                'substitute' => $request->get('substitute')
            ]);

            notifySuccess('Matéria atualizada com sucesso!');
        } catch (\Exception $e) {
            notifyError("Oops, aconteceu um problema ao atualizar! Código do erro: {$e->getCode()}");
        }

        return redirect()->route('subjects.index');
    }
}
