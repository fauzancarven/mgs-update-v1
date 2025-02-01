<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title><?= 'INV_'.$project->CustomerName.'_'.$project->InvDate ?></title>
    <link rel="stylesheet" type="text/css" href="assets/fonts/roboto/roboto.css">
    <link rel="stylesheet" type="text/css" href="assets/fonts/poppins/poppins.css"> 
</head>
<style>  
   body { 
        margin-top: 2.5cm;
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
        padding:30px;
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
        min-width: 50px;
        width: 50px; 
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

    table.item td:nth-child(2) {
        width: 30%;
    }

    table.item td:nth-child(3) {
        width: 15%;
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
        padding: 0 20px;
    }
    li {
        padding: 0 5px;
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
</style>
<body>  
    <?= $header_footer ?>
    <div class="body">
        <h2 class="text-center">INVOICE (SALES ORDER)</h2>
        <table style="width: 100%;align-items: start;justify-content: baseline;">
            <tbody>
                <tr>
                    <td style="width: 40%;"> 
                        <span >Kepada Yth.:</span><br>
                        <span class="text-bold"><?= $project->CustomerName.($project->CustomerCompany == "" ? : " (".$project->CustomerCompany.")") ?></span><br> 
                        <span class="text-bold"><?= $project->CustomerTelp1.($project->CustomerTelp2 == "" ? : "/".$project->CustomerTelp2) ?></span><br>
                        <span class="text-bold"><?= $project->InvAddress ?></span><br>
                    </td>
                    <td style="width: 30%;"> 
                    </td>
                    <td style="align-items: start;justify-content: center;margin-left:auto"> 
                        <div class="width-label label-color d-inline-block">No. Doc.</div><div class="label-color d-inline-block">&nbsp;:&nbsp;</div><div class="label-color-1 d-inline-block text-bold"><?= $project->InvCode ?></div><br>
                        <div class="width-label label-color d-inline-block">Tgl.</div><div class="label-color d-inline-block">&nbsp;:&nbsp;</div><div class="label-color-1 d-inline-block text-bold"><?= date_format(date_create($project->InvDate),"d F Y") ?></div><br> 
                    </td>
                </tr>
            </tbody>
        </table>
        <div style="padding:20px;display:none;">
            Dengan Hormat. <br>
            <span style="padding-left:40px">Berikut kami turunkan lampiran penawaran barang dengan detail spesifikasi sebagai berikut :</span>
        </div>
               
        <table class="item">
            <thead>
                <tr> 
                    <th>No.</th>
                    <th>Uraian</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <?= (array_filter($detail, fn($item) => $item->InvDetailDisc > 0)) ? "<th>Disc</th>" : "" ?>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody> 
                <?php
                    $no = 1;
                    $huruf  = "A";
                    $html_items = "";
                    $discShow = array_filter($detail, fn($item) => $item->InvDetailDisc > 0);
                    foreach($detail as $item){

                        $arr_varian = json_decode($item->InvDetailVarian);
                        $arr_badge = ""; 
                        foreach($arr_varian as $varian){
                           if($varian->varian == "vendor") continue;

                            $arr_badge .= '<br><span style="font-size:10px;">'.ucfirst($varian->varian).' : '.$varian->value.'</span>'; 
                        }
                        if($item->InvDetailType == "product"){
                            $html_items .= '
                            <tr> 
                                <td class="td-center">'.$no.'</td>
                                <td class="ps-2">'.$item->InvDetailText.$arr_badge.'</td>
                                <td class="td-center">'.number_format($item->InvDetailQty, 2, ',', '.').' '.$item->InvDetailSatuanText.'</td>
                                <td class="td-center">Rp. '.number_format($item->InvDetailPrice, 0, ',', '.').'</td>
                                '.($discShow ? "<td class='td-center'>Rp. ".number_format($item->InvDetailDisc, 0, ',', '.')."</td>" : "").'
                                <td class="td-center">Rp. '.number_format($item->InvDetailTotal, 0, ',', '.').'</td>
                            </tr>';
                            $no++;
                        }else{
                            
                          
                            $html_items .= '    <tr>
                                                    <td class="td-group" colspan="'. ($discShow ? 6 : 5).'">'.$huruf.'. '.$item->InvDetailText.'</td>
                                                </tr>';
                            $huruf++;
                            $no = 1;
                        }
                    }
                    echo $html_items;
                ?> 
            </tbody>
            <tfoot>
                <tr>
                    <td class="td-footer text-bold" colspan="<?= (array_filter($detail, fn($item) => $item->InvDetailDisc > 0)) ? "5" : "4" ?>">Sub Total</td>
                    <td class="td-center text-bold">Rp. <?= number_format($project->InvSubTotal, 0, ',', '.') ?></td>
                </tr>
                <tr style="<?= $project->InvDiscItemTotal > 0 ? "" : "display:none;" ?>">
                    <td class="td-footer text-bold" colspan="<?= (array_filter($detail, fn($item) => $item->InvDetailDisc > 0)) ? "5" : "4" ?>">Disc Item</td>
                    <td class="td-center text-bold">Rp. <?= number_format($project->InvDiscItemTotal, 0, ',', '.') ?></td>
                </tr> 
                <tr style="<?= $project->InvDiscTotal > 0 ? "" : "display:none;" ?>">
                    <td class="td-footer text-bold" colspan="<?= (array_filter($detail, fn($item) => $item->InvDetailDisc > 0)) ? "5" : "4" ?>">Disc</td>
                    <td class="td-center text-bold">Rp. <?= number_format($project->InvDiscTotal, 0, ',', '.') ?></td>
                </tr>
                <tr>
                    <td class="td-footer text-bold" colspan="<?= (array_filter($detail, fn($item) => $item->InvDetailDisc > 0)) ? "5" : "4" ?>">Grand Total</td>
                    <td class="td-center text-bold">Rp. <?= number_format($project->InvGrandTotal, 0, ',', '.') ?></td>
                </tr>
                <tr>
                    <td class="td-footer text-bold" colspan="<?= (array_filter($detail, fn($item) => $item->InvDetailDisc > 0)) ? "6" : "5" ?>">DISIAPKAN OLEH : ADMIN<br>
                        DIRECT CONTACT : 0852-1795-2625<br>
                        BATA REGULER JAKARTA</td> 
                </tr>
            </tfoot>
        </table>
        <div style="padding-left:20px">
            Term and Condition :   
            <?= $project->TemplateFooterDetail ?> 
        </div>
    </div> 
</body>

</html>