<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThcitiesSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('th_cities')->insert([
            ['id'=>'1','code'=>'10','name_th'=>'กรุงเทพมหานคร','created_at'=>null,'updated_at'=>null],
            ['id'=>'2','code'=>'11','name_th'=>'สมุทรปราการ','created_at'=>null,'updated_at'=>null],
            ['id'=>'3','code'=>'12','name_th'=>'นนทบุรี','created_at'=>null,'updated_at'=>null],
            ['id'=>'4','code'=>'13','name_th'=>'ปทุมธานี','created_at'=>null,'updated_at'=>null],
            ['id'=>'5','code'=>'14','name_th'=>'พระนครศรีอยุธยา','created_at'=>null,'updated_at'=>null],
            ['id'=>'6','code'=>'15','name_th'=>'อ่างทอง','created_at'=>null,'updated_at'=>null],
            ['id'=>'7','code'=>'16','name_th'=>'ลพบุรี','created_at'=>null,'updated_at'=>null],
            ['id'=>'8','code'=>'17','name_th'=>'สิงห์บุรี','created_at'=>null,'updated_at'=>null],
            ['id'=>'9','code'=>'18','name_th'=>'ชัยนาท','created_at'=>null,'updated_at'=>null],
            ['id'=>'10','code'=>'19','name_th'=>'สระบุรี','created_at'=>null,'updated_at'=>null],
            ['id'=>'11','code'=>'20','name_th'=>'ชลบุรี','created_at'=>null,'updated_at'=>null],
            ['id'=>'12','code'=>'21','name_th'=>'ระยอง','created_at'=>null,'updated_at'=>null],
            ['id'=>'13','code'=>'22','name_th'=>'จันทบุรี','created_at'=>null,'updated_at'=>null],
            ['id'=>'14','code'=>'23','name_th'=>'ตราด','created_at'=>null,'updated_at'=>null],
            ['id'=>'15','code'=>'24','name_th'=>'ฉะเชิงเทรา','created_at'=>null,'updated_at'=>null],
            ['id'=>'16','code'=>'25','name_th'=>'ปราจีนบุรี','created_at'=>null,'updated_at'=>null],
            ['id'=>'17','code'=>'26','name_th'=>'นครนายก','created_at'=>null,'updated_at'=>null],
            ['id'=>'18','code'=>'27','name_th'=>'สระแก้ว','created_at'=>null,'updated_at'=>null],
            ['id'=>'19','code'=>'30','name_th'=>'นครราชสีมา','created_at'=>null,'updated_at'=>null],
            ['id'=>'20','code'=>'31','name_th'=>'บุรีรัมย์','created_at'=>null,'updated_at'=>null],
            ['id'=>'21','code'=>'32','name_th'=>'สุรินทร์','created_at'=>null,'updated_at'=>null],
            ['id'=>'22','code'=>'33','name_th'=>'ศรีสะเกษ','created_at'=>null,'updated_at'=>null],
            ['id'=>'23','code'=>'34','name_th'=>'อุบลราชธานี','created_at'=>null,'updated_at'=>null],
            ['id'=>'24','code'=>'35','name_th'=>'ยโสธร','created_at'=>null,'updated_at'=>null],
            ['id'=>'25','code'=>'36','name_th'=>'ชัยภูมิ','created_at'=>null,'updated_at'=>null],
            ['id'=>'26','code'=>'37','name_th'=>'อำนาจเจริญ','created_at'=>null,'updated_at'=>null],
            ['id'=>'27','code'=>'39','name_th'=>'หนองบัวลำภู','created_at'=>null,'updated_at'=>null],
            ['id'=>'28','code'=>'40','name_th'=>'ขอนแก่น','created_at'=>null,'updated_at'=>null],
            ['id'=>'29','code'=>'41','name_th'=>'อุดรธานี','created_at'=>null,'updated_at'=>null],
            ['id'=>'30','code'=>'42','name_th'=>'เลย','created_at'=>null,'updated_at'=>null],
            ['id'=>'31','code'=>'43','name_th'=>'หนองคาย','created_at'=>null,'updated_at'=>null],
            ['id'=>'32','code'=>'44','name_th'=>'มหาสารคาม','created_at'=>null,'updated_at'=>null],
            ['id'=>'33','code'=>'45','name_th'=>'ร้อยเอ็ด','created_at'=>null,'updated_at'=>null],
            ['id'=>'34','code'=>'46','name_th'=>'กาฬสินธุ์','created_at'=>null,'updated_at'=>null],
            ['id'=>'35','code'=>'47','name_th'=>'สกลนคร','created_at'=>null,'updated_at'=>null],
            ['id'=>'36','code'=>'48','name_th'=>'นครพนม','created_at'=>null,'updated_at'=>null],
            ['id'=>'37','code'=>'49','name_th'=>'มุกดาหาร','created_at'=>null,'updated_at'=>null],
            ['id'=>'38','code'=>'50','name_th'=>'เชียงใหม่','created_at'=>null,'updated_at'=>null],
            ['id'=>'39','code'=>'51','name_th'=>'ลำพูน','created_at'=>null,'updated_at'=>null],
            ['id'=>'40','code'=>'52','name_th'=>'ลำปาง','created_at'=>null,'updated_at'=>null],
            ['id'=>'41','code'=>'53','name_th'=>'อุตรดิตถ์','created_at'=>null,'updated_at'=>null],
            ['id'=>'42','code'=>'54','name_th'=>'แพร่','created_at'=>null,'updated_at'=>null],
            ['id'=>'43','code'=>'55','name_th'=>'น่าน','created_at'=>null,'updated_at'=>null],
            ['id'=>'44','code'=>'56','name_th'=>'พะเยา','created_at'=>null,'updated_at'=>null],
            ['id'=>'45','code'=>'57','name_th'=>'เชียงราย','created_at'=>null,'updated_at'=>null],
            ['id'=>'46','code'=>'58','name_th'=>'แม่ฮ่องสอน','created_at'=>null,'updated_at'=>null],
            ['id'=>'47','code'=>'60','name_th'=>'นครสวรรค์','created_at'=>null,'updated_at'=>null],
            ['id'=>'48','code'=>'61','name_th'=>'อุทัยธานี','created_at'=>null,'updated_at'=>null],
            ['id'=>'49','code'=>'62','name_th'=>'กำแพงเพชร','created_at'=>null,'updated_at'=>null],
            ['id'=>'50','code'=>'63','name_th'=>'ตาก','created_at'=>null,'updated_at'=>null],
            ['id'=>'51','code'=>'64','name_th'=>'สุโขทัย','created_at'=>null,'updated_at'=>null],
            ['id'=>'52','code'=>'65','name_th'=>'พิษณุโลก','created_at'=>null,'updated_at'=>null],
            ['id'=>'53','code'=>'66','name_th'=>'พิจิตร','created_at'=>null,'updated_at'=>null],
            ['id'=>'54','code'=>'67','name_th'=>'เพชรบูรณ์','created_at'=>null,'updated_at'=>null],
            ['id'=>'55','code'=>'70','name_th'=>'ราชบุรี','created_at'=>null,'updated_at'=>null],
            ['id'=>'56','code'=>'71','name_th'=>'กาญจนบุรี','created_at'=>null,'updated_at'=>null],
            ['id'=>'57','code'=>'72','name_th'=>'สุพรรณบุรี','created_at'=>null,'updated_at'=>null],
            ['id'=>'58','code'=>'73','name_th'=>'นครปฐม','created_at'=>null,'updated_at'=>null],
            ['id'=>'59','code'=>'74','name_th'=>'สมุทรสาคร','created_at'=>null,'updated_at'=>null],
            ['id'=>'60','code'=>'75','name_th'=>'สมุทรสงคราม','created_at'=>null,'updated_at'=>null],
            ['id'=>'61','code'=>'76','name_th'=>'เพชรบุรี','created_at'=>null,'updated_at'=>null],
            ['id'=>'62','code'=>'77','name_th'=>'ประจวบคีรีขันธ์','created_at'=>null,'updated_at'=>null],
            ['id'=>'63','code'=>'80','name_th'=>'นครศรีธรรมราช','created_at'=>null,'updated_at'=>null],
            ['id'=>'64','code'=>'81','name_th'=>'กระบี่','created_at'=>null,'updated_at'=>null],
            ['id'=>'65','code'=>'82','name_th'=>'พังงา','created_at'=>null,'updated_at'=>null],
            ['id'=>'66','code'=>'83','name_th'=>'ภูเก็ต','created_at'=>null,'updated_at'=>null],
            ['id'=>'67','code'=>'84','name_th'=>'สุราษฎร์ธานี','created_at'=>null,'updated_at'=>null],
            ['id'=>'68','code'=>'85','name_th'=>'ระนอง','created_at'=>null,'updated_at'=>null],
            ['id'=>'69','code'=>'86','name_th'=>'ชุมพร','created_at'=>null,'updated_at'=>null],
            ['id'=>'70','code'=>'90','name_th'=>'สงขลา','created_at'=>null,'updated_at'=>null],
            ['id'=>'71','code'=>'91','name_th'=>'สตูล','created_at'=>null,'updated_at'=>null],
            ['id'=>'72','code'=>'92','name_th'=>'ตรัง','created_at'=>null,'updated_at'=>null],
            ['id'=>'73','code'=>'93','name_th'=>'พัทลุง','created_at'=>null,'updated_at'=>null],
            ['id'=>'74','code'=>'94','name_th'=>'ปัตตานี','created_at'=>null,'updated_at'=>null],
            ['id'=>'75','code'=>'95','name_th'=>'ยะลา','created_at'=>null,'updated_at'=>null],
            ['id'=>'76','code'=>'96','name_th'=>'นราธิวาส','created_at'=>null,'updated_at'=>null],
            ['id'=>'77','code'=>'97','name_th'=>'บึงกาฬ','created_at'=>null,'updated_at'=>null]
        ]);
    }
}
