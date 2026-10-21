<?php

namespace App\Models; 

use CodeIgniter\Model; 
use CodeIgniter\Database\RawSql; 
use App\Models\ActivityModel;

class AccountingModel extends Model
{  
    function get_data_request_payment($filter = null){
        $modelsproduk = new ProdukModel();
        $filterdata = 0;
        $countTotal = 0;
        $count = 0;
        $draw = $filter['draw'];  
        $start = $filter['start'];
        $length = $filter['length']; 
        $datatable = array();

        $subquery = "(SELECT 
        a.*,
        CASE 
            WHEN PaymentRefType = '-' THEN '0' 
            WHEN PaymentRefType = 'Survey' THEN (select StoreId from survey where SurveyId = PaymentRef) 
            WHEN PaymentRefType = 'Sample' THEN (select StoreId from sample where SampleId = PaymentRef) 
            WHEN PaymentRefType = 'Pembelian' THEN (select StoreId from pembelian where POId = PaymentRef) 
            WHEN PaymentRefType = 'Pengiriman' THEN (select StoreId from delivery where DeliveryId = PaymentRef) 
            WHEN PaymentRefType = 'Invoice' THEN (select StoreId from invoice where InvId = PaymentRef) 
        END AS StoreIdCalc,
        CASE 
            WHEN PaymentRefType = '-' THEN 'No data Selected' 
            WHEN PaymentRefType = 'Survey' THEN (select SurveyCode from survey where SurveyId = PaymentRef) 
            WHEN PaymentRefType = 'Sample' THEN (select SampleCode from sample where SampleId = PaymentRef) 
            WHEN PaymentRefType = 'Pembelian' THEN (select POCode from pembelian where POId = PaymentRef) 
            WHEN PaymentRefType = 'Pengiriman' THEN (select DeliveryCode from delivery where DeliveryId = PaymentRef) 
            WHEN PaymentRefType = 'Invoice' THEN (select InvCode from invoice where InvId = PaymentRef) 
        END AS PaymentRefCode,
        CASE 
            WHEN PaymentRefType = '-' THEN 'No data Selected' 
            WHEN PaymentRefType = 'Survey' THEN (select SurveyDate from survey where SurveyId = PaymentRef) 
            WHEN PaymentRefType = 'Sample' THEN (select SampleDate from sample where SampleId = PaymentRef) 
            WHEN PaymentRefType = 'Pembelian' THEN (select PODate from pembelian where POId = PaymentRef) 
            WHEN PaymentRefType = 'Pengiriman' THEN (select DeliveryDate from delivery where DeliveryId = PaymentRef) 
            WHEN PaymentRefType = 'Invoice' THEN (select InvDate from invoice where InvId = PaymentRef) 
        END AS PaymentRefDate
        FROM payment a) AS subquery";

        $builder = $this->db->table($subquery);
        $builder->select("*, PaymentRefCode, PaymentRefDate");
        $builder->join("users","users.id = subquery.created_user ","left");
        $builder->join("store","store.StoreId = subquery.StoreIdCalc","left"); 
        $builder->where("PaymentStatus",0); 
        //mengambil total semua data
        $builder1 = clone $builder; 
        $countTotal = $builder1->get()->getNumRows();
        
        if($filter["search"]){ 
            $builder->groupStart(); 
            $builder->like("username",$filter["search"]); 
            $builder->orLike("PaymentDate",$filter["search"]);
            $builder->orLike("StoreCode",$filter["search"]); 
            $builder->groupEnd();  
            $filterdata = 1;
        }
        $datafilter = clone $builder;  
        $count = $datafilter->get()->getNumRows();

        $builder->limit($length,$start); 
        $query = $builder->get();  
        foreach($query->getResult() as $row){
             // MENGAMBIL DATA Toko 
            $store = '
            <div class="d-flex align-items-center ">  
                <div class="flex-grow-1 ms-1">
                    <div class="d-flex flex-column"> 
                        <span class="text-head-3 d-flex gap-0 align-items-center"><img src="'.$row->StoreLogo.'" alt="Gambar" class="logo">'.$row->StoreCode.'</span>
                        <span class="text-detail-3 text-wrap overflow-none pt-1 ps-1">'.$row->StoreName.'</span>  
                        <span class="text-detail-2 text-wrap overflow-none ps-1 text-default '.($row->ProjectId == 0 ? "d-none" : "").'"><i class="fa-solid fa-diagram-project pe-1 "></i>Document Project</span>  
                    </div>   
                </div>
            </div>';
            if($row->PaymentRefType=="Invoice"){
                $tipe = '<i class="fa-solid fa-right-to-bracket text-success fa-2x"></i>';
                $status = '<span class="badge text-bg-info me-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" data-bs-title="Menunggu Approval">Menunggu Approval</span>';

                $desc = "-";
                $folder_utama = 'assets/images/payment/'.$row->PaymentRefType.'/'.$row->PaymentRef.'/sumber'; 
                //Buat folder berdasarkan id
                if (!file_exists($folder_utama)) {
                    mkdir($folder_utama, 0777, true);  
                }  
                $files = scandir($folder_utama);
                foreach ($files as $file) {
                    if ($file != '.' && $file != '..') {
                        $filepath = $folder_utama.'/' . $file;
                        $filesize = filesize($folder_utama. '/' . $file); 
                        $filetype = mime_content_type($folder_utama. '/' . $file);
                        $desc = '  
                                                <a onclick="view_file(this)" data-file="'.$filepath.'" data-type="'.$filetype.'" data-name="'.$file.'">
                                                    <i class="fa-solid fa-eye"></i> Lihat bukti
                                                </a>  ';
                    }
                }   
                $action = '<button class="btn btn-sm btn-success rounded">Approved</button>';
            }else{
                $tipe = '<i class="fa-solid fa-right-from-bracket text-danger fa-2x"></i>';
                $status = '<span class="badge text-bg-info me-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" data-bs-title="Menunggu Pembayaran">Menunggu Pembayaran</span>';
                
                $desc = "-";
                if($row->PaymentType == "Cash"){
                    $desc = ' 
                    <td class="detail">  
                        <div class="text-detail-3"><i class="fa-solid fa-user" style="width:20px"></i>'.$row->PaymentToName.'</div>
                    </td>';
                }else{ 
                    $desc = ' 
                    <td class="detail">  
                        <div class="text-detail-3 pb-1"><i class="fa-solid fa-building-columns" style="width:20px"></i>'.$row->PaymentToBank.'</div>
                        <div class="text-detail-3 pb-1"><i class="fa-solid fa-credit-card" style="width:20px"></i>'.$row->PaymentToRek.'</div>
                        <div class="text-detail-3"><i class="fa-solid fa-user" style="width:20px"></i>'.$row->PaymentToName.'</div>
                    </td>';
                }
                $action = '<button class="btn btn-sm btn-primary rounded">Payment</button>';

            }
            $data_row = array( 
                "tipe" => $tipe,
                "store" => $store,
                "referensi" => $row->PaymentRefType.'<div class="text-detail-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Tidak ada referensi"> 
                    <a class="text-detail-3 pointer text-decoration-underline text-secondary">'.$row->PaymentRefCode.'</a>
                </div>
                <div class="text-detail-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Tidak ada referensi"> 
                    <a class="text-detail-3 text-decoration-none text-secondary">'.$row->PaymentRefDate.'</a>
                </div>',  
                "document" => $row->PaymentCode.'
                <div class="text-detail-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Tidak ada referensi"> 
                    <a class="text-detail-3 text-decoration-none text-secondary">'.$row->PaymentType.'</a>
                </div>
                <div class="text-detail-3 pt-2" data-bs-toggle="tooltip" data-bs-title="Tidak ada referensi"> 
                    <a class="text-detail-3 text-decoration-none text-secondary">'.$row->PaymentDate.'</a>
                </div>',
                "status" =>$status, 
                "admin" => ucwords($row->username),  
                "desc" => $desc,
                "total" => "<div class='d-flex'><span>Rp.</span><span class='flex-fill text-end'>".number_format($row->PaymentTotal,0)."</span></div>",
                "action" => $action,
            );
             array_push($datatable, $data_row);
        }

        return json_encode(
            array(
                "draw"=>$draw,
                "recordsTotal"=>$countTotal,
                "recordsFiltered"=>($filterdata == 0 ? $countTotal : $count ),
                "data"=>$datatable, 
            )
        );

    }

    function load_datatable_coa($filter = null){
        helper('akuntansi');
        $draw   = (int) ($filter['draw'] ?? 0);
        $start  = max(0, (int) ($filter['start'] ?? 0));
        $length = (int) ($filter['length'] ?? -1);
        $search = trim((string) ($filter['search'] ?? ''));

        $builder = $this->db->table("acc_coa");
        $countTotal = (clone $builder)->countAllResults();

        if ($search !== '') {
            $builder->groupStart();
            $builder->like("kode_akun", $search);
            $builder->orLike("nama_akun", $search);
            $builder->orLike("kategori", $search);
            $builder->orLike("saldo_normal", $search);
            $builder->orLike("keterangan", $search);
            $builder->groupEnd();
        }
        $count = (clone $builder)->countAllResults();

        // Daftar akun selalu urut berdasarkan kode agar hierarki terbaca
        $builder->orderBy("kode_akun", "ASC");
        if ($length > 0) $builder->limit($length, $start);
        $rows = $builder->get()->getResult();

        // Peta induk untuk menentukan tingkat indentasi
        $parent = [];
        foreach ($this->db->table("acc_coa")->select("kode_akun, parent_kode")->get()->getResultArray() as $r) {
            $parent[(string) $r['kode_akun']] = $r['parent_kode'];
        }

        $datatable = array();
        foreach ($rows as $row) {
            $level = 0;
            for ($p = $parent[(string) $row->kode_akun] ?? null; $p && $level < 10; $level++) {
                $p = $parent[(string) $p] ?? null;
            }
            $isHeader = (int) ($row->is_header ?? 0) === 1;
            $aktif    = !isset($row->aktif) || (int) $row->aktif === 1;
            $kode     = esc((string) $row->kode_akun);

            $nama = '<div class="' . ($isHeader ? 'fw-bold' : '') . '" style="padding-left:' . ($level * 18) . 'px">'
                . esc((string) $row->nama_akun)
                . ($aktif ? '' : ' <span class="badge text-bg-secondary ms-1">Nonaktif</span>')
                . '</div>';
            $saldo = $row->saldo_normal === 'Debit'
                ? '<span class="badge text-bg-info">Debit</span>'
                : '<span class="badge text-bg-warning">Kredit</span>';
            if ($isHeader) {
                $saldo .= ' <span class="badge text-bg-dark">Header</span>';
            }

            $data_row = array(
                "kode_akun" => '<span class="' . ($isHeader ? 'fw-bold' : '') . '">' . $kode . '</span>',
                "nama_akun" => $nama,
                "kategori" => esc((string) $row->kategori),
                "saldo_normal" => $saldo,
                "keterangan" => esc((string) $row->keterangan),
                "action" => '
                <div class="d-flex align-items-center gap-1 justify-content-center">
                <a onclick="coa_edit(this)" data-kode="' . $kode . '" style="cursor:pointer"
                    class="w-24-px h-24-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center"  data-bs-toggle="tooltip"  data-bs-title="Ubah Data">
                    <iconify-icon icon="lucide:edit"></iconify-icon>
                </a>
                <a onclick="coa_delete(this)" data-kode="' . $kode . '" data-nama="' . esc((string) $row->nama_akun) . '" style="cursor:pointer"
                    class="w-24-px h-24-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"  data-bs-toggle="tooltip"  data-bs-title="Hapus Data">
                    <iconify-icon icon="lucide:trash-2"></iconify-icon>
                </a>
                </div>',
            );
            array_push($datatable, $data_row);
        }

        return json_encode(
            array(
                "draw"=>$draw,
                "recordsTotal"=>$countTotal,
                "recordsFiltered"=>$count,
                "data"=>$datatable,
            )
        );
    }

    function load_datatable_jurnal($filter = null){
        $filterdata = 0;
        $countTotal = 0;
        $count = 0;
        $draw = $filter['draw'];  
        $start = $filter['start'];
        $length = $filter['length']; 
        $datatable = array();

        $builder = $this->db->table("payment");   
        $builder->join("invoice","invoice.InvId = payment.PaymentRef and payment.PaymentRefType = 'Invoice'","left");
        $builder->join("pembelian","pembelian.POId = payment.PaymentRef and payment.PaymentRefType = 'Pembelian'","left");  
        $builder->join("delivery","delivery.DeliveryId = payment.PaymentRef and payment.PaymentRefType = 'Delivery'","left");  
        $builder->where("payment.PaymentDate > '2026-07-01'");
        //mengambil total semua data
        $builder1 = clone $builder; 
        $countTotal = $builder1->get()->getNumRows(); 

        if($filter["search"]){ 
            $builder->groupStart(); 
            $builder->like("PaymentCode",$filter["search"]);
            $builder->orLike("PaymentToBank",$filter["search"]);
            $builder->orLike("PaymentToRek",$filter["search"]);
            $builder->orLike("PaymentToName",$filter["search"]);
            $builder->orLike("PaymentTotal",$filter["search"]); 
            $builder->orLike("PaymentRef",$filter["search"]); 
            $builder->groupEnd();  
            $filterdata = 1;
        }

        $datafilter = clone $builder;  
        $count = $datafilter->get()->getNumRows();
        if($length > 0) $builder->limit($length,$start);  
        $builder->select("*");
        $builder->orderby("PaymentRefType", "ASC"); 
        $builder->orderby("PaymentDate", "ASC"); 
        $query = $builder->get();  
        foreach($query->getResult() as $row){ 
            if($row->PaymentRefType == "Invoice"){
                 $customer = '
                 <div class="d-flex align-items-center"><iconify-icon icon="hugeicons:invoice-03" class="menu-icon"></iconify-icon><span class="ms-2">invoice '.$row->PaymentType.'</span></div>
             <div class="text-head-3 pb-2 text-truncate" style="max-width: 350px;line-height: 1.2;" data-bs-toggle="tooltip"  data-bs-title="'.$row->InvCustName.'">'.$row->InvCustName.'</div>
                        '.($row->InvCustTelp ? '<div class="text-detail-3 text-xs">'.$row->InvCustTelp.'</div>' : '').'
                        <div class="text-detail-3 text-truncate text-xxs" style="max-width: 350px;line-height: 1.2;" data-bs-toggle="tooltip"  data-bs-title="'.$row->InvAddress.'">'.$row->InvAddress.'</div>';
               
            }else if($row->PaymentRefType == "Pembelian"){ 
                 $customer = '
                 <div class="d-flex align-items-center"><iconify-icon icon="hugeicons:warehouse" class="menu-icon"></iconify-icon><span class="ms-2">pembelian '.$row->PaymentType.'</span></div>
             <div class="text-head-3 pb-2 text-truncate" style="max-width: 350px;line-height: 1.2;" data-bs-toggle="tooltip"  data-bs-title="'.$row->POCustName.'">'.$row->POCustName.'</div>
                        '.($row->POCustTelp ? '<div class="text-detail-3 text-xs">'.$row->POCustTelp.'</div>' : '').'
                        <div class="text-detail-3 text-truncate text-xxs" style="max-width: 350px;line-height: 1.2;" data-bs-toggle="tooltip"  data-bs-title="'.$row->POAddress.'">'.$row->POAddress.'</div>';
            }else if($row->PaymentRefType == "Delivery"){
                $customer = '
                <div class="d-flex align-items-center"><iconify-icon icon="hugeicons:delivery" class="menu-icon"></iconify-icon><span class="ms-2">delivery '.$row->PaymentType.'</span></div>
                <div class="text-head-3 pb-2 text-truncate" style="max-width: 350px;line-height: 1.2;" data-bs-toggle="tooltip"  data-bs-title="'.$row->DeliveryCustName.'">'.$row->DeliveryCustName.'</div>
                        '.($row->DeliveryCustTelp ? '<div class="text-detail-3 text-xs">'.$row->DeliveryCustTelp.'</div>' : '').'
                        <div class="text-detail-3 text-truncate text-xxs" style="max-width: 350px;line-height: 1.2;" data-bs-toggle="tooltip"  data-bs-title="'.$row->DeliveryAddress.'">'.$row->DeliveryAddress.'</div>';
            }

           
            $data_row = array( 
                "PaymentId" => $row->PaymentId, 
                "PaymentCode" => $row->PaymentCode,
                "PaymentDate" => '<div class="text-head-3" style="line-height:1">'.date_format(date_create($row->PaymentDate),"d M Y").'</div>',
                "PaymentType" => $row->PaymentType,
                "PaymentToBank" => $row->PaymentToBank,
                "PaymentToRek" => $row->PaymentToRek,
                "PaymentToName" => $row->PaymentToName,
                //"PaymentTotal" => "<div class='d-flex'><span>Rp.</span><span class='flex-fill text-end'>".number_format($row->PaymentTotal,0)."</span></div>",
                "PaymentTotal" => $row->PaymentTotal,
                "PaymentRefType" => $row->PaymentRefType,
                "PaymentRef" => $row->PaymentRef,
                "InvCustName" => $customer,
                "action" =>'  
                <div class="d-flex align-items-center gap-1 justify-content-center"> 
                <a onclick="edit_data('.$row->PaymentId.',this,\''.$row->PaymentId.'\')"
                    class="w-24-px h-24-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center"  data-bs-toggle="tooltip"  data-bs-title="Ubah Data">
                    <iconify-icon icon="lucide:edit"></iconify-icon>
                </a>
                <a onclick="delete_data('.$row->PaymentId.',this,\''.$row->PaymentId.'\')"
                    class="w-24-px h-24-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"  data-bs-toggle="tooltip"  data-bs-title="Hapus Data">
                    <iconify-icon icon="lucide:trash-2">
                    </iconify-icon>
                </a> ',
            );
            array_push($datatable, $data_row);
        }
         return json_encode(
            array(
                "draw"=>$draw,
                "recordsTotal"=>$countTotal,
                "recordsFiltered"=>($filterdata == 0 ? $countTotal : $count ),
                "data"=>$datatable, 
            )
        );
    }
}