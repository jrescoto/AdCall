<?php
    //error_log(serialize($metrics));

    App::import('Vendor','xtcpdf'); 
    $tcpdf = new XTCPDF();
    $textfont = 'freesans'; // looks better, finer, and more condensed than 'dejavusans'

    $tcpdf->SetAuthor("Smart AdCall CMT at http://AdCall.com");
    $tcpdf->SetAutoPageBreak( false );
    /*
    $tcpdf->setHeaderFont(array($textfont,'',40));
    $tcpdf->xheadercolor = array(150,0,0);
    $tcpdf->xheadertext = 'AdCall CMT';
    $tcpdf->xfootertext = 'Copyright Â© %d Smart AdCall. All rights reserved.';
     */

    // add a page (required with recent versions of tcpdf)
    $tcpdf->AddPage();

    // Now you position and print your page content
    // example: 
    $tcpdf->SetTextColor(0, 0, 0);
    $tcpdf->SetFont($textfont,'B',10);
    $tcpdf->Cell(0,14, $metrics['Metrics']['sms_alert_sent'], 0,1,'L');
    $tcpdf->Cell(0,14, $metrics['Metrics']['10sec_audio'], 0,1,'L');
    $tcpdf->Cell(0,14, $metrics['Metrics']['60sec_call'], 0,1,'L');
    $tcpdf->Cell(0,14, $metrics['Metrics']['inc_billable'], 0,1,'L');
    // ...
    // etc.
    // see the TCPDF examples 

    echo $tcpdf->Output('filename.pdf', 'D');

?>
