<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //select * from employees inner join position on position.id = employees.position_id;
        $employees = Employee::with('position')->get();

        return view('employees.index',[
            'employees' => $employees,
            'module' => 'Funcionarios',
            'new' => 'Nuevo Funcionario',
            'notice' => 'No hay funcionarios registrados',
            'subject' => 'Lista de Funcionarios',
            'route' => route('employees.create'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions = Position::select('id','name')->orderBy('name')->get();

        return view('employees.create',[
            'employee' => $employee = new Employee,
            'positions' => $positions,
            'module' => 'Funcionarios',
            'subject' => 'Nuevo Funcionario',
            'button' => 'Guardar',
            'process' => route('employees.store'),
            'back' => route('employees.index'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|min:3',
            'rut' => 'required|string|min:7|unique:employees',
            'phone' => 'required|numeric|min:9|digits:9',
            'position' => 'required|integer'
        ]);

        if (!$this->validateRut($request->rut)) {
            return redirect('/employees/create')->with('danger','El RUT ingresado no es válido')->withInput();
        }

        $employee = new Employee;
        $employee->name = $request->name;
        $employee->rut = $request->rut;
        $employee->phone = $request->phone;
        $employee->position_id = $request->position;
        $employee->save();

        return redirect('/employees')->with('success','El funcionario se ha registrado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('employees.show', [
            'employee' => $employee,
            'module' => 'Funcionarios',
            'subject' => 'Detalle de Funcionario',
            'back' => route('employees.index')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $positions = Position::select('id','name')->orderBy('name')->get();

        return view('employees.edit',[
            'employee' => $employee,
            'positions' => $positions,
            'module' => 'Funcionarios',
            'subject' => 'Editar Funcionario',
            'button' => 'Editar',
            'process' => route('employees.update', $employee),
            'back' => route('employees.index'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $this->validate($request,[
            'name' => 'required|string|min:3',
            'rut' => 'required|string|min:7',
            'phone' => 'required|numeric|min:9|digits:9',
            'position' => 'required|integer'
        ]);

        if (!$this->validateRut($request->rut)) {
        return redirect('/employees/'.$employee->id.'/edit')->with('danger','El RUT ingresado no es válido')->withInput();
        }

        $employee = Employee::find($employee->id);
        $employee->name = $request->name;
        $employee->rut = $request->rut;
        $employee->phone = $request->phone;
        $employee->position_id = $request->position;
        $employee->save();

        return redirect('/employees/' . $employee->id)->with('success','El funcionario se ha modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }

    ##########################################################
    private function validateRut($rut)
    {
        $rut = preg_replace('/[^k0-9]/i', '', $rut);
        $dv = substr($rut, -1);
        $num = substr($rut, 0, strlen($rut)-1);
        $i = 2;
        $sum = 0;

        foreach(array_reverse(str_split($num)) as $v)
        {
            if($i==8)
            $i = 2;

            $sum += $v * $i;
            ++$i;
        }

        $dvr = 11 - ($sum % 11);

        if($dvr == 11)
            $dvr = 0;
        if($dvr == 10)
            $dvr = 'K';

        if($dvr == strtoupper($dv))
            return true;
        else
            return false;
    }
}
