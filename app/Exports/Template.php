<?php

namespace App\Exports;
use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
class Template implements WithHeadings
{
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'University',
            'Section',
            'Group',
            'UniversityRollNo',
        ];
    }
}
