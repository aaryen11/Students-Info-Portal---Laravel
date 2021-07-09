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
        return User::where('usertype','2')->select(
        'name', 
        'university_roll_no',
        'email',
        'official_email_id',
        'github_profile',
        'XII',
        'X',
        'CGPA',
        'phone',
        'course',
        'branch',
        'section',
        'group',
        'university')->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'University Roll No',
            'Email',
            'Official Mail',
            'Github Profile',
            '12th %',
            '10th %',
            'CGPA',
            'Phone',
            'Course',
            'Branch',
            'Section',
            'Group',
            'University',
        ];
    }
}
