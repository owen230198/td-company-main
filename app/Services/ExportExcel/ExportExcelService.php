<?php
namespace App\Services\ExportExcel;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
class ExportExcelService implements FromView, WithTitle, ShouldAutoSize, WithStyles
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
        return view($this->template, $this->data)->with('title', $this->data['title']);
    }
    
    public function styles(Worksheet $sheet)
    {
        return [
            '*' => [
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'height' => 30,
                'wrapText' => true,
            ],
            'A1' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'font' => ['bold' => true, 'size' => 14, 'name' => 'Times New Roman']
            ],
            'A2' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'font' => ['size' => 11, 'name' => 'Times New Roman', 'bold' => true]
            ],

            // Styling an entire column.
            'C'  => ['font' => ['size' => 8]],
        ];
    }
}
