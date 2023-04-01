<?php

namespace App\Exports;

use App\Models\Interview;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class InterviewsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Interview::orderBy('created_at', 'DESC')->get();
    }

    public function headings(): array
    {
        return[
            'Name',
            'Email',
            'Age',
            'Phone Number',
            'Last Education',
            'Education Name',
            'Status',
            'Pesan',
            'Schedule',

        ];
    }

    public function map($item): array
    {
        if ($item->response){
            if ($item->response['status'] == 'Ditolak'){
                $schedule = '-';
            }else {
                $schedule = $item->response['schedule'];
            }
        }else{
            $schedule = '-';
        }
        
         return[
            $item->name,
            $item->email,
            $item->age,
            $item->phone_number,
            $item->last_education,
            $item->education_name,
            $item->response ? $item->response['status']: '-',
            $item->response ? $item->response['pesan']: '-',
            $schedule,
            
        ];
    }
}
