<?php

namespace App\Services;

use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use TCPDF;

/**
 * Servicio para usar plantillas de Word existentes (.docx)
 * Permite reemplazar variables en plantillas y generar PDFs
 */
class PlantillaWordService
{
    private $plantillasPath;
    private $tempPath;

    public function __construct()
    {
        $this->plantillasPath = FCPATH . 'sistema/assets/plantilla/';
        $this->tempPath = WRITEPATH . 'temp/';
        
        // Crear directorio temporal si no existe
        if (!is_dir($this->tempPath)) {
            mkdir($this->tempPath, 0755, true);
        }
    }

    /**
     * Generar PDF usando plantilla de Word existente
     */
    public function generarPDFConPlantillaExistente($nombrePlantilla, $variables, $opciones = [])
    {
        try {
            $rutaPlantilla = $this->plantillasPath . $nombrePlantilla;
            
            if (!file_exists($rutaPlantilla)) {
                throw new \Exception("Plantilla no encontrada: $nombrePlantilla");
            }
            
            // 1. Procesar plantilla con variables
            $documentoProcesado = $this->procesarPlantilla($rutaPlantilla, $variables);
            
            // 2. Convertir a HTML
            $html = $this->convertirWordAHTML($documentoProcesado);
            
            // 3. Generar PDF con TCPDF
            $pdf = $this->generarPDFDesdeHTML($html, $opciones['titulo'] ?? 'Documento');
            
            return $pdf;
            
        } catch (\Exception $e) {
            log_message('error', 'Error generando PDF con plantilla existente: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Procesar plantilla de Word reemplazando variables
     */
    private function procesarPlantilla($rutaPlantilla, $variables)
    {
        // Crear procesador de plantilla
        $templateProcessor = new TemplateProcessor($rutaPlantilla);
        
        // Reemplazar variables simples
        foreach ($variables as $clave => $valor) {
            if (is_string($valor) || is_numeric($valor)) {
                $templateProcessor->setValue($clave, $valor);
            }
        }
        
        // Reemplazar variables complejas (arrays, objetos)
        $this->reemplazarVariablesComplejas($templateProcessor, $variables);
        
        // Guardar documento procesado
        $documentoProcesado = $this->tempPath . 'procesado_' . uniqid() . '.docx';
        $templateProcessor->saveAs($documentoProcesado);
        
        return $documentoProcesado;
    }

    /**
     * Reemplazar variables complejas en la plantilla
     */
    private function reemplazarVariablesComplejas($templateProcessor, $variables)
    {
        foreach ($variables as $clave => $valor) {
            if (is_array($valor)) {
                // Variables de tipo array (ej: datos_socioeconomicos)
                if (isset($valor['tipo']) && $valor['tipo'] === 'tabla') {
                    $this->reemplazarTabla($templateProcessor, $clave, $valor);
                } elseif (isset($valor['tipo']) && $valor['tipo'] === 'lista') {
                    $this->reemplazarLista($templateProcessor, $clave, $valor);
                } else {
                    // Variables de tipo objeto simple
                    foreach ($valor as $subClave => $subValor) {
                        $templateProcessor->setValue($clave . '.' . $subClave, $subValor);
                    }
                }
            }
        }
    }

    /**
     * Reemplazar tabla en la plantilla
     */
    private function reemplazarTabla($templateProcessor, $clave, $datosTabla)
    {
        if (isset($datosTabla['columnas']) && isset($datosTabla['filas'])) {
            // Crear HTML de tabla
            $htmlTabla = $this->generarHTMLTabla($datosTabla);
            $templateProcessor->setValue($clave, $htmlTabla);
        }
    }

    /**
     * Reemplazar lista en la plantilla
     */
    private function reemplazarLista($templateProcessor, $clave, $datosLista)
    {
        if (isset($datosLista['elementos'])) {
            $htmlLista = $this->generarHTMLLista($datosLista);
            $templateProcessor->setValue($clave, $htmlLista);
        }
    }

    /**
     * Generar HTML de tabla
     */
    private function generarHTMLTabla($datosTabla)
    {
        $html = '<table border="1" cellpadding="5" cellspacing="0" style="width:100%; border-collapse: collapse;">';
        
        // Encabezados
        if (isset($datosTabla['columnas'])) {
            $html .= '<thead><tr>';
            foreach ($datosTabla['columnas'] as $columna) {
                $html .= '<th style="background-color: #f8f9fa; font-weight: bold; text-align: center;">' . htmlspecialchars($columna) . '</th>';
            }
            $html .= '</tr></thead>';
        }
        
        // Filas de datos
        if (isset($datosTabla['filas'])) {
            $html .= '<tbody>';
            foreach ($datosTabla['filas'] as $fila) {
                $html .= '<tr>';
                foreach ($fila as $celda) {
                    $html .= '<td style="text-align: left;">' . htmlspecialchars($celda) . '</td>';
                }
                $html .= '</tr>';
            }
            $html .= '</tbody>';
        }
        
        $html .= '</table>';
        return $html;
    }

    /**
     * Generar HTML de lista
     */
    private function generarHTMLLista($datosLista)
    {
        $html = '<ul style="margin: 10px 0; padding-left: 20px;">';
        
        if (isset($datosLista['elementos'])) {
            foreach ($datosLista['elementos'] as $elemento) {
                $html .= '<li style="margin-bottom: 5px;">' . htmlspecialchars($elemento) . '</li>';
            }
        }
        
        $html .= '</ul>';
        return $html;
    }

    /**
     * Convertir documento Word procesado a HTML
     */
    private function convertirWordAHTML($documentoProcesado)
    {
        // Cargar documento procesado
        $phpWord = IOFactory::load($documentoProcesado);
        
        // Convertir a HTML
        $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');
        $htmlContent = '';
        
        ob_start();
        $htmlWriter->save('php://output');
        $htmlContent = ob_get_clean();
        
        // Limpiar archivo temporal
        unlink($documentoProcesado);
        
        return $htmlContent;
    }

    /**
     * Generar PDF desde HTML usando TCPDF
     */
    private function generarPDFDesdeHTML($html, $titulo)
    {
        // Crear nueva instancia de TCPDF
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        
        // Configurar información del documento
        $pdf->SetCreator('Sistema de Bienestar Estudiantil');
        $pdf->SetAuthor('ITSI - Administrador');
        $pdf->SetTitle($titulo);
        $pdf->SetSubject('Documento generado con plantilla Word');
        
        // Configurar márgenes
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(10);
        
        // Configurar auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 25);
        
        // Agregar página
        $pdf->AddPage();
        
        // Escribir HTML en el PDF
        $pdf->writeHTML($html, true, false, true, false, '');
        
        return $pdf;
    }

    /**
     * Generar PDF de ficha socioeconómica usando plantilla existente
     */
    public function generarFichaSocioeconomicaConPlantilla($ficha, $estudiante, $periodo, $datosFicha)
    {
        // Preparar variables para la plantilla
        $variables = [
            'fecha_generacion' => date('d/m/Y H:i:s'),
            'administrador' => session('nombre') ?? 'N/A',
            'id_administrador' => session('id') ?? 'N/A',
            
            // Información del estudiante
            'estudiante_nombre' => $estudiante['nombre'] . ' ' . $estudiante['apellido'],
            'estudiante_cedula' => $estudiante['cedula'],
            'estudiante_email' => $estudiante['email'],
            'estudiante_carrera' => $estudiante['carrera_nombre'] ?? 'N/A',
            
            // Información de la ficha
            'ficha_id' => $ficha['id'],
            'ficha_estado' => $ficha['estado'],
            'ficha_fecha_creacion' => date('d/m/Y H:i', strtotime($ficha['fecha_creacion'])),
            
            // Información del período
            'periodo_nombre' => $periodo['nombre'],
            'periodo_anio' => date('Y', strtotime($periodo['fecha_inicio'] ?? 'now')),
            
            // Datos socioeconómicos
            'ingresos_padre' => $datosFicha['ingresos_padre'] ?? '0.00',
            'ingresos_madre' => $datosFicha['ingresos_madre'] ?? '0.00',
            'otros_ingresos' => $datosFicha['otros_ingresos'] ?? '0.00',
            'total_ingresos' => $this->calcularTotalIngresos($datosFicha),
            
            'gastos_vivienda' => $datosFicha['gastos_vivienda'] ?? '0.00',
            'gastos_alimentacion' => $datosFicha['gastos_alimentacion'] ?? '0.00',
            'otros_gastos' => $datosFicha['otros_gastos'] ?? '0.00',
            
            'numero_dependientes' => $datosFicha['numero_dependientes'] ?? 'N/A',
            'tipo_vivienda' => $datosFicha['tipo_vivienda'] ?? 'N/A',
            'zona_residencia' => $datosFicha['zona_residencia'] ?? 'N/A',
            'nivel_educativo_padres' => $datosFicha['nivel_educativo_padres'] ?? 'N/A',
            
            // Tabla de ingresos
            'tabla_ingresos' => [
                'tipo' => 'tabla',
                'columnas' => ['Concepto', 'Monto ($)'],
                'filas' => [
                    ['Ingresos del Padre', '$' . number_format($datosFicha['ingresos_padre'] ?? 0, 2)],
                    ['Ingresos de la Madre', '$' . number_format($datosFicha['ingresos_madre'] ?? 0, 2)],
                    ['Otros Ingresos', '$' . number_format($datosFicha['otros_ingresos'] ?? 0, 2)]
                ]
            ],
            
            // Tabla de gastos
            'tabla_gastos' => [
                'tipo' => 'tabla',
                'columnas' => ['Concepto', 'Monto ($)'],
                'filas' => [
                    ['Gastos de Vivienda', '$' . number_format($datosFicha['gastos_vivienda'] ?? 0, 2)],
                    ['Gastos de Alimentación', '$' . number_format($datosFicha['gastos_alimentacion'] ?? 0, 2)],
                    ['Otros Gastos', '$' . number_format($datosFicha['otros_gastos'] ?? 0, 2)]
                ]
            ],
            
            // Lista de información familiar
            'lista_informacion_familiar' => [
                'tipo' => 'lista',
                'elementos' => [
                    'Número de Dependientes: ' . ($datosFicha['numero_dependientes'] ?? 'N/A'),
                    'Tipo de Vivienda: ' . ($datosFicha['tipo_vivienda'] ?? 'N/A'),
                    'Zona de Residencia: ' . ($datosFicha['zona_residencia'] ?? 'N/A'),
                    'Nivel Educativo de los Padres: ' . ($datosFicha['nivel_educativo_padres'] ?? 'N/A')
                ]
            ]
        ];
        
        // Generar PDF usando plantilla existente
        return $this->generarPDFConPlantillaExistente(
            'PLANTILLA PDFS.docx',
            $variables,
            ['titulo' => 'Ficha Socioeconómica - ' . $estudiante['nombre'] . ' ' . $estudiante['apellido']]
        );
    }

    /**
     * Calcular total de ingresos
     */
    private function calcularTotalIngresos($datosFicha)
    {
        $total = 0;
        if (isset($datosFicha['ingresos_padre'])) $total += floatval($datosFicha['ingresos_padre']);
        if (isset($datosFicha['ingresos_madre'])) $total += floatval($datosFicha['ingresos_madre']);
        if (isset($datosFicha['otros_ingresos'])) $total += floatval($datosFicha['otros_ingresos']);
        
        return number_format($total, 2);
    }

    /**
     * Listar plantillas disponibles
     */
    public function listarPlantillas()
    {
        $plantillas = [];
        $archivos = glob($this->plantillasPath . '*.docx');
        
        foreach ($archivos as $archivo) {
            $nombre = basename($archivo, '.docx');
            $plantillas[] = [
                'nombre' => $nombre,
                'archivo' => basename($archivo),
                'ruta' => $archivo,
                'tamaño' => filesize($archivo),
                'fecha_modificacion' => date('Y-m-d H:i:s', filemtime($archivo))
            ];
        }
        
        return $plantillas;
    }

    /**
     * Verificar si una plantilla existe
     */
    public function plantillaExiste($nombrePlantilla)
    {
        $rutaPlantilla = $this->plantillasPath . $nombrePlantilla;
        return file_exists($rutaPlantilla);
    }

    /**
     * Obtener información de una plantilla
     */
    public function obtenerInfoPlantilla($nombrePlantilla)
    {
        $rutaPlantilla = $this->plantillasPath . $nombrePlantilla;
        
        if (!file_exists($rutaPlantilla)) {
            return null;
        }
        
        return [
            'nombre' => basename($nombrePlantilla, '.docx'),
            'archivo' => basename($nombrePlantilla),
            'ruta' => $rutaPlantilla,
            'tamaño' => filesize($rutaPlantilla),
            'fecha_modificacion' => date('Y-m-d H:i:s', filemtime($rutaPlantilla)),
            'tipo_mime' => mime_content_type($rutaPlantilla)
        ];
    }
}
