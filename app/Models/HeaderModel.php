<?php

namespace App\Models; 

use CodeIgniter\Model;  

class HeaderModel extends Model
{
    function get_header_a4($id){
        switch ($id) { 
            case 2:
                $html = '<div class="fixed">
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
                        </div>'
                ;
                $detail = 'DISIAPKAN OLEH : ADMIN<br>DIRECT CONTACT : 0852-1795-2625<br>BATA REGULER JAKARTA';
                break;
            case 3:
                $html = '<div class="fixed">
                            <div class="header">
                            <div class="logo">  
                                <img src="assets/images/logo/brand/rrj.png" alt=""> 
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
                                                <span>rosterregulerjakarta@gmail.com</span>
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
                        </div>'
                ;
                $detail = 'DISIAPKAN OLEH : ADMIN<br>DIRECT CONTACT : 0852-1795-2625<br>ROSTER REGULER JAKARTA';
                break;
            case 4:
                $html = '<div class="fixed">
                            <div class="header">
                            <div class="logo">  
                                <img src="assets/images/logo/brand/prj.png" alt=""> 
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
                                                <span>pavingregulerjakarta@gmail.com</span>
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
                        </div>'
                ;
                $detail = 'DISIAPKAN OLEH : ADMIN<br>DIRECT CONTACT : 0852-1795-2625<br>PAVING REGULER JAKARTA';
                break;
            default: 
                $html = '<div class="fixed">
                        <div class="header"> 
                            <div class="logo">  
                                <img class="mgs" src="assets/images/logo/brand/mgs.png" alt=""> 
                            </div>
                            <div class="deskripsi">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span>Jasa Renovasi Rumah</span><br>
                                                <span>Custom Furniture</span><br>
                                                <span>Jasa Design Interior & Arsitektur</span>
                                                
                                            </td>
                                            <td>
                                                <div class="divider"></div>
                                            </td>
                                            <td>
                                                <span>Jasa Pasang Bata Tempel & Bata Expose</span><br>
                                                <span>Jasa Pasang Roster Dinding</span><br>
                                                <span>Jasa Pasang Paving & Grass Block</span>
                                            </td>
                                            <td>
                                                <div class="divider"></div>
                                            </td>
                                            <td>
                                                <span>Jasa Pasang CCTV</span><br>
                                                <span>Jasa Pasang & Maintenance AC</span><br>
                                                <span>Jasa Instalasi Listrik (ME)</span> 
                                            </td> 
                                        </tr>
                                    </tbody>
                                </table>
                            </div>   
                            <div class="slogan"><span class="text-slogan">GENERAL CONTRACTOR & SUPPLIER</span></div>   
                        </div>    
                    </div>  
                    <div class="footer mgs"> 
                        <table>
                            <tr>
                                <td>
                                    <div class="icon">
                                        <img src="assets/images/icon/maps.svg" alt="">
                                    </div>
                                    
                                </td>
                                <td style="padding-left:20px;padding-right:20px;">
                                    <span >Jl. Bakti Jaya Luk No.1, Bakti Jaya,<br>Kec. Setu, Kota Tangerang Selatan, Banten 15315</span>
                                </td>
                                <td>
                                    <div class="icon">
                                        <img src="assets/images/icon/email.svg" alt="">
                                    </div>
                                    
                                </td>
                                <td style="padding-left:20px;padding-right:20px;">
                                    <span>info.mahieraglobalsolution@gmail.com</span>
                                </td>
                                <td>
                                    <div class="icon">
                                        <img src="assets/images/icon/phone.svg" alt=""> 
                                    </div>
                                    
                                </td>
                                <td style="padding-left:20px;padding-right:20px;">0812-1260-9992
                                </td>
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
                    </div>'
                ;
                
                $detail = 'DISIAPKAN OLEH : ADMIN<br>DIRECT CONTACT : 0812-1260-9992<br>MAHIERA GLOBAL SOLUTION';
                break;
        }
        return array(
            "html"=> $html,
            "detail"=> $detail,
        );
    }
    function get_header_a5($id){
        switch ($id) { 
            case 2:
                $html = ' <div class="header">
                <div class="logo">  
                    <img src="assets/images/logo/logo-brj-blue.png" alt=""> 
                    <span>BATA REGULER JAKARTA</span>
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
            </div>  ';
                break;
            default: 
                
            $html = ' <div class="header">
            <div class="logo mgs">  
                <img src="assets/images/logo/logo-blue-1.png" alt="">  
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
                                <span>info.mahieraglobalsolution@gmail.com</span>
                            </td>
                            <td>
                                <div class="icon">
                                    <img src="assets/images/icon/phone.svg" alt=""> 
                                </div>
                                
                            </td>
                            <td>0812-1260-9992<br>0812-1262-9997
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>   
            <div class="slogan"><span class="text-slogan">GENERAL SUPPLIER & CONTRACTOR</span></div>  
        </div>  ';
                break;
        }
        return $html;
    }
}