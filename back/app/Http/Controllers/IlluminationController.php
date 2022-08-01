<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IlluminationController extends Controller
{
    private $matrix; 
    private $matrixCollateral;
    private $matrixFin;
    /**
     * getRoom
     *
     * @return \Illuminate\Http\Response
     */
    public function getRoom(Request $request)
    {
        $file = $request->file('file');
        $this->matrix = $this->getMatrixByfile($file);
        $this->getMatrix();
        return  $this->matrix;
    }

    /**
     * getSumHorizontal
     *
     * 
    */
    private function getMatrix()
    {
        $total = 0;
        $this->matrixFin = $this->matrix;
        $final = true;
        for ($i = 0; $i < sizeof($this->matrix); $i++) {
            for ($j = 0; $j < sizeof($this->matrix[0]); $j++){
                if($this->matrix[$i][$j] === '0'){

                    $this->matrixCollateral = $this->matrix;
                    
                    $totalVertical = $this->getSumVertical($j,$i);   
                    $totalHorizontal = $this->getSumHorizontal($i,$j);

                    $totalTemp = $totalVertical + $totalHorizontal;

                    if($totalTemp >  $total ){
                        $total = $totalTemp;
                        $this->matrixFin = $this->matrixCollateral;
                        $this->matrixFin[$i][$j] = '2';
                    }

                    $final = false;
                }
            }
        }
        $this->matrix = $this->matrixFin;

        if(!$final){            
            return $this->getMatrix();
        }
    }
   /**
     * getSumHorizontal
     *
     * 
     */
    private function getSumHorizontal($position,$positionStatic)
    {
        $total = 1;    
        $matrix = $this->matrixCollateral;      
        for ($i = 0; $i < sizeof($this->matrix[$position]); $i++) {
            if($this->matrix[$position][$i] === '1'){ 

                if($i <= $positionStatic){
                    $total = 1; 
                    $matrix = $this->matrixCollateral; 
                    continue;
                }else{
                    $this->matrixCollateral = $matrix;
                    return $total;
                }

             }
             
             if($i != $positionStatic){
                $matrix[$position][$i] = '3';
                if($this->matrix[$position][$i] !== '3'){
                    $total++;
                }
             }
        }
        $this->matrixCollateral = $matrix;
        return $total;
    }
    /**
     * getSumVertical
     *
     * 
     */

    private function getSumVertical($position,$positionStatic)
    {
        $total = 1;
        $matrix = $this->matrixCollateral;
        for ($i = 0; $i < sizeof($this->matrix); $i++) {
            if($this->matrix[$i][$position] === '1'){
                if($i <= $positionStatic){
                    $total = 1; 
                    $matrix = $this->matrixCollateral;
                    continue;
                }else{
                    $this->matrixCollateral = $matrix;
                    return $total;
                }
            }
            if($i != $positionStatic){
                $matrix[$i][$position] = '3';
                if($this->matrix[$i][$position] !== '3'){
                    $total++;
                }
            }
        }
        $this->matrixCollateral = $matrix;
        return $total;
    }
    private function getMatrixByfile($file){
    
            $array_total = array();

            $fp = fopen($file,"r");

            while ($data = fgetcsv($fp, 10000, ',')){
    
                $array_total[] = $data;
    
            }
            fclose($fp);
    
            return $array_total;
    
    
    }
}
