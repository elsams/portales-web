<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fpdf;
use App\Models\ItemGuia;

class documentoController extends Controller
{
    //

    public function imprimeFormularioHerramienta($id_centro){
        ini_set('default_charset', 'utf-8');
        $ItemGuia = new ItemGuia();
        $Items =$ItemGuia->getItemsByCentro($id_centro);

        $cnt =1;
        $fpdf = new Fpdf('L');
        $fpdf->AddPage();
        $fpdf->SetFont('Arial','B',12);
        $fpdf->Cell(280,10,"Registro de Salidas y Entradas de Herramientas ".date('d-m-Y'),1,1,'C');
        $fpdf->Cell(280,10,"Folio: 1",1,1,'R');

        $fpdf->Cell(10,10,utf8_decode("N°"),1,0,'C');
        $fpdf->Cell(50,10,"Herramienta",1,0,'C');
        $fpdf->Cell(50,10,utf8_decode("N° Inventario"),1,0,'C');
        $fpdf->Cell(80,10,"Nombre y Rut",1,0,'C');
        $fpdf->Cell(30,10,"Firma",1,0,'C');
        $fpdf->Cell(30,10,"Hora Salida",1,0,'C');
        $fpdf->Cell(30,10,"Hora Entrada",1,1,'C');
        foreach($Items as $item){

            $fpdf->Cell(10,10,$cnt,1,0,'C');
            $fpdf->Cell(50,10,utf8_decode($item->nombre_herramienta),1,0,'C');
            $fpdf->Cell(50,10,$item->cod_inventario,1,0,'C');
            $fpdf->Cell(80,10,"",1,0,'C');
            $fpdf->Cell(30,10,"",1,0,'C');
            $fpdf->Cell(30,10,"",1,0,'C');
            $fpdf->Cell(30,10,"",1,1,'C');
            
            $cnt = $cnt+1;
        }
       
       // $fpdf->Cell(40,10,'¡Hola, Mundo!');
       
        header('Content-type: application/pdf; charset=utf-8');
        $fpdf->Output('D','archivo.pdf',false);
    }
}
