<?php

namespace App\Filament\Resources\RefugeeResource\Widgets;

use App\Models\Refugee;
use Filament\Forms\Components\FileUpload;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Contracts\View\View; // تأكد من إضافة هذه السطر
use Filament\Forms;

class RefugeeImportWidget extends Widget
{
    protected static string $view = 'filament.resources.refugee-resource.widgets.refugee-import-widget';

    public $file;

    protected function getFormSchema(): array
    {
        return [
            FileUpload::make('file')
                ->label('ملف Excel للاستيراد')
                ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                ->required(),
        ];
    }

    public function import()
    {
        $this->validate();

        // تأكد من استخدام المسار الصحيح للملف
        $path = Storage::path($this->file->getClientOriginalName());
        $this->file->storeAs('imports', $this->file->getClientOriginalName());

        $spreadsheet = IOFactory::load($path);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        // Remove header row
        array_shift($rows);

        foreach ($rows as $row) {
            if (!empty($row[0])) { // Check if the row is not empty
                Refugee::create([
                    'full_name' => $row[0],
                    'id_number' => $row[1],
                    'phone_number' => $row[2],
                    'family_members' => $row[3],
                    'spouse_full_name' => $row[4] ?? null,
                    'spouse_id_number' => $row[5] ?? null,
                    'original_residence' => $row[6] ?? null,
                ]);
            }
        }

        // حذف الملف بعد الاستيراد
        Storage::delete('imports/' . $this->file->getClientOriginalName());
        $this->file = null;

        $this->notify('success', 'تم استيراد البيانات بنجاح');
    }

    // تعديل هنا لتتوافق مع التوقيع المطلوب
    public function render(): View
    {
        return view('filament.resources.refugee-resource.widgets.refugee-import-widget');
    }
}
