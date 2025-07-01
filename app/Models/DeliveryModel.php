<?php

namespace App\Models; 

use CodeIgniter\Model; 
use App\Models\ProdukModel;
class DeliveryModel extends Model
{ 
    protected $DBGroup = 'default';
    protected $table = 'activity';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['menu','type','name','desc','created_at','created_user'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];



    function get_data_delivery_detail($id){
        $builder = $this->db->table("delivery_detail");
        $builder->where('DeliveryDetailRef',$id); 
        return $builder->get()->getResult();  
    } 
    function get_data_detail_delivery($id){ 
        $modelsproduk = new ProdukModel();
        $detail = array(); 
        $detailhtml = ' <table class="table detail-item m-0 w-auto">
                            <thead>
                                <tr>
                                    <th class="detail text-center" style="width:50px">Gambar</th>
                                    <th class="detail">Nama</th>
                                    <th class="detail">Qty</th>
                                    <th class="detail">Spare</th> 
                                </tr>
                            </thead>
                            <tbody>';
        $arr_detail = $this->get_data_delivery_detail($id);
        foreach($arr_detail as $row_data){
            $arr_varian = json_decode($row_data->DeliveryDetailVarian);
            $arr_badge = "";
            $arr_no = 0;
            foreach($arr_varian as $varian){
                $arr_badge .= '<span class="badge badge-sm badge-'.fmod($arr_no,5).' rounded">'.$varian->varian.' : '.$varian->value.'</span>';
                $arr_no++;
            }
            $detail[] = array(
                        "id" => $row_data->ProdukId,  
                        "produkid" => $row_data->ProdukId, 
                        "satuan_id"=> ($row_data->DeliveryDetailSatuanId == 0 ? "" : $row_data->DeliveryDetailSatuanId),
                        "satuan_text"=>$row_data->DeliveryDetailSatuanText,   
                        "varian"=> JSON_DECODE($row_data->DeliveryDetailVarian,true), 
                        "qty"=> $row_data->DeliveryDetailQty,
                        "qty"=> $row_data->DeliveryDetailQtySpare,
                        "text"=> $row_data->DeliveryDetailText,
                        "group"=> $row_data->DeliveryDetailGroup,
                        "type"=> $row_data->DeliveryDetailType,
                        "image_url"=> $modelsproduk->getproductimagedatavarian($row_data->ProdukId,$row_data->DeliveryDetailVarian,true)
                    );

            $detailhtml .= ' <tr>
                    <td class="detail">
                        <img src="'.$modelsproduk->getproductimagedatavarian($row_data->ProdukId,$row_data->DeliveryDetailVarian,true).'" alt="Gambar" class="image-produk">
                    </td>
                    <td class="detail">
                        <span class="text-head-3">'.$row_data->DeliveryDetailText.'</span><br>
                        <span class="text-detail-2 text-truncate">'.$row_data->DeliveryDetailGroup.'</span> 
                        <div class="d-flex gap-1 flex-wrap">'.$arr_badge.'</div>
                    </td>
                    <td class="detail">'.number_format($row_data->DeliveryDetailQty, 2, ',', '.').' '.$row_data->DeliveryDetailSatuanText.'</td> 
                    <td class="detail">'.number_format($row_data->DeliveryDetailQtySpare, 2, ',', '.').$row_data->DeliveryDetailSatuanText.'</td>
                </tr> ';
        };
        $detailhtml .= '
        </tbody> 
        </table>';

        return $detailhtml; 
    } 
 
}