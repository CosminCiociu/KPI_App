<?php
if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['phone']) && isset($_POST['email'])) {
    ob_end_clean();
    $pdf = new FPDF();

    //Add a new page
    $pdf->AddPage();

    // Set the font for the text
    $pdf->SetFont('Arial', 'B', 18);

    // Framed rectangular area
    $pdf->Write(20, $msg);

    // return the generated output
    $pdf->Output('D', 'file.pdf');
}
