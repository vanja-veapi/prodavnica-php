<?php
    $filename = 'Autor.doc';
    header("Content-Type: application/force-download");
    header( "Content-Disposition: attachment; filename=".basename($filename));
    header( "Content-Description: File Transfer");
    @readfile($filename);
    $content = '<html xmlns:v="urn:schemas-microsoft-com:vml" '
        .'xmlns:o="urn:schemas-microsoft-com:office:office" '
        .'xmlns:w="urn:schemas-microsoft-com:office:word" '
        .'xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"= '
        .'xmlns="http://www.w3.org/TR/REC-html40">'
        .'<head><meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">'
        .'<title></title>'
        .'<!--[if gte mso 9]>'
        .'<xml>'
        .'<w:WordDocument>'
        .'<w:View>Print'
        .'<w:Zoom>100'
        .'<w:DoNotOptimizeForBrowser/>'
        .'</w:WordDocument>'
        .'</xml>'
        .'<![endif]-->'
        .'<style>
        @page
        {
            font-family: Arial;
            size:215.9mm 279.4mm;  /* A4 */
            margin:14.2mm 17.5mm 14.2mm 16mm; /* Margins: 2.5 cm on each side */
        }
        h2 { font-family: Arial; font-size: 18px; text-align:center; }
        p.para {font-family: Arial; font-size: 16.5px; text-align:center;}
        </style>'
        .'</head>'
        .'<body>'
        .'<h2>Podaci o autoru</h2><br/>'
        .'<p class="para">'
        .'<b>Ime</b>: Vanja<br/>
        <b>Prezime</b>: Veapi<br/>
        244/19 <b>Visoka ICT</b><br/>
        <b>Skills</b>: Web Developer, Front-end developer, Back-end developer, Graphic Design'
        .'</p>' 
        .'</body>' 
        .'</html>'; 
    echo $content;
?>