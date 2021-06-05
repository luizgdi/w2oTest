<?php

namespace App\Http\Controllers;


use App\Models\Subject;
use App\Models\Substitute;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class SubstituteController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param Substitute $model
     * @return RedirectResponse
     */
    public function create(Substitute $model, Subject $subjectModel)
    {
        $subjects = $subjectModel->orderBy('name')->get();

        return view('pages.substitutes.create', compact('subjects'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Substitute $model
     * @return RedirectResponse
     */
    public function store(Request $request, Substitute $model)
    {
        try {
            $model->create([
                'id_subject' => $request->get('id_subject'),
                'start' => $request->get('start'),
                'end' => $request->get('end')
            ]);

            notifySuccess('Substituição cadastrada com sucesso!');
        } catch (\Exception $e) {
            notifyError("Oops, aconteceu um problema ao cadastrar! Código do erro: {$e->getCode()}");
        }

        return redirect()->route('classes.index');
    }


    /**
     * @param $id
     * @param Substitute $model
     * @return RedirectResponse
     */
    public function destroy($id, Substitute $model)
    {
        try {
            $model->findOrFail($id)->delete();

            notifySuccess('Substituição excluída com sucesso!');
        } catch (\Exception $e) {
            notifyError("Oops, aconteceu um problema ao excluir! Código do erro: {$e->getCode()}");
        }

        return redirect()->route('classes.index');
    }
}
