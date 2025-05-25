<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title><?= 'INV '.$inv->InvCustName.' '.$inv->InvDate ?></title>
    <link rel="stylesheet" type="text/css" href="assets/fonts/roboto/roboto.css">
    <link rel="stylesheet" type="text/css" href="assets/fonts/poppins/poppins.css">   
    <link rel="icon" type="image/png" href="assets/images/logo/logo.png">
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
        padding:0 30px;
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
        width: 12%;
    }

    table.item td.text {
        width: 27%;
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
    .page_break { page-break-before: always; }
</style>
<body>  
    <?= $header_footer["html"] ?>
    <div class="body" >
        <h2 class="text-center" style="margin-top:0;padding-top:0">INVOICE</h2>
        <table style="width: 100%;border-collapse: collapse;margin-bottom:10px">
            <tbody>
                <tr>
                    <td style="width: 50%;border:1px solid;vertical-align:start;">  
                        <table style="border-collapse:collapse;border:none">
                            <tbody> 
                                <tr>
                                    <td style="border:none;vertical-align:start;padding:left:3px;">
                                        <div class="width-label label-color d-inline-block">Kepada Yth.:</div>
                                    </td> 
                                </tr> 
                                <tr>
                                    <td style="border:none;vertical-align:start;padding:left:3px;"><div class="label-color d-inline-block">
                                        <span class="text-bold"><?= $inv->InvCustName ?></span>
                                    </td> 
                                </tr> 
                                <tr> 
                                    <td style="border:none;vertical-align:start;padding:left:3px;"><div class="label-color d-inline-block">
                                        <span class="text-bold"><?= $inv->InvCustTelp ?></span>
                                    </td> 
                                </tr>  
                            </tbody>
                        </table>   
                    </td> 
                    <td style="vertical-align:start;border:1px solid"> 
                        <table style="border-collapse:collapse;heigth:100%;width:100%">
                            <tbody>
                                <tr style="border-bottom:1px solid;margin:12px;">
                                    <td style="border:none;padding-left:3px;vertical-align:start;width:30px;"><div class="width-label label-color d-inline-block">No. Doc.</div></td>
                                    <td style="border:none;padding:2px;width: 3px;vertical-align:start;"><div class="label-color d-inline-block">:</div></td>
                                    <td style="border:none;vertical-align:start;"><div class="label-color-1 d-inline-block text-bold"><?= $inv->InvCode ?></div></td>
                                </tr>
                                <tr style="border-bottom:1px solid;margin:12px;">
                                    <td style="border:none;padding-left:3px;vertical-align:start;"><div class="width-label label-color d-inline-block">Tgl. Pembuatan.</div></td>
                                    <td style="border:none;padding:2px;width: 3px;vertical-align:start;"><div class="label-color d-inline-block">:</div></td>
                                    <td style="border:none;width: auto;vertical-align:start;"><div class="label-color-1 d-inline-block text-bold"><?= date_format(date_create($inv->InvDate),"d F Y") ?></div></td>
                                </tr> 
                                <tr style="">
                                    <td style="border:none;padding-left:3px;vertical-align:start;"><div class="width-label label-color d-inline-block">Lokasi Project.</div></td>
                                    <td style="border:none;padding:2px;width: 3px;vertical-align:start;"><div class="label-color d-inline-block">:</div></td>
                                    <td style="border:none;width: auto;vertical-align:start;"><div class="label-color-1 d-inline-block text-bold"><?= $inv->InvAddress ?></div></td>
                                </tr>
                            </tbody>
                        </table> 
                    </td>
                </tr> 
            </tbody>
        </table> 
               
        <?php
            $col = 4;
            if((array_filter($detail, fn($item) => $item["disc"] > 0))) $col++;
            if($postdata["image"]==1) $col++;
        ?>
        <table class="item">
            <thead>
                <tr> 
                    <th>No.</th>
                    <?= ($postdata["image"] == 1) ? "<th>Gambar</th>" : "" ?>
                    <th>Uraian</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <?= (array_filter($detail, fn($item) => $item["disc"] > 0)) ? "<th>Disc</th>" : "" ?>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody> 
                <?php
                    $no = 1;
                    $huruf  = "A";
                    $html_items = "";
                    $discShow = array_filter($detail, fn($item) => $item["disc"] > 0);
                    foreach($detail as $item){

                        $arr_varian = json_decode($item["varian"]);
                        $arr_badge = ""; 
                        foreach($arr_varian as $varian){
                           if($varian->varian == "vendor") continue;

                            $arr_badge .= '<br><span style="font-size:10px;">'.ucfirst($varian->varian).' : '.$varian->value.'</span>'; 
                        }
                        if($item["type"] == "product"){
                            $html_items .= '
                            <tr> 
                                <td class="td-center">'.$no.'</td>
                                 '.($postdata["image"] == 1 ? ($item["image"] == "" ? "<td class='td-center image'></td>" : "<td class='td-center image'><img style='width:50px;height:50px;margin:3px;' src='".$item["image"]."'/></td>") : "").'
                                <td class="ps-2 text">'.$item["text"].$arr_badge.'</td>
                                <td class="td-center">'.number_format($item["qty"], 2, ',', '.').' '.$item["satuan_text"].'</td>
                                <td class="td-center">Rp. '.number_format($item["price"], 0, ',', '.').'</td>
                                '.($discShow ? "<td class='td-center'>Rp. ".number_format($item["disc"], 0, ',', '.')."</td>" : "").'
                                <td class="td-center">Rp. '.number_format($item["total"], 0, ',', '.').'</td>
                            </tr>';
                            $no++;
                        }else{
                            
                          
                            $html_items .= '    <tr>
                                                    <td class="td-group" colspan="'.   $col + 1 .'">'.$huruf.'. BARANG</td>
                                                </tr>';
                            $huruf++;
                            $no = 1;
                        }
                    }
                    echo $html_items;
                ?> 
                
                <tr><td colspan="<?= $col + 1 ?>" style="height:5px;background:#f3f3f3;"></td></tr>
            </tbody>
            <tfoot>
                <tr class="<?= ($postdata["total"]==1) ? "":"hide" ?>">
                    <td class="td-footer text-bold " colspan="<?= $col ?>">Sub Total</td>
                    <td class="td-center text-bold">Rp. <?= number_format($inv->InvSubTotal, 0, ',', '.') ?></td>
                </tr>
                <tr class="<?= ($postdata["total"]==1) ? "":"hide" ?>" style="<?= $inv->InvDiscItemTotal > 0 ? "" : "display:none;" ?>">
                    <td class="td-footer text-bold" colspan="<?= $col ?>">Disc Item</td>
                    <td class="td-center text-bold">Rp. <?= number_format($inv->InvDiscItemTotal, 0, ',', '.') ?></td>
                </tr> 
                <tr class="<?= ($postdata["total"]==1) ? "":"hide" ?>" style="<?= $inv->InvDiscTotal > 0 ? "" : "display:none;" ?>">
                    <td class="td-footer text-bold" colspan="<?= $col ?>">Disc</td>
                    <td class="td-center text-bold">Rp. <?= number_format($inv->InvDiscTotal, 0, ',', '.') ?></td>
                </tr>
                <tr class="<?= ($postdata["total"]==1) ? "":"hide" ?>">
                    <td class="td-footer text-bold" colspan="<?= $col ?>">Grand Total</td>
                    <td class="td-center text-bold">Rp. <?= number_format($inv->InvGrandTotal, 0, ',', '.') ?></td>
                </tr>
                <tr><td colspan="<?= $col + 1 ?>" style="height:5px;background:#f3f3f3;"></td></tr>
                <tr>
                    <td class="td-footer text-bold" colspan="<?= $col + 1 ?>"><?= $header_footer["detail"] ?></td> 
                </tr>
                <tr>
                    <td class="td-footer text-bold" colspan="<?= $col + 1 ?>"> 
                        <table style="border-collapse:collapse;border:none">
                            <tbody> 
                                <tr>
                                    <td style="border:none;vertical-align:start;padding:left:3px;">Term and Condition : </td>
                                </tr>
                                <tr>
                                    <td style="border:none;vertical-align:start;padding:left:3px;"> 
                                        <?= $inv->TemplateFooterDetail ?> 
                                    </td>
                                </tr>  
                            </tbody> 
                        </table> 
                    </td> 
                </tr>  
            </tfoot>
        </table> 
        
        <table style="width: 100%;border-collapse: collapse;margin-bottom:10px;margin-top:10px">
            <tbody>
                <tr>
                    <td style="width: 50%;width:60%">  </td>
                    <td style="width: 50%;border:1px solid;width:20%;text-align:center;height:120px;vertical-align:top;">Admin</td>
                    <td style="width: 50%;border:1px solid;width:20%;text-align:center;height:120px;vertical-align:top;">Pembeli</td>
                </tr> 
            </tbody>
        </table>

        <?php
            if($inv->InvImageList !== "[]"){
                echo '<div class="page_break"></div><h2 class="text-center" style="margin-bottom:20px;">Lampiran</h2><div style="display:block;padding-top:30px;">';
                $image = json_decode($inv->InvImageList);
                foreach($image as $row){
                    echo "<img src='".$row."' width='130px' style='padding:5px'>";
                } 
                echo '</div>';
                echo '<table style="width: 100%;border-collapse: collapse;margin-bottom:10px">
                        <tbody>
                            <tr> 
                                <td style="width:50%;text-align:center;vertical-align:top;"><img src="'.$inv->KtpImage.'" style="width:100%"></td>
                                <td style="width:50%;text-align:center;vertical-align:top;"><img src="'.$inv->NpwpImage.'" style="width:100%"></td>
                            </tr> 
                        </tbody>
                    </table>'; 

            }    
        ?>   
         
    </div> 

</body>

</html>