<?php

namespace App\Filament\Pages;

use App\Models\Refugee;
use Filament\Pages\Page;
use Filament\Forms;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class GenerateReport extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string $view = 'filament.pages.generate-report';

    public $selectedFields = [];
    public $dateRange = [];

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\CheckboxList::make('selectedFields')
                ->label('اختر الحقول للتقرير')
                ->options([
                    'full_name' => 'الاسم رباعي',
                    'id_number' => 'رقم الهوية',
                    'phone_number' => 'رقم الجوال',
                    'family_members' => 'عدد أفراد الأسرة',
                    'spouse_full_name' => 'اسم الزوجة رباعي',
                    'spouse_id_number' => 'رقم هوية الزوجة',
                    'original_residence' => 'مكان السكن الأصلي',
                ])
                ->columns(2)
                ->required(),
            Forms\Components\DatePicker::make('dateRange')
                ->label('نطاق التاريخ')
                ->range()
        ];
    }

    public function generateReport()
    {
        $refugees = Refugee::query();

        if ($this->dateRange) {
            $refugees->whereBetween('created_at', [$this->dateRange['from'], $this->dateRange['to']]);
        }

        $refugees = $refugees->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // إضافة رؤوس الأعمدة
        $column = 1;
        foreach ($this->selectedFields as $field) {
            $sheet->setCellValueByColumnAndRow($column, 1, __($field));
            $column++;
        }

        // إضافة البيانات
        $row = 2;
        foreach ($refugees as $refugee) {
            $column = 1;
            foreach ($this->selectedFields as $field) {
                $sheet->setCellValueByColumnAndRow($column, $row, $refugee->$field);
                $column++;
            }
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'refugee_report_' . now()->format('Y-m-d_H-i-s') . '.xlsx';
        $path = Storage::path('public/' . $filename);
        $writer->save($path);

        return response()->download($path, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])->deleteFileAfterSend();
    }
}
