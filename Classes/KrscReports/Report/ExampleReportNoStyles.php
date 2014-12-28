<?php
/**
 * This file is part of KrscReports.
 *
 * Copyright (c) 2014 Krzysztof Ruszczyński
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @category KrscReports
 * @package KrscReports_Report
 * @copyright Copyright (c) 2014 Krzysztof Ruszczyński
 * @license http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version 1.0.0, 2014-12-28
 */

/**
 * Example report creating two tables in different worksheets with no styles set in PHPExcel. 
 * 
 * @category KrscReports
 * @package KrscReports_Report
 * @author Krzysztof Ruszczyński <http://www.ruszczynski.eu>
 */
class KrscReports_Report_ExampleReportNoStyles extends KrscReports_Report_ExampleReport
{
    /**
     * Method returns description of generated by that object worksheet.
     * @return string description of report
     */
    public function getDescription()
    {
        return 'Report with two tables in different worksheets with no styles.';
    }
    
    /**
     * Method responsible for creating PHPExcel object with generated report.
     * @return void
     */
    public function generate()
    {        
        KrscReports_Builder_Excel_PHPExcel::setPHPExcelObject( new PHPExcel() );
        $oCell = new KrscReports_Type_Excel_PHPExcel_Cell();
        
        $oBuilder = new KrscReports_Builder_Excel_PHPExcel_ExampleTable();
        $oBuilder->setCellObject( $oCell );
        $oBuilder->setData( array( array( 'First column' => '1', 'Second column' => '2' ), array( 'First column' => '3', 'Second column' => '4' ) ) );
        
        // creation of element responsible for creating table
        $oElementTable = new KrscReports_Document_Element_Table();
        $oElementTable->setBuilder( $oBuilder );
        
        
        $oBuilder2 = new KrscReports_Builder_Excel_PHPExcel_ExampleTable();
        $oBuilder2->setCellObject( $oCell );
        $oBuilder2->setData( array( array( 'First column' => '5', 'Second column' => '6' ), array( 'First column' => '7', 'Second column' => '8' ) ) );
        
        
        $oElementTable2 = new KrscReports_Document_Element_Table();
        $oElementTable2->setBuilder( $oBuilder2 );
       
        // adding table to spreadsheet
        $oElement = new KrscReports_Document_Element();
        $oElement->addElement( $oElementTable );
        $oElement->addElement( $oElementTable2, 'Second_one' );
        
                        
        $oElement->beforeConstructDocument();
        $oElement->constructDocument();
        $oElement->afterConstructDocument();
            
    }
}