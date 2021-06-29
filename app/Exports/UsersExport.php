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
        return User::where('usertype','2')->get();
    }

    public function headings(): array
    {
        return [
            'S.No',
            'Name',
            'Email',
            'Email_Verified_At',
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
            '12th %',
            '10th %',
            'CGPA',
            'University Roll No'
        ];
    }
}
