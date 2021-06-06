<?php

require_once APPPATH.'third_party/fpdf/fpdf.php';
require_once APPPATH.'third_party/fpdf/exfpdf.php';
require_once APPPATH.'third_party/fpdf/easyTable.php';
include 'config/IsRegisteredController.php';

class Pdf_download extends IsRegisteredController
{
    function __construct() {
        parent::__construct();
        $this->load->model('MarketingInfo_model','mkt_model');
    }

    
    public function student_result($id)
    {
        $sql = 'select * from tbl_result where seatno = "'.$id.'"';
        
        $result_set = $this->db->query($sql);

        if ($result_set->num_rows()) {
            $row = $result_set->row();
            $pdf = new exFPDF();
                  $pdf->AddPage();
                  $pdf->SetFont('Times','U', '', 10);
                  $pdf->SetFillColor(100,100,100);
                  
                  $table1 = new easyTable($pdf, 1);
                  $table1->easyCell('Result', 'font-size:20;align:C;font-style:B;');
                  $table1->printRow();
                  $table1->easyCell('ALL INDIA OPEN MATHEMATICS SCHOLARSHIP EXAMINATION - 2020', 'font-size:12; align:C;');
                  $table1->printRow();
                  $table1->easyCell('Conducted By', 'font-size:12; align:C;');
                  $table1->printRow();
                  $table1->easyCell('INSTITUTE FOR PROMOTION OF MATHEMATICS', 'font-size:12; align:C;');
                  $table1->printRow();
                  $table1->printRow();
                  $table1->endTable(5);/**********************************/;

                  $table = new easyTable($pdf, 2, 'border:1; border-color:#a1a1a1;border:1;');

                  $table->rowStyle('align:{CCCR};valign:M; font-color:#000000; font-family:times;');
                  $table->easyCell('Name : ', 'align:L;font-size:12;paddingY:2;bgcolor:#dddddd;');
                  $table->easyCell($row->fullname, 'font-style:B;align:L;font-size:12;paddingY:2;bgcolor:#dddddd;');
                  $table->printRow();
                  
                  $table->rowStyle('align:{CCCR};valign:M; font-color:#000000; font-family:times; ');
                  $table->easyCell('Standard : ', 'align:L;font-size:12;paddingY:2;bgcolor:#dddddd;');
                  $table->easyCell($row->standard, 'font-style:B;align:L;font-size:12;paddingY:2;bgcolor:#dddddd;');
                  $table->printRow();
                  
                  $table->rowStyle('align:{CCCR};valign:M; font-color:#000000; font-family:times; ');
                  $table->easyCell('Seat Number : ', 'align:L;font-size:12;paddingY:2;bgcolor:#dddddd;');
                  $table->easyCell($row->seatno, 'font-style:B;align:L;font-size:12;paddingY:2;bgcolor:#dddddd;');
                  $table->printRow();
                  
                  $table->rowStyle('align:{CCCR};valign:M; font-color:#000000; font-family:times;');
                  $table->easyCell('School Name : ', 'align:L;font-size:12;paddingY:2;bgcolor:#dddddd;');
                  $table->easyCell($row->school, 'font-style:B;align:L;font-size:12;paddingY:2;bgcolor:#dddddd;');
                  $table->printRow();
                  
                  $table->rowStyle('align:{CCCR};valign:M; font-color:#000000; font-family:times;');
                  $table->easyCell('School Code: ', 'align:L;font-size:12;paddingY:2;bgcolor:#dddddd;');
                  $table->easyCell($row->marks, 'font-style:B;align:L;font-size:12;paddingY:2;bgcolor:#dddddd;');
                  $table->printRow();
                  
                  $table->rowStyle('align:{CCCR};valign:M; font-color:#000000; font-family:times;');
                  $table->easyCell('Final Marks : ', 'align:L;font-size:12;paddingY:2;bgcolor:#dddddd;');
                  $table->easyCell($row->mark2, 'font-style:B;align:L;font-size:12;paddingY:2;bgcolor:#dddddd;');
                  $table->printRow();
                  
                  $table->rowStyle('align:{CCCR};valign:M; font-color:#000000; font-family:times;');
                  $table->easyCell('Mega Final Marks : ', 'align:L;font-size:12;paddingY:2;bgcolor:#dddddd;');
                  $table->easyCell($row->cutoff, 'font-style:B;align:L;font-size:12;paddingY:2;bgcolor:#dddddd;');
                  $table->printRow();
                  
                  $table->rowStyle('align:{CCCR};valign:M; font-color:#000000; font-family:times;');
                  $table->easyCell('Rank : ', 'align:L;font-size:12;paddingY:2;bgcolor:#dddddd;');
                  $table->easyCell($row->is_selected, 'font-style:B;align:L;font-size:12;paddingY:2;bgcolor:#dddddd;');
                  $table->printRow();
                                  
                  $table->endTable(5);
                  

                //   $pdf->Output();
                  $filename= (($row->seatno).'.pdf');
                  $pdf->Output($filename,'D');
        }
    }
    public function download_file($id)
    {
      if (!$this->session->userdata('userId')) {
            redirect('register');
        }
        $data=$this->mkt_model->get_blog_byId($id);
        
        if ($data[0]) {
            
            $pdf = new exFPDF();
              $pdf->AddPage();
              $pdf->SetFont('Times','U', '', 10);
              $pdf->SetFillColor(100,100,100);
              $column_data='';
              
              /*if(isset($data[0]->vic_bn_image) && $data[0]->vic_bn_image!=''){
                $pdf->Image(base_url('upload/logo/'.$data['0']->vic_bn_image),75,0,70,33);     
                
                if($data['0']->vic_bn_type=='news'){
                  $column_data=$data['0']->vic_bn_storytext;
                }
                if($data['0']->vic_bn_type=='article'){
                  $column_data=$data['0']->vic_description;
                }
              }else{
                echo 'File Not Exist in Directory';
                exit;
                $pdf->Image(base_url('upload/logo/kmslfekmslkkemtklr.png'),75,0,70,33); 
              }*/
              if($data['0']->vic_bn_type=='news'){
                  $column_data=$data['0']->vic_description;
                }
                if($data['0']->vic_bn_type=='article'){
                  $column_data=$data['0']->vic_description;
                }
              
              $table1 = new easyTable($pdf, 1);
              $table1->easyCell('', 'font-size:20;align:C;font-style:B;paddingY:10');
              $table1->printRow();
              $table1->easyCell($data[0]->vic_blogs_website_url, 'font-size:12; align:R;paddingY:5; font-color:#00008B;');
              $table1->printRow();
              $table1->easyCell(date('d-M-Y',strtotime($data[0]->vic_bn_createdat)), 'font-size:12; align:R;');
              $table1->printRow();
              $table1->easyCell($data[0]->vic_bn_title, 'font-size:16; align:L;');
              $table1->printRow();
              $table1->easyCell('', 'font-size:16; align:L;paddingY:3');
              $table1->printRow();
              $table1->easyCell($column_data);
              $table1->printRow();
              $table1->endTable(5);/**********************************/;
              // $pdf->Output();
              $filename= (($data[0]->vic_bn_createdat).'.pdf');
              $pdf->Output($filename,'D');
        }
    } 
}