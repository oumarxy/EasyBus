<?php

namespace UsersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class DefaultController extends Controller {

    public function indexAction() {
        
        $em = $this->getDoctrine()->getManager();
        //$localites = $em->getRepository('AppBundle:Localite')->findAll();
$declarations = $em->getRepository('AppBundle:Declaration')->findAll();

        // ask the service for a Excel5
        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

        $phpExcelObject->getProperties()->setCreator("PGP")
                ->setLastModifiedBy("JOEL De CURTIS")
                ->setTitle("Office 2005 XLSX Test Document")
                ->setSubject("Office 2005 XLSX Test Document")
                ->setDescription("Test document for Office 2005 XLSX, generated using PHP classes.")
                ->setKeywords("office 2005 openxml php")
                ->setCategory("Test result file");
        
        $i=0;
        foreach ($declarations as $declaration) {
            $i++;
            $phpExcelObject->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $declaration->getNumBl());
        }
        ////////////
          /*  $phpExcelObject->getActiveSheet()->getColumnDimension('A')->setWidth(102);
            $phpExcelObject->getActiveSheet()->getColumnDimension('B')->setWidth(12);
            $phpExcelObject->getActiveSheet()->getColumnDimension('C')->setWidth(14);
            $phpExcelObject->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $phpExcelObject->getActiveSheet()->getColumnDimension('E')->setWidth(16);
            $phpExcelObject->getActiveSheet()->getColumnDimension('F')->setWidth(12);
            $phpExcelObject->getActiveSheet()->getColumnDimension('G')->setWidth(10);
            $phpExcelObject->getActiveSheet()->getColumnDimension('H')->setWidth(15);
            $phpExcelObject->getActiveSheet()->getColumnDimension('I')->setWidth(10);
            $phpExcelObject->getActiveSheet()->getColumnDimension('J')->setWidth(17.5);

            $phpExcelObject->setActiveSheetIndex($sheetId)->mergeCells('A1:J6');
            $phpExcelObject->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true);
            $phpExcelObject->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $phpExcelObject->getActiveSheet()->getStyle('A1:J5')->applyFromArray($styleArray);
            $phpExcelObject->getActiveSheet()->getStyle('A:E')->applyFromArray($centreAlign);
        
        */
        
        ////////////


        $phpExcelObject->getActiveSheet()->setTitle('PGP');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $dispositionHeader = $response->headers->makeDisposition(
                ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'stream-file.xls'
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);

        return $response;
    }

}

/*
    public function indexAction()
    {
        return $this->render('UsersBundle:Default:index.html.twig');
    }
*/
