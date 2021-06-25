<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }

    public function headings(): array
    {
        return [
            'S.No',
            'Name',
            'Email',
            'Official Mail',
            'Phone',
            'Course',
            'Branch',
            'Section',
            'Group',
            'University',
            'User Type',
            'Created at',
            'Updated at',
        ];
    }
}
