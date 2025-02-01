<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title><?= 'PRO_INV_'.$project->CustomerName.'_'.$payment->PaymentDate ?></title>
    <link rel="stylesheet" type="text/css" href="assets/fonts/roboto/roboto.css">
    <link rel="stylesheet" type="text/css" href="assets/fonts/poppins/poppins.css"> 
</head>
<style>  
    body {
        padding: 5px;
        padding-top: 15px;
        padding-left: 0px;
        padding-right: 0px;
        font-family: "Poppins", serif;
        font-size: 11px;
    }
    @page {
        margin: 5px;
        margin-left: 0px;
        margin-right: 20px;
    }
    .header{ 
        position: relative;
    }
    .judul{
        position:absolute;
        top:70px;
        right: 30px;
        z-index: 100;
        color:black !important;
    }
    .logo{
        position: absolute;
        height: 80px;
        width: 200px;
        z-index: 1; 
        background-color: #FFF; 
        border-bottom-right-radius: 75px;
    } 
    .logo span{
        font-weight: bold;
        color: #000;
        font-family: "Roboto", serif;
        position: absolute; 
        top: 50px; 
        left: 20px;
    }
    .logo img{
        position: absolute;
        height: 40px;
        width: 60px;
        left: 50px;
        top: 10px;
        object-fit: contain;
    }
    .logo.mgs img{
        top: 0px;
        left: 30px;
        height: 80px;
        width: 140px;
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
        padding-top: 10px;
        padding-left: 220px;
        padding-right: 20px;
        font-family: "Roboto", serif;
        font-size: 10px; 
        /* color: #5c5c5c; */
        color:black;
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
        margin-top: 50px;
        padding:30px;
        padding-left:15px;
        font-family: "Roboto", serif;
        color: #000;
        font-size: 11px;
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
        line-height:1.2;
    }

    table.item td {
        padding: 0px;
    }

    table.item td:nth-child(1) {
        width: 3%;
    }

    table.item td:nth-child(2) {
        width: auto;
    }

    table.item td:nth-child(3) {
        width: 12%;
    }

    table.item td:nth-child(4) {
        width: 12%;
    } 
    table.item td:nth-child(5) {
        width: 10%;
    } 

    table.item td:last-child {
        width: 14%;
    }
    .item th {
        /* background-color: #c6d9f0; */
        border: 1px solid;  
    }
    .item td {
        /* background-color: #c6d9f0; */
        border-left: 1px solid;  
        border-right: 1px solid;  
    }
    table.item, .item td,.item th {
        /* border: 1px solid; */
    }
    .td-group{
        padding:1px 15px !important; 
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
    .text-end{
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
    .ps-1{
       padding-left:5px !important;
    }
    .footer {
        width: 100%;
        position: fixed; 
        bottom: 30px; 
        left: 0px; 
        right: 0px;
        height: auto;    
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
    
    .divider{ 
        border:1px solid #88c3f4;
        height:20px;
        margin:10px
    }
    .td-footer{
        padding:2px 15px !important; 
    }
    ol {
        padding: 0 20px; 
        margin:0px;
    }
    li {
        padding: 0px;
    } 
  
</style>
<body>  
    <?= $header_footer ?>
    <div class="body">
        <h4 class="judul text-center">INVOICE PROFORMA</h4>
        <table style="width: 100%;align-items: start;justify-content: baseline;">
            <tbody>
                <tr>
                    <td style="width: 75%;"> 
                        <span >Kepada Yth.:</span><br>
                        <span class="text-bold"><?= $project->CustomerName.($project->CustomerCompany == "" ? : " (".$project->CustomerCompany.")") ?></span>&nbsp;&nbsp;&nbsp;&nbsp;Telp : 
                        <span class="text-bold"><?= $project->CustomerTelp1.($project->CustomerTelp2 == "" ? : " / ".$project->CustomerTelp2) ?></span><br>
                        <span class="text-bold"><?= $project->InvAddress ?></span><br> 
                    </td> 
                    <td style="align-items: start;justify-content: center"> 
                        <div class="width-label label-color d-inline-block">No. Doc.</div><div class="label-color d-inline-block">&nbsp;:&nbsp;</div><div class="label-color-1 d-inline-block text-bold"><?= $payment->PaymentCode ?></div><br>
                        <div class="width-label label-color d-inline-block">Tgl.</div><div class="label-color d-inline-block">&nbsp;:&nbsp;</div><div class="label-color-1 d-inline-block text-bold"><?= date_format(date_create($payment->PaymentDate),"d F Y") ?></div><br> 
                    </td>
                </tr>
            </tbody>
        </table> 
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
                           // $arr_badge .= ' | <span style="font-size:10px;">'.ucfirst($varian->varian).' : '.$varian->value.'</span>';  
                            $arr_badge .= ' | <span style="font-size:10px;">'.$varian->value.'</span>';  
                        } 
                        if($item->InvDetailType == "product"){
                            $html_items .= '
                            <tr> 
                                <td class="td-center">'.$no.'</td>
                                <td class="ps-1">'.$item->InvDetailText.$arr_badge.'</td>
                                <td class="td-center">'.number_format($item->InvDetailQty, 2, ',', '.').' '.$item->InvDetailSatuanText.'</td>
                                <td class="td-center">
                                    <div style="width:15%;text-align:left;display:inline-block;line-height:1;margin:0;padding:0;">Rp.</div> 
                                    <div style="width:75%;text-align:right;display:inline-block;line-height:1;margin:0;padding:0;">'.number_format($item->InvDetailPrice, 0, ',', '.').'</div>
                                </td>
                                '.($discShow ? "<td class='td-center'>
                                    <div style='width:15%;text-align:left;display:inline-block;line-height:1;margin:0;padding:0;'>Rp.</div> 
                                    <div style='width:75%;text-align:right;display:inline-block;line-height:1;margin:0;padding:0;'>".number_format($item->InvDetailDisc, 0, ',', '.')."</div></td>" : "").'
                                <td class="td-center">
                                    <div style="width:15%;text-align:left;display:inline-block;line-height:1;margin:0;padding:0;">Rp.</div> 
                                    <div style="width:75%;text-align:right;display:inline-block;line-height:1;margin:0;padding:0;">'.number_format($item->InvDetailTotal, 0, ',', '.').'</div>
                                </td>
                            </tr>';
                            $no++;
                        }else{
                            
                          
                            $html_items .= '    <tr> 
                                                    <td class="td-center text-bold">'.$huruf.'</td>
                                                    <td class="ps-1 text-bold">'.$item->InvDetailText.'</td>
                                                    <td class="td-center"></td>
                                                    <td class="td-center"></td>
                                                    '.($discShow ? "<td class='td-center'></td>" : "").'
                                                    <td class="td-center"></td>
                                                </tr>';
                            $huruf++;
                            $no = 1;
                        }
                    }
                    echo $html_items;
                ?>

                <!-- <tr>
                    <td class="td-group" colspan="6">A. BARANG</td>
                </tr>
                <tr> 
                    <td class="td-center">1</td>
                    <td class="ps-2">Bata Belanda<br>Ukuran. 12 x 12 x 12cm</td>
                    <td class="td-center">10 Pcs</td>
                    <td class="td-center">Rp. 10.000</td>
                    <td class="td-center">Rp. 0</td>
                    <td class="td-center">Rp. 100.000</td>
                </tr>
                <tr> 
                    <td class="td-center">2</td>
                    <td class="ps-2">Bata Belanda<br>Ukuran. 12 x 12 x 12cm</td>
                    <td class="td-center">10 Pcs</td>
                    <td class="td-center">Rp. 10.000</td>
                    <td class="td-center">Rp. 0</td>
                    <td class="td-center">Rp. 100.000</td>
                </tr>
                <tr> 
                    <td class="td-center">3</td>
                    <td class="ps-2">Bata Belanda<br>Ukuran. 12 x 12 x 12cm</td>
                    <td class="td-center">10 Pcs</td>
                    <td class="td-center">Rp. 10.000</td>
                    <td class="td-center">Rp. 0</td>
                    <td class="td-center">Rp. 100.000</td>
                </tr> -->
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" style="border-top:1px solid;border-left:none;line-height:1;"></td>
                    <th class="td-footer text-bold"  style="line-height:1;" colspan="<?= (array_filter($detail, fn($item) => $item->InvDetailDisc > 0)) ? "3" : "2" ?>">Sub Total</th>
                    <th class="td-center text-bold">
                        <div style="width:15%;text-align:left;display:inline-block;line-height:1;margin:0;padding:0;">Rp.</div> 
                        <div style="width:75%;text-align:right;display:inline-block;line-height:1;margin:0;padding:0;"><?= number_format($project->InvSubTotal, 0, ',', '.') ?></div>
                    </th>
                </tr>
                <tr style="<?= $project->InvDiscItemTotal > 0 ? "" : "display:none;" ?>">
                    <td colspan="2" style="border-left:none;line-height:1;"></td>
                    <th class="td-footer text-bold"  style="line-height:1;" colspan="<?= (array_filter($detail, fn($item) => $item->InvDetailDisc > 0)) ? "3" : "2" ?>">Disc Item</th>
                    <th class="td-center text-bold">
                        <div style="width:15%;text-align:left;display:inline-block;line-height:1;margin:0;padding:0;">Rp.</div> 
                        <div style="width:75%;text-align:right;display:inline-block;line-height:1;margin:0;padding:0;"><?= number_format($project->InvDiscItemTotal, 0, ',', '.') ?></div>
                    </th>
                </tr> 
                <tr style="<?= $project->InvDiscTotal > 0 ? "" : "display:none;" ?>">
                    <td colspan="2" style="border-left:none;line-height:1;"></td>
                    <th class="td-footer text-bold"  style="line-height:1;" colspan="<?= (array_filter($detail, fn($item) => $item->InvDetailDisc > 0)) ? "3" : "2" ?>">Disc Total</th>
                    <th class="td-center text-bold">
                        <div style="width:15%;text-align:left;display:inline-block;line-height:1;margin:0;padding:0;">Rp.</div> 
                        <div style="width:75%;text-align:right;display:inline-block;line-height:1;margin:0;padding:0;"><?= number_format($project->InvDiscTotal, 0, ',', '.') ?></div>
                    </th>
                </tr>  
                <tr>
                    <td colspan="2" style="border-left:none;line-height:1;"></td>
                    <th class="td-footer text-bold"  style="line-height:1;" colspan="<?= (array_filter($detail, fn($item) => $item->InvDetailDisc > 0)) ? "3" : "2" ?>">Grand Total</th>
                    <th class="td-center text-bold">
                        <div style="width:15%;text-align:left;display:inline-block;line-height:1;margin:0;padding:0;">Rp.</div> 
                        <div style="width:75%;text-align:right;display:inline-block;line-height:1;margin:0;padding:0;"><?= number_format($project->InvGrandTotal, 0, ',', '.') ?></div>
                    </th>
                </tr> 
               
                <?php
                    $total_pay = 0;
                    foreach($payments as $row){
                        if($row->PaymentId < $payment->PaymentId){
                            echo '<tr>
                            <td colspan="2" style="border-left:none;line-height:1;"></td>
                            <th class="td-footer text-bold"  style="line-height:1;" colspan="'.((array_filter($detail, fn($item) => $item->InvDetailDisc > 0)) ? "3" : "2").'">('.date_format(date_create($row->PaymentDate),"d M Y").") ".$row->PaymentType.'</th>
                            <th class="td-center text-bold">
                                <div style="width:15%;text-align:left;display:inline-block;line-height:1;margin:0;padding:0;">Rp.</div> 
                                <div style="width:75%;text-align:right;display:inline-block;line-height:1;margin:0;padding:0;">'.number_format($row->PaymentTotal, 0, ',', '.').'</div>
                            </th>
                            </tr>';
                            $total_pay += $row->PaymentTotal;
                        }
                    }
                ?> 
                <tr>
                    <td colspan="2" style="border-left:none;line-height:1;"></td>
                    <th class="td-footer text-bold"  style="line-height:1;" colspan="<?= (array_filter($detail, fn($item) => $item->InvDetailDisc > 0)) ? "3" : "2" ?>"><?= "(".date_format(date_create($payment->PaymentDate),"d M Y").") ".$payment->PaymentType ?></th>
                    <th class="td-center text-bold">
                        <div style="width:15%;text-align:left;display:inline-block;line-height:1;margin:0;padding:0;">Rp.</div> 
                        <div style="width:75%;text-align:right;display:inline-block;line-height:1;margin:0;padding:0;"><?= number_format($payment->PaymentTotal, 0, ',', '.') ?></div>
                    </th>
                </tr>  
                <tr>
                    <td colspan="2" style="border-left:none;line-height:1;"></td>
                    <th class="td-footer text-bold"  style="line-height:1;" colspan="<?= (array_filter($detail, fn($item) => $item->InvDetailDisc > 0)) ? "3" : "2" ?>">Sisa</th>
                    <th class="td-center text-bold">
                        <div style="width:15%;text-align:left;display:inline-block;line-height:1;margin:0;padding:0;">Rp.</div> 
                        <div style="width:75%;text-align:right;display:inline-block;line-height:1;margin:0;padding:0;"><?= number_format($project->InvGrandTotal - $payment->PaymentTotal - $total_pay, 0, ',', '.') ?></div>
                    </th>
                </tr>  
            </tfoot>
        </table> 
    </div> 
    <div class="footer"> 
        <table style="width: 100%;align-items: start;justify-content: baseline;line-height: 1.2;padding-left:20px;padding-right:30px">
            <tr>
                <td style="vertical-align: top;">
                    Term and Condition :
                </td>
                <td rowspan="2" style="width:15%;text-align:center;vertical-align: bottom;">
                    <div style="border-top:1px solid black;margin-right:10px;">Admin</div>
                </td>
                <td rowspan="2" style="width:15%;text-align:center;vertical-align: bottom;">
                    <div style="border-top:1px solid black;margin-left:10px;">Pembeli</div>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">
                    <?= $project->TemplateFooterDetail ?>
                </td>
            </tr>
        </table>
    </div> 
</body>

</html>