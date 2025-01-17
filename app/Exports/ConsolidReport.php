<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithTitle;
use App\Models\EnvironmentalCondition;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use Maatwebsite\Excel\Concerns\WithEvents;

// Clase principal que une las tres hojas
class ConsolidReport implements WithMultipleSheets
{
    private $idEvaluated;
    private $dataOption;
    private $idProject;
    private $benchmark;

    /**
     * Constructor
     *
     * @param int $idEvaluated
     * @param string $dataOption
     * @param int $idProject
     * @param string $benchmark
     */
    public function __construct(int $idEvaluated, string $dataOption, int $idProject, string $benchmark)
    {
        $this->idEvaluated = $idEvaluated;
        $this->dataOption = $dataOption;
        $this->idProject = $idProject;
        $this->benchmark = $benchmark;
    }

    /**
     * Define las hojas del archivo Excel
     *
     * @return array
     */
    public function sheets(): array
    {
        return [
            new DataEvaluatedSheet($this->idEvaluated, $this->idProject, $this->benchmark), // Primera hoja
            new JudgmentsSheet($this->idEvaluated, $this->dataOption), // Segunda hoja
            new EnvironmentalConditionsSheet($this->idEvaluated), //Tercer hoja
        ];
    }
}

// Primera hoja: Datos de la evaluación
class DataEvaluatedSheet implements FromQuery, WithHeadings, WithMapping, WithTitle, WithEvents
{
    private $idEvaluated;
    private $idProject;
    private $benchmark;


    /**
     * Constructor
     *
     * @param int $idEvaluated
     * @param int $idProject
     * @param string $benchmark
     */
    public function __construct(int $idEvaluated, int $idProject, string $benchmark)
    {
        $this->idEvaluated = $idEvaluated;
        $this->idProject = $idProject;
        $this->benchmark = $benchmark;
    }

    /**
     * Query para exportar los datos
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return DB::table('evaluated_fragances')
            ->where('id_evaluated_fragance', $this->idEvaluated)
            ->orderBy('id_evaluated_fragance');
    }

    /**
     * Mapea cada fila de datos
     *
     * @param object $dataEvaluation
     * @return array
     */
    public function map($evaluated): array
    {

        $idAnalisys = DB::table('projects')
            ->where('id_project', $this->idProject)
            ->first();

        if ($this->benchmark == $evaluated->fragance_test_code_1) {
            return [
                [
                    $evaluated->fragance_name_2,
                    $evaluated->fragance_counter_2,
                    $evaluated->fragance_ms_2,
                    $evaluated->fragance_test_code_2,
                    $idAnalisys->id_analisys
                ],
                [
                    $evaluated->fragance_name_1,
                    $evaluated->fragance_counter_1,
                    $evaluated->fragance_ms_1,
                    $evaluated->fragance_test_code_1,
                    $idAnalisys->id_analisys
                ]
            ];
        } else {
            return [
                [
                    $evaluated->fragance_name_1,
                    $evaluated->fragance_counter_1,
                    $evaluated->fragance_ms_1,
                    $evaluated->fragance_test_code_1,
                    $idAnalisys->id_analisys
                ],
                [
                    $evaluated->fragance_name_2,
                    $evaluated->fragance_counter_2,
                    $evaluated->fragance_ms_2,
                    $evaluated->fragance_test_code_2,
                    $idAnalisys->id_analisys
                ]
            ];
        }
    }

    /**
     * Define los encabezados de la hoja
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Nombre Fragancia',
            'Contador',
            'MS',
            'Código TEST',
            'Analisis'
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Data Evaluación';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $queryResult = $this->query()->get();
                $totalRows = $queryResult->count() + 1;
                $totalColumns = count($this->headings());
                $lastColumn = Coordinate::stringFromColumnIndex($totalColumns);
                $cellRange = "A1:{$lastColumn}{$totalRows}";

                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ]);
            },
        ];
    }
}

// Segunda hoja: Datos de los juicios
class JudgmentsSheet implements FromQuery, WithHeadings, WithMapping, WithTitle, WithEvents
{
    private $idEvaluated;
    private $dataOption;
    /**
     * Constructor
     *
     * @param int $idEvaluated
     * @param string $dataOption
     */
    public function __construct(int $idEvaluated, $dataOption)
    {
        $this->idEvaluated = $idEvaluated;
        $this->dataOption = $dataOption;
    }

    /**
     * Query para exportar los datos
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function query()
    {
        if ($this->dataOption == "modified") {
            return DB::table('judments')
                ->where('evaluated_fragances_id_evaluated_fragance', $this->idEvaluated)
                ->select(
                    'carrier_type',
                    'judges_id_judge',
                    'fragance_1',
                    'fragance_2',
                    'qualification_control_1_frag_1',
                    'qualification_control_1_frag_2',
                    'qualification_control_2_frag_1',
                    'qualification_control_2_frag_2',
                    'qualification_control_3_frag_1',
                    'qualification_control_3_frag_2',
                    'qualification_control_4_frag_1',
                    'qualification_control_4_frag_2'
                )
                ->orderBy('carrier_type', 'asc')
                ->orderBy(DB::raw('judges_id_judge + 0'));
        } else {
            return DB::table('judments')
                ->where('evaluated_fragances_id_evaluated_fragance', $this->idEvaluated)
                ->select(
                    'carrier_type',
                    'judges_id_judge',
                    'fragance_1',
                    'qualification_control_1_frag_1',
                    'qualification_control_2_frag_1',
                    'qualification_control_3_frag_1',
                    'qualification_control_4_frag_1',
                    'fragance_2',
                    'qualification_control_1_frag_2',
                    'qualification_control_2_frag_2',
                    'qualification_control_3_frag_2',
                    'qualification_control_4_frag_2',
                )
                ->orderBy('carrier_type', 'asc')
                ->orderBy(DB::raw('judges_id_judge + 0'));
        }
    }

    /**
     * Mapea cada fila de datos
     *
     * @param object $judment
     * @return array
     */
    public function map($judment): array
    {
        if ($this->dataOption == "modified") {
            return [
                $judment->carrier_type,
                $judment->judges_id_judge,
                $judment->qualification_control_1_frag_1,
                $judment->qualification_control_1_frag_2,
                $judment->qualification_control_2_frag_1,
                $judment->qualification_control_2_frag_2,
                $judment->qualification_control_3_frag_1,
                $judment->qualification_control_3_frag_2,
                $judment->qualification_control_4_frag_1,
                $judment->qualification_control_4_frag_2,
            ];
        } else {
            return [
                $judment->carrier_type,
                $judment->judges_id_judge,
                $judment->fragance_1,
                $judment->qualification_control_1_frag_1,
                $judment->qualification_control_2_frag_1,
                $judment->qualification_control_3_frag_1,
                $judment->qualification_control_4_frag_1,
                $judment->fragance_2,
                $judment->qualification_control_1_frag_2,
                $judment->qualification_control_2_frag_2,
                $judment->qualification_control_3_frag_2,
                $judment->qualification_control_4_frag_2,
            ];
        }
    }

    /**
     * Define los encabezados de la hoja
     *
     * @return array
     */
    public function headings(): array
    {
        if ($this->dataOption == "modified") {
            $fragances = DB::table('judments')
                ->where('evaluated_fragances_id_evaluated_fragance', $this->idEvaluated)
                ->select(
                    'fragance_1',
                    'fragance_2',
                )
                ->first();
            return [
                'Portador',
                'Juez',
                'Control 1 - ' . $fragances->fragance_1,
                'Control 1 - ' . $fragances->fragance_2,
                'Control 2 - ' . $fragances->fragance_1,
                'Control 2 - ' . $fragances->fragance_2,
                'Control 3 - ' . $fragances->fragance_1,
                'Control 3 - ' . $fragances->fragance_2,
                'Control 4 - ' . $fragances->fragance_1,
                'Control 4 - ' . $fragances->fragance_2,
            ];
        } else {
            return [
                'Portador',
                'Juez',
                'Frag 1',
                'C1 - Inicial',
                'C2 - 3H',
                'C3 - 4H30',
                'C4 - 6H',
                'Frag 2',
                'C1 - Inicial',
                'C2 - 3H',
                'C3 - 4H30',
                'C4 - 6H'
            ];
        }
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Juicios';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $queryResult = $this->query()->get();
                $totalRows = $queryResult->count() + 1;
                $totalColumns = count($this->headings());
                $lastColumn = Coordinate::stringFromColumnIndex($totalColumns);
                $cellRange = "A1:{$lastColumn}{$totalRows}";

                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ]);
            },
        ];
    }
}

// Tercer hoja: Datos del termohigómetro
class EnvironmentalConditionsSheet implements FromQuery, WithHeadings, WithMapping, WithTitle, WithEvents
{
    private $idEvaluated;

    /**
     * Constructor
     *
     * @param int $idEvaluated
     */
    public function __construct(int $idEvaluated)
    {
        $this->idEvaluated = $idEvaluated;
    }

    /**
     * Query para exportar los datos
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return DB::table('environmental_conditions')
            ->where('evaluated_fragances_id_evaluated_fragance', '=', $this->idEvaluated)
            ->orderBy('carrier');
    }

    /**
     * Mapea cada fila de datos
     *
     * @param object $environmental
     * @return array
     */
    public function map($environmental): array
    {
        return [
            [
                $environmental->carrier,
                'Control 1',
                $environmental->control_1_temp_start,
                $environmental->control_1_temp_end,
                $environmental->control_1_humidity_start,
                $environmental->control_1_humidity_end
            ],
            [
                $environmental->carrier,
                'Control 2',
                $environmental->control_2_temp_start,
                $environmental->control_2_temp_end,
                $environmental->control_2_humidity_start,
                $environmental->control_2_humidity_end
            ],
            [
                $environmental->carrier,
                'Control 3',
                $environmental->control_3_temp_start,
                $environmental->control_3_temp_end,
                $environmental->control_3_humidity_start,
                $environmental->control_3_humidity_end
            ],
            [
                $environmental->carrier,
                'Control 4',
                $environmental->control_4_temp_start,
                $environmental->control_4_temp_end,
                $environmental->control_4_humidity_start,
                $environmental->control_4_humidity_end
            ]
        ];
    }

    /**
     * Define los encabezados de la hoja
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Portador',
            'Control',
            'T Inicial (°C)',
            'T Final (°C)',
            'H Inicial (%)',
            'H Final (%)'
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Data TermoHigometro';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $queryResult = $this->query()->get();
                $totalRows = $queryResult->count() * 4 + 1; // Multiplica por 4 porque cada registro genera 4 filas
                $totalColumns = count($this->headings());
                $lastColumn = Coordinate::stringFromColumnIndex($totalColumns);
                $cellRange = "A1:{$lastColumn}{$totalRows}";

                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ]);
            },
        ];
    }
}
