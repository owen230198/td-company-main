<?php
namespace App\Services\ExportExcel;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
class ExportExcelService implements FromView, WithTitle, ShouldAutoSize, WithEvents
{
    protected $data;
    protected $template;
    function __construct($data, $template)
    {
        $this->data = $data;
        $this->template = $template;
    }
    public function title(): string
    {
        return $this->data['title'];
    }
    public function view(): View
    {
        $this->data['table_export'] = 1;
        return view($this->template, $this->data)->with('title', $this->data['title']);
    }

    public function registerEvents(): array
    {
        $title_rows = !empty($this->data['title_rows']) ? $this->data['title_rows'] : '3:4';
        return [
            AfterSheet::class => function(AfterSheet $event) use ($title_rows) {
                $event->sheet->getDelegate()->getDefaultRowDimension()->setRowHeight(19);
                $event->sheet->getStyle('A:X')->applyFromArray([
                    'font' => [
                        'size' => 8,
                        'name' => 'Microsoft Sans Serif', 
                    ],
                    'alignment' => [
                        'vertical' => Alignment::VERTICAL_TOP,
                    ],
                ]);
                $event->sheet->getStyle('1:2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'name' => 'Times New Roman',
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                $event->sheet->getStyle($title_rows)->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                $event->sheet->getStyle('1')->applyFromArray([
                    'font' => [
                        'size' => 14,
                    ],
                ]);
                $event->sheet->getStyle('2')->applyFromArray([
                    'font' => [
                        'size' => 11,
                    ],
                ]);
                // $event->sheet->setAutoFilter('B3:K3');
                foreach(range('A', $event->sheet->getHighestDataColumn()) as $columnID) {
                    $event->sheet->getDelegate()->getColumnDimension($columnID)->setAutoSize(true);
                }
            },
        ];
    }
    
}
