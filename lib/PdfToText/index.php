<meta charset="utf-8" />


<?php
	echo include ( 'PdfToText.phpclass' );

	
		
	

		
	$pdf	=  new PdfToText (  );
		
	
	$data = $pdf -> Text;

	echo $data ;