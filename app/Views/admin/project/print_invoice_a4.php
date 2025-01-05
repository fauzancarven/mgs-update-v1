<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title><?= 'INV_'.$project->name.'_'.$project->date ?></title>
    <link rel="stylesheet" type="text/css" href="assets/fonts/roboto/roboto.css">
    <link rel="stylesheet" type="text/css" href="assets/fonts/poppins/poppins.css"> 
</head>
<style>  
    body {
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
    }
    .header{ 
        position: relative;
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
        margin-top: 60px;
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
    .divider{ 
        border:1px solid #88c3f4;
        height:20px;
        margin:10px
    }
</style>
<body>  
    <div class="header">
        <div class="logo">  
            <img src="assets/images/logo/brand/brj.png" alt=""> 
        </div>
        <div class="deskripsi">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <div class="icon">
                                <img src="assets/images/icon/maps.svg" alt="">
                            </div>
                            
                        </td>
                        <td>
                            <span>Jl. Bakti Jaya Luk No.1, Bakti Jaya,<br>Kec. Setu, Kota Tangerang Selatan, Banten 15315</span>
                        </td>
                        <td>
                            <div class="icon">
                                <img src="assets/images/icon/email.svg" alt="">
                            </div>
                            
                        </td>
                        <td>
                            <span>bataregulerjakarta@gmail.com</span>
                        </td>
                        <td>
                            <div class="icon">
                                <img src="assets/images/icon/phone.svg" alt=""> 
                            </div>
                            
                        </td>
                        <td>0852-1795-2625<br>0812-1260-9992
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>   
        <div class="slogan"><span class="text-slogan">GENERAL SUPPLIER & CONTRACTOR</span></div>  
    </div>   
    <div class="footer"> 
        <table>
            <tr>
                <td>BATA EXPOSE</td>
                <td><div class="divider"></div></td>
                <td>BATA TEMPEL</td> 
                <td><div class="divider"></div></td> 
                <td>ROSTER DINDING</td>  
                <td><div class="divider"></div></td>
                <td>PAVING BLOCK</td>   
            </tr>
        </table>
        <div class="line"> 
            <div class="line1"></div> 
        </div>
        <div class="line-1"> 
            <div class="line1"></div> 
        </div>
        <div class="line-2"> 
            <div class="line1"></div> 
        </div>
    </div>
    <div class="body">
        <h2 class="text-center">INVOICE (SALES ORDER)</h2>
        <table style="width: 100%;align-items: start;justify-content: baseline;">
            <tbody>
                <tr>
                    <td style="width: 40%;"> 
                        <span >Kepada Yth.:</span><br>
                        <span class="text-bold"><?= $project->name.($project->company == "" ? : " (".$project->company.")") ?></span><br> 
                        <span class="text-bold"><?= $project->telp1.($project->telp2 == "" ? : "/".$project->telp2) ?></span><br>
                        <span class="text-bold"><?= $project->address ?></span><br>
                    </td>
                    <td style="width: 30%;"> 
                    </td>
                    <td style="align-items: start;justify-content: center;margin-left:auto"> 
                        <div class="width-label label-color d-inline-block">No. Doc.</div><div class="label-color d-inline-block">&nbsp;:&nbsp;</div><div class="label-color-1 d-inline-block text-bold"><?= $project->code ?></div><br>
                        <div class="width-label label-color d-inline-block">Tgl.</div><div class="label-color d-inline-block">&nbsp;:&nbsp;</div><div class="label-color-1 d-inline-block text-bold"><?= date_format(date_create($project->date),"d F Y") ?></div><br> 
                    </td>
                </tr>
            </tbody>
        </table>
        <div style="padding:20px">
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
                    <?= (array_filter($detail, fn($item) => $item->disc > 0)) ? "<th>Disc</th>" : "" ?>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody> 
                <?php
                    $no = 1;
                    $huruf  = "A";
                    $html_items = "";
                    $discShow = array_filter($detail, fn($item) => $item->disc > 0);
                    foreach($detail as $item){

                        $arr_varian = json_decode($item->varian);
                        $arr_badge = ""; 
                        foreach($arr_varian as $varian){
                           if($varian->varian == "vendor") continue;

                            $arr_badge .= '<br><span style="font-size:10px;">'.ucfirst($varian->varian).' : '.$varian->value.'</span>'; 
                        }
                        if($item->type == "product"){
                            $html_items .= '
                            <tr> 
                                <td class="td-center">'.$no.'</td>
                                <td class="ps-2">'.$item->text.$arr_badge.'</td>
                                <td class="td-center">'.number_format($item->qty, 2, ',', '.').' '.$item->satuantext.'</td>
                                <td class="td-center">Rp. '.number_format($item->harga, 0, ',', '.').'</td>
                                '.($discShow ? "<td class='td-center'>Rp. ".number_format($item->disc, 0, ',', '.')."</td>" : "").'
                                <td class="td-center">Rp. '.number_format($item->total, 0, ',', '.').'</td>
                            </tr>';
                            $no++;
                        }else{
                            
                          
                            $html_items .= '    <tr>
                                                    <td class="td-group" colspan="'. ($discShow ? 6 : 5).'">'.$huruf.'. BARANG</td>
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
                    <td class="td-footer text-bold" colspan="<?= (array_filter($detail, fn($item) => $item->disc > 0)) ? "5" : "4" ?>">Sub Total</td>
                    <td class="td-center text-bold">Rp. <?= number_format($project->subtotal, 0, ',', '.') ?></td>
                </tr>
                <tr style="<?= $project->discitemtotal > 0 ? "" : "display:none;" ?>">
                    <td class="td-footer text-bold" colspan="<?= (array_filter($detail, fn($item) => $item->disc > 0)) ? "5" : "4" ?>">Disc Item</td>
                    <td class="td-center text-bold">Rp. <?= number_format($project->discitemtotal, 0, ',', '.') ?></td>
                </tr> 
                <tr style="<?= $project->disctotal > 0 ? "" : "display:none;" ?>">
                    <td class="td-footer text-bold" colspan="<?= (array_filter($detail, fn($item) => $item->disc > 0)) ? "5" : "4" ?>">Disc</td>
                    <td class="td-center text-bold">Rp. <?= number_format($project->disctotal, 0, ',', '.') ?></td>
                </tr>
                <tr>
                    <td class="td-footer text-bold" colspan="<?= (array_filter($detail, fn($item) => $item->disc > 0)) ? "5" : "4" ?>">Grand Total</td>
                    <td class="td-center text-bold">Rp. <?= number_format($project->grandtotal, 0, ',', '.') ?></td>
                </tr>
                <tr>
                    <td class="td-footer text-bold" colspan="<?= (array_filter($detail, fn($item) => $item->disc > 0)) ? "6" : "5" ?>">DISIAPKAN OLEH : ADMIN<br>
                        DIRECT CONTACT : 0852-1795-2625<br>
                        BATA REGULER JAKARTA</td> 
                </tr>
            </tfoot>
        </table>
        <div style="padding-left:20px">
            Term and Condition :   
            <?= $project->detail ?> 
        </div>
    </div> 
</body>

</html>