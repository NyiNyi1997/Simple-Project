<?php

namespace App\Exports;

use App\Employee;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;



/** 

*@description->employee data export in collection function
*@name-> Nyi Nyi Aung
*@date-> 28/8/2020
*/

class EmployeesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents,WithTitle 
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $search_data;

    function  __construct($search_data) {
            $this->search_data = $search_data;
            
    }


    public function collection()
    {
        //return Employee::all(); //All Data from table

       // return Employee::select('id','employee_name','email','password','dob','gender')->withTrashed()->where($this->search_data )->get();

       $sql = DB::table('employees')
            ->join('emp_dep_positions', 'employees.id', '=', 'emp_dep_positions.employee_id')
            ->join('departments', 'departments.id', '=', 'emp_dep_positions.department_id')
            ->join('positions', 'positions.id', '=', 'emp_dep_positions.position_id')
            ->where($this->search_data)
            ->select('employees.*','departments.department_name', 'positions.position_name')
            
            ->get();
         return $sql;
       
    }


    public function headings(): array
    {
        return ["Employee ID", "Name", "Email", "Password", "Date of Birth","Gender","Department ID","Position ID"];
    }

    /**  
    *@Description-> Change excel style and color, modify 
    *@author-> nyi nyi aung
    *@date->28/08/2020
    */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:H1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $event->sheet->getStyle('A1:H1')->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FF00FF');
            },
            
        ];
    }
    public function title(): string
    {
        return 'Excel Export Employee';
    }

}
