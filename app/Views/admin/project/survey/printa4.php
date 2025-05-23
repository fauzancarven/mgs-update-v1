<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title><?= 'SVY_'.$survey->SurveyCustName.'_'.$survey->SurveyDate ?></title>
    <link rel="stylesheet" type="text/css" href="assets/fonts/roboto/roboto.css">
    <link rel="stylesheet" type="text/css" href="assets/fonts/poppins/poppins.css">  
    <link rel="shortcut icon" href="assets/images/logo/logo.png" />
</head>
<style>  
    body { 
        margin-top: 2cm;
        margin-bottom: 2.5cm;
        padding: 5px;
        padding-left: 0px;
        padding-right: 0px;
        font-family: "Poppins", serif;
        font-size: 10px;
    }
    @page {
        margin: 5px;
        margin-left: 0px;
        margin-right: 0px;
        padding-bottom: 200px;
    }
    .footer {
        width: 100%;
        position: fixed; 
        bottom: 0px; 
        left: 0px; 
        right: 0px;
        height: 100px;   
        color: red;
        text-align: center;
        line-height: 35px;
    }
    .line{
        position: absolute; 
        height: 40px; 
        width: 100%;
        bottom: 0px;
        left:0px;
        background-color: #f3f3f3;
    }
    .line-1{
        position: absolute; 
        height: 50px; 
        width: 100%;
        bottom: -45px;
        right:18px;
        border-top-left-radius: 50px;
        background-color: #012943;
    }
    .line-2{
        position: absolute; 
        height: 60px; 
        width: 100%;
        bottom: -45px;
        right:-300px;
        border-top-left-radius: 100%;
        background-color: #0d8af1;
    }
    
    .fixed{
        position: fixed;
        top: 0;
        height:50px;
        width: 100%;
    }
    .header{ 
        position: relative;
    }
    .logo{
        position: absolute;
        height: 80px;
        width: 180px;
        z-index: 1;
        background-color: #0d8af1;
        border-bottom-right-radius: 75px;
    } 
    .logo img{
        position: absolute;
        height: 65px;
        width: 80px;
        left: 41px;
        top: 5px;
        object-fit: contain;
    }
    .logo img.mgs{ 
        height: 65px;
        width: 100px;
        left: 30px;
        top: 5px;
        object-fit: contain;
    }
    .deskripsi{
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 50px;
        margin-top: 20px;
        margin-bottom: 15px; 
        background: #f3f3f3;
    }
    .deskripsi table{
        z-index:2; 
        width: 100%;
        padding-top: 3px;
        padding-left: 220px;
        padding-right: 20px;
        font-family: "Poppins", serif;
        font-weight: 600;
        color: #5c5c5c;
    }
    .slogan{
        position: absolute; 
        padding-left: 22px;
        right: 0;
        top: 0;
        height: 20px;
        width: 200px; 
        background: #0d8af1;
        color: white;
        font-size: 8px; 
        border-top-left-radius: 20px;
        font-family: "Poppins", serif;
        font-weight: bolder;

    }
    .text-slogan{ 
        font-family: "Roboto", serif;
        font-weight: 900;
        padding-left: 25px;
        line-height: 13px;
    }
    .fa-solid {
        display: inline;
        font-style: normal;
        font-variant: normal;
        font-weight: normal;
        font-size: 14px;
        line-height: 1;
        font-family: "FontAwesome";
        font-size: inherit;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        width: 20px;
    }
    .icon{
        height: 17px;
        width: 17px;
        background: #0d8af1;
        border-radius: 7px; 
    }
    .icon img{ 
        width: 9px;
        height: 9px; 
        color:white; 
        padding: 3px;  
        padding-left: 4px; 
    } 
    .body{
        margin-top: 0px;
        padding: 0 30px;
        font-family: "Roboto", serif;
        color: #000;
        font-size: 12px;
    }
    .text-center{
        display: block;
        margin-left: auto; 
        margin-right: auto;
        text-align: center;
        color: #305176;
    }
    .text-bold{
        font-weight: bold;
    }
    .d-inline-block{ 
        display: inline-block;
    }
    .width-label{
        min-width: 100px;
        width: 100px; 
    }
    table.item{
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    table.item td {
        padding: 1px;
    }

    table.item td:nth-child(1) {
        width: 5%;
    }

    table.item td.image {
        width: 15%;
    }

    table.item td.text {
        width: 30%;
    }

    table.item td:nth-child(4) {
        width: auto;
    }

    table.item td:nth-child(5) {
        width: auto;
    }

    table.item td:last-child {
        width: auto;
    }
    .item th {
        background-color: #c6d9f0;
    }
    table.item, .item td,.item th {
        border: 1px solid;
    }
    .td-group{
        padding:5px 15px !important; 
    }
    .td-footer{
        padding:2px 15px !important; 
    }
    .td-center{
        text-align: center; 
    }
    .td-end{
        text-align: right; 
    }

    table.tc{ 
        border-collapse: collapse; 
    }
    table.tc, .tc td,.tc th { 
        padding-top: 0;
    }
    .ps-2{
       padding-left:15px !important;
    }
    ol { 
        padding: 0 5px;
        list-style:none;
        margin:0;
    }
    ul { 
        margin:0;
    }
    li {
        padding: 0 5px;
    } 
    li.bullet {
        padding: 0 5px;
    } 
    ol > li > ul {
        padding: 0;
        margin: 0;
    }
    .footer table, .footer th, .footer td { 
        border-collapse: collapse;
        text-align:center;
        margin-left:auto;
        margin-right:auto; 
        height:10px !important;
        align-items: start;
        justify-content: baseline;
        font-size:18px;
        color: #8eb2df;
    }
    .footer.mgs table , .footer.mgs th, .footer.mgs td {
        font-size:12px; 
        font-family: "Poppins", serif;
        font-weight: 600;
        color: #5c5c5c;
        text-align: start; 
        align-items: start;
        justify-content: baseline;
        line-height:1;
    }
    .divider{ 
        border-left:1px solid #88c3f4; 
        height:30px; 
        margin-left:7px; 
        margin-right:7px; 
    }
    tr.hide{
        display:none !important;
    }
    ol {
    counter-reset: item;
    }

    ol + ol {
    counter-reset: none; /* nilai none untuk menjumlahkan dari sebelumnya */
    }

    li[data-list="ordered"] {
        counter-increment: item;
    }

    li[data-list="ordered"]:before {
        content: counter(item) ". ";
        padding-right: 10px; 
    }
    li[data-list="bullet"]:before {
        content: "- ";
        padding-left: 10px; 
        padding-right: 10px; 
    }
    .width-label {
        width: 30px;
    }
</style>
<body>  
    <?= $header_footer["html"] ?>   
    <div class="body" > 
        <h2 class="text-center" style="margin-top:0;padding-top:0">FORM KUNJUNGAN (SURVEY)</h2>
        <table style="width: 100%;border-collapse: collapse;margin-bottom:10px">
            <tbody>
                <tr>
                    <td style="width: 50%;border:1px solid;vertical-align:start;">  
                        <table style="border-collapse:collapse;border:none">
                            <tbody> 
                                <tr>
                                    <td style="border:none;vertical-align:start;padding:left:3px;">
                                        <div class="width-label label-color d-inline-block">Customer :</div>
                                    </td> 
                                </tr> 
                                <tr>
                                    <td style="border:none;vertical-align:start;padding:left:3px;"><div class="label-color d-inline-block">
                                        <span class="text-bold"><?= $survey->SurveyCustName ?></span>
                                    </td> 
                                </tr> 
                                <tr> 
                                    <td style="border:none;vertical-align:start;padding:left:3px;"><div class="label-color d-inline-block">
                                        <span class="text-bold"><?= $survey->SurveyCustTelp ?></span>
                                    </td> 
                                </tr> 
                                <tr> 
                                    <td style="border:none;vertical-align:start;padding:left:3px;"><div class="label-color d-inline-block">
                                        <span class="text-bold"><?= $survey->SurveyAddress ?></span>
                                    </td> 
                                </tr> 
                            </tbody>
                        </table>   
                    </td> 
                    <td style="width: 50%;vertical-align:start;border:1px solid"> 
                        <table style="border-collapse:collapse;heigth:100%;width: 100%;">
                            <tbody>
                                <tr style="border-bottom:1px solid;margin:12px;">
                                    <td style="border:none;padding-left:3px;vertical-align:start;width:30px;">
                                        <div class="label-color d-inline-block">No. Doc.</div>
                                    </td>
                                    <td style="border:none;padding:2px;width: 3px;vertical-align:start;">
                                        <div class="label-color d-inline-block">:</div>
                                    </td>
                                    <td style="border:none;vertical-align:start;">
                                        <div class="label-color-1 d-inline-block text-bold"><?= $survey->SurveyCode ?></div>
                                    </td>
                                </tr>
                                <tr style="border-bottom:1px solid;margin:12px;">
                                    <td style="border:none;padding-left:3px;vertical-align:start;">
                                        <div class="width-label label-color d-inline-block">Tgl. Pembuatan.</div>
                                    </td>
                                    <td style="border:none;padding:2px;width: 3px;vertical-align:start;">
                                        <div class="label-color d-inline-block">:</div>
                                    </td>
                                    <td style="border:none;width: auto;vertical-align:start;">
                                        <div class="label-color-1 d-inline-block text-bold"><?= date_format(date_create($survey->SurveyDate),"d F Y") ?></div>
                                    </td>
                                </tr> 
                                <tr style="">
                                    <td style="border:none;padding-left:3px;vertical-align:start;">
                                        <div class="width-label label-color d-inline-block">Staff.</div>
                                    </td>
                                    <td style="border:none;padding:2px;width: 3px;vertical-align:start;">
                                        <div class="label-color d-inline-block">:</div>
                                    </td>
                                    <td style="border:none;width: auto;vertical-align:start;">
                                        <div class="label-color-1 d-inline-block text-bold">
                                            <?php 
                                                $no = 1;
                                                foreach ($staff as $item) {
                                                    echo $no . '. ' . $item->username . '<br>';
                                                    $no++;
                                                }
                                            ?> 
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table> 
                    </td>
                </tr> 
                    <td style="width: 50%;border:1px solid;text-align:center;height:50%;vertical-align:top;" colspan="2">Hasil Survey</td>
                <tr> 
                    <td style="width: 50%;border:1px solid;text-align:center;vertical-align:top;">Nama</td>
                    <td style="width: 50%;border:1px solid;text-align:center;vertical-align:top;">Tanda Tangan</td>
                </tr>  
                <tr> 
                    <td style="width: 50%;border:1px solid;text-align:center;vertical-align:top;height:200px"> </td>
                    <td style="width: 50%;border:1px solid;text-align:center;vertical-align:top;"> </td>
                </tr> 
            </tbody>
        </table>  
    </div> 
    
</body>

</html>