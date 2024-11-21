<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            'identity_no' => $row['identity_no'],
            'major_id'    => $row['major_id'],
            'name'        => $row['name'],
            'gender'      => $row['gender'],
            'religion'    => $row['religion'],
            'dob'         => $row['dob'],
            'phone'       => $row['phone'] ?? null,
            'address'     => $row['address'],
            'father_name' => $row['father_name'],
            'mother_name' => $row['mother_name'],
            'father_phone'=> $row['father_phone'] ?? null,
            'mother_phone'=> $row['mother_phone'] ?? null,
            'is_graduated'=> $row['is_graduated'] ?? false,
            'account_created' => $row['account_created'] ?? 0,
            'grade'       => $row['grade'] ?? 10,
            'photo'       => $row['photo'] ?? null,
        ]);
    }
}
