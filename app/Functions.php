<?php
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Labour;
use App\Models\ProductSize;
use App\Models\ProductCenterDiamondPacket;
use App\Models\ProductSideDiamondPacket;
use App\Models\MaterialMetal;

if (!function_exists('countryCurrency')) {
    function countryCurrency(){
        return (Session::has('currency')) ? Session::get('currency') : array('country_id' => '1', 'country' => 'India','symbol' => '&#8377;','currency_code' => 'INR','rate' => 1,'shipping_charge' => 0.00);
    }
}

if (!function_exists('DBDateTimeFormate')) {
    function DBDateTimeFormate($date){
        return Carbon::parse($date)->format('Y-m-d H:i:s');
    }
}

if (!function_exists('USDateFormate')){
    function USDateFormate($date){
        return Carbon::parse($date)->format('m/d/Y');
    }
}
if (!function_exists('DateFormateDMY')){
    function DateFormateDMY($date){
        return Carbon::parse($date)->format('M d, Y');
    }
}
if (!function_exists('TimeFormate')){
    function TimeFormate($time){
        return  Carbon::parse($time)->format('h:i A');
    }
}
if (!function_exists('diffInHours')){
    function diffInHours($start,$end){

        $diffTime = "";
        $endTime = Carbon::parse($end);
        $startTime = Carbon::parse($start);
        $minutes = $endTime->diffInMinutes($startTime);
        $diffTime = $minutes." Minutes";
        if($minutes > 59){
            $diffTime = round(($minutes / 60),2)." Hours";
        }
        return $diffTime;
    }
}
if (!function_exists('DateFormateDFY')){
    function DateFormateDFY($date){
        return Carbon::parse($date)->format('F d Y');
    }
}
if (!function_exists('generateRandomString')){
    function generateRandomString($length = 8) {
        $characters 		= '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength 	= strlen($characters);
        $randomString 		= '';
        for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
if (!function_exists('getProcessIDsForRunningScript')){
    function getProcessIDsForRunningScript($filename_string) {
        $tmparr = array();

        ob_start();
        system(" ps ax|grep '".trim($filename_string)."'| grep -v 'grep' | awk '{print$1}'");
        $cmdoutput = ob_get_contents();
        ob_end_clean();

        $cmdoutput = trim($cmdoutput);
        if (empty($cmdoutput)) {
            return $tmparr;
        }

        $cmdoutput = preg_replace("#\n#", ",", trim($cmdoutput));
        $tmparr = explode(",", $cmdoutput);

        return $tmparr;
    }
}
if (!function_exists('_GetMasterStatusOfPropertyType')){
    function _GetMasterStatusOfPropertyType($MSL_Class_ID = 0, $MLSStatus='', $ContractStatus = '') {

        $MLSStatus = trim($MLSStatus);
        if($MSL_Class_ID == 17 ) {
            if ($MLSStatus == "Active") {
                return 1;
            } else if($MLSStatus == "Active Contingent") {
                return 2;
            } else if($MLSStatus == "Coming Soon") {
                return 0;
            } else if($MLSStatus == "Expired") {
                return 5;
            } else if($MLSStatus == "Leased") {
                return 5;
            } else if($MLSStatus == "Pending") {
                return 4;
            } else if($MLSStatus == "Pending - Over 4 Months") {
                return 4;
            } else if($MLSStatus == "Pending - Taking Backups") {
                return 4;
            } else if($MLSStatus == "Sold") {
                return 5;
            } else if($MLSStatus == "Temporarily Off Market") {
                return 5;
            } else if($MLSStatus == "Withdrawn") {
                return 5;
            }
        } else if($MSL_Class_ID == 15) {
            if($MLSStatus == "ACTIVE" ) {
                return 1;
            } else if($MLSStatus == "BACK ON MARKET" ) {
                return 1;
            } else if($MLSStatus == "CANCELLED" ) {
                return 5;
            } else if($MLSStatus == "CONTINGENT" ) {
                return 2;
            } else if($MLSStatus == "DELETED" ) {
                return 5;
            } else if($MLSStatus == "EXPIRED" ) {
                return 5;
            } else if($MLSStatus == "HOLD" ) {
                return 5;
            } else if($MLSStatus == "PENDING" ) {
                return 4;
            } else if($MLSStatus == "RENTED" ) {
                return 5;
            } else if($MLSStatus == "SOLD" ) {
                return 5;
            } else if($MLSStatus == "WITHDRAWN" ) {
                return 5;
            }
        } else if($MSL_Class_ID == 12) {
            if($MLSStatus == "Active" ) {
                return 1;
            }else if($MLSStatus == "Active Contingent" ) {
                return 2;
            }else if($MLSStatus == "Active Kick Out" ) {
                return 1;
            }else if($MLSStatus == "Active Option Contract" ) {
                return 3;
            }else if($MLSStatus == "Cancelled" ) {
                return 5;
            }else if($MLSStatus == "Coming Soon" ) {
                return 0;
            }else if($MLSStatus == "Incoming" ) {
                return 1;
            }else if($MLSStatus == "Leased" ) {
                return 5;
            }else if($MLSStatus == "Pending" ) {
                return 4;
            }else if($MLSStatus == "Sold" ) {
                return 5;
            }else if($MLSStatus == "Temp Off Market" ) {
                return 5;
            }else if($MLSStatus == "Withdrawn" ) {
                return 5;
            }else if($MLSStatus == "Withdrawn Sublisting") {
                return 5;
            }else if($MLSStatus == "Expired") {
                return 5;
            }
        } else if($MSL_Class_ID == 13) {
            if($MLSStatus == 'Active') {
                return 1;
            } else if($MLSStatus == 'Pending') {
                $ArrContractStatus = array("Appraisal", "Financing", "Inspections", "Kick Out Clause", "Letter Of Intent", "Other Contract Contingencies", "Pending 3rd Party Appro", "REO Waiting For Signatures", "Right of 1st Refusal");
                if(in_array($ContractStatus, $ArrContractStatus)) {
                    return 2;
                }
                return 4;
            } else if($MLSStatus == "Appraisal" ) {
                return 2;
            } else if($MLSStatus == "Financing" ) {
                return 2;
            } else if($MLSStatus == "Inspections" ) {
                return 3;
            } else if($MLSStatus == "Kick Out Clause" ) {
                return 2;
            } else if($MLSStatus == "Letter Of Intent" ) {
                return 2;
            } else if($MLSStatus == "No Contingency" ) {
                return 4;
            } else if($MLSStatus == "Other Contract Contingencies" ) {
                return 2;
            } else if($MLSStatus == "Pending 3rd Party Appro" ) {
                return 2;
            } else if($MLSStatus == "REO Waiting For Signatures" ) {
                return 2;
            } else if($MLSStatus == "Right of 1st Refusal" ) {
                return 2;
            }
        } else if(in_array($MSL_Class_ID, array(1,2,3,4,5,6,7,8,10,11))) {
            if($MLSStatus == "Canceled"){
                return 5;
            }else if($MLSStatus == "Expired"){
                return 5;
            }else if($MLSStatus == "Contingent"){
                return 2;
            }else if($MLSStatus == "Exclusion Ended"){
                return 5;
            }else if($MLSStatus == "Active"){
                return 1;
            }else if($MLSStatus == "Pending (Do Not Show)"){
                return 4;
            }else if($MLSStatus == "Excluded"){
                return 5;
            }else if($MLSStatus == "Deleted"){
                return 5;
            }else if($MLSStatus == "Coming Soon"){
                return 0;
            }else if($MLSStatus == "Sold"){
                return 5;
            }else if($MLSStatus == "Withdrawn/Temporary Off Market"){
                return 5;
            }
        }
    }
}
if (!function_exists('_RemoveOtherStringFromCityName')){
    function _RemoveOtherStringFromCityName($city_name='') {
        $CityName = $city_name;
        if(!empty($city_name)) {
            $searchForValue = ",";
            if( strpos($city_name, $searchForValue) !== false ) {
                $ArrCity = explode(",", $city_name);
                if(isset($ArrCity[0])) {
                    $CityName = $ArrCity[0];
                    $CityName = preg_replace('/[0-9]/','',$CityName);
                }
            } else {
                $CityName = preg_replace('/[0-9]/','',$city_name);
            }
        }
        return trim($CityName);
    }
}

if (!function_exists('_GetStreetAbbreviationsArray')){
    function _GetStreetAbbreviationsArray() {
        return [
            '/\bALLEY\b/' => 'ALY',
            '/\bALLEY\b/' => 'ALY',
            '/\bANNEX\b/' => 'ANX',
            '/\bARCADE\b/' => 'ARC',
            '/\bAVENUE\b/' => 'AVE',
            '/\bBAYOO\b/' => 'BYU',
            '/\bBEACH\b/' => 'BCH',
            '/\bBEND\b/' => 'BND',
            '/\bBLUFF\b/' => 'BLF',
            '/\bBLUFFS\b/' => 'BLFS',
            '/\bBOTTOM\b/' => 'BTM',
            '/\bBOULEVARD\b/' => 'BLVD',
            '/\bBRANCH\b/' => 'BR',
            '/\bBRIDGE\b/' => 'BRG',
            '/\bBROOK\b/' => 'BRK',
            '/\bBROOKS\b/' => 'BRKS',
            '/\bBURG\b/' => 'BG',
            '/\bBURGS\b/' => 'BGS',
            '/\bBYPASS\b/' => 'BYP',
            '/\bCAMP\b/' => 'CP',
            '/\bCANYON\b/' => 'CYN',
            '/\bCAPE\b/' => 'CPE',
            '/\bCAUSEWAY\b/' => 'CSWY',
            '/\bCENTER\b/' => 'CTR',
            '/\bCENTERS\b/' => 'CTRS',
            '/\bCIRCLE\b/' => 'CIR',
            '/\bCIRCLES\b/' => 'CIRS',
            '/\bCLIFF\b/' => 'CLF',
            '/\bCLIFFS\b/' => 'CLFS',
            '/\bCLUB\b/' => 'CLB',
            '/\bCOMMON\b/' => 'CMN',
            '/\bCORNER\b/' => 'COR',
            '/\bCORNERS\b/' => 'CORS',
            '/\bCOURSE\b/' => 'CRSE',
            '/\bCOURT\b/' => 'CT',
            '/\bCOURTS\b/' => 'CTS',
            '/\bCOVE\b/' => 'CV',
            '/\bCOVES\b/' => 'CVS',
            '/\bCREEK\b/' => 'CRK',
            '/\bCRESCENT\b/' => 'CRES',
            '/\bCREST\b/' => 'CRST',
            '/\bCROSSING\b/' => 'XING',
            '/\bCROSSROAD\b/' => 'XRD',
            '/\bCURVE\b/' => 'CURV',
            '/\bDALE\b/' => 'DL',
            '/\bDAM\b/' => 'DM',
            '/\bDIVIDE\b/' => 'DV',
            '/\bDRIVE\b/' => 'DR',
            '/\bDRIVES\b/' => 'DRS',
            '/\bESTATE\b/' => 'EST',
            '/\bESTATES\b/' => 'ESTS',
            '/\bEXPRESSWAY\b/' => 'EXPY',
            '/\bEXTENSION\b/' => 'EXT',
            '/\bEXTENSIONS\b/' => 'EXTS',
            '/\bFALL\b/' => 'FALL',
            '/\bFALLS\b/' => 'FLS',
            '/\bFERRY\b/' => 'FRY',
            '/\bFIELD\b/' => 'FLD',
            '/\bFIELDS\b/' => 'FLDS',
            '/\bFLAT\b/' => 'FLT',
            '/\bFLATS\b/' => 'FLTS',
            '/\bFORD\b/' => 'FRD',
            '/\bFORDS\b/' => 'FRDS',
            '/\bFOREST\b/' => 'FRST',
            '/\bFORGE\b/' => 'FRG',
            '/\bFORGES\b/' => 'FRGS',
            '/\bFORK\b/' => 'FRK',
            '/\bFORKS\b/' => 'FRKS',
            '/\bFORT\b/' => 'FT',
            '/\bFREEWAY\b/' => 'FWY',
            '/\bGARDEN\b/' => 'GDN',
            '/\bGARDENS\b/' => 'GDNS',
            '/\bGATEWAY\b/' => 'GTWY',
            '/\bGLEN\b/' => 'GLN',
            '/\bGLENS\b/' => 'GLNS',
            '/\bGREEN\b/' => 'GRN',
            '/\bGREENS\b/' => 'GRNS',
            '/\bGROVE\b/' => 'GRV',
            '/\bGROVES\b/' => 'GRVS',
            '/\bHARBOR\b/' => 'HBR',
            '/\bHARBORS\b/' => 'HBRS',
            '/\bHAVEN\b/' => 'HVN',
            '/\bHEIGHTS\b/' => 'HTS',
            '/\bHIGHWAY\b/' => 'HWY',
            '/\bHILL\b/' => 'HL',
            '/\bHILLS\b/' => 'HLS',
            '/\bHOLLOW\b/' => 'HOLW',
            '/\bINLET\b/' => 'INLT',
            '/\bINTERSTATE\b/' => 'I',
            '/\bISLAND\b/' => 'IS',
            '/\bISLANDS\b/' => 'ISS',
            '/\bISLE\b/' => 'ISLE',
            '/\bJUNCTION\b/' => 'JCT',
            '/\bJUNCTIONS\b/' => 'JCTS',
            '/\bKEY\b/' => 'KY',
            '/\bKEYS\b/' => 'KYS',
            '/\bKNOLL\b/' => 'KNL',
            '/\bKNOLLS\b/' => 'KNLS',
            '/\bLAKE\b/' => 'LK',
            '/\bLAKES\b/' => 'LKS',
            '/\bLAND\b/' => 'LAND',
            '/\bLANDING\b/' => 'LNDG',
            '/\bLANE\b/' => 'LN',
            '/\bLIGHT\b/' => 'LGT',
            '/\bLIGHTS\b/' => 'LGTS',
            '/\bLOAF\b/' => 'LF',
            '/\bLOCK\b/' => 'LCK',
            '/\bLOCKS\b/' => 'LCKS',
            '/\bLODGE\b/' => 'LDG',
            '/\bLOOP\b/' => 'LOOP',
            '/\bMALL\b/' => 'MALL',
            '/\bMANOR\b/' => 'MNR',
            '/\bMANORS\b/' => 'MNRS',
            '/\bMEADOW\b/' => 'MDW',
            '/\bMEADOWS\b/' => 'MDWS',
            '/\bMEWS\b/' => 'MEWS',
            '/\bMILL\b/' => 'ML',
            '/\bMILLS\b/' => 'MLS',
            '/\bMISSION\b/' => 'MSN',
            '/\bMOORHEAD\b/' => 'MHD',
            '/\bMOTORWAY\b/' => 'MTWY',
            '/\bMOUNT\b/' => 'MT',
            '/\bMOUNTAIN\b/' => 'MTN',
            '/\bMOUNTAINS\b/' => 'MTNS',
            '/\bNECK\b/' => 'NCK',
            '/\bORCHARD\b/' => 'ORCH',
            '/\bOVAL\b/' => 'OVAL',
            '/\bOVERPASS\b/' => 'OPAS',
            '/\bPARK\b/' => 'PARK',
            '/\bPARKS\b/' => 'PARK',
            '/\bPARKWAY\b/' => 'PKWY',
            '/\bPARKWAYS\b/' => 'PKWY',
            '/\bPASS\b/' => 'PASS',
            '/\bPASSAGE\b/' => 'PSGE',
            '/\bPATH\b/' => 'PATH',
            '/\bPIKE\b/' => 'PIKE',
            '/\bPINE\b/' => 'PNE',
            '/\bPINES\b/' => 'PNES',
            '/\bPLACE\b/' => 'PL',
            '/\bPLAIN\b/' => 'PLN',
            '/\bPLAINS\b/' => 'PLNS',
            '/\bPLAZA\b/' => 'PLZ',
            '/\bPOINT\b/' => 'PT',
            '/\bPOINTS\b/' => 'PTS',
            '/\bPORT\b/' => 'PRT',
            '/\bPORTS\b/' => 'PRTS',
            '/\bPRAIRIE\b/' => 'PR',
            '/\bRADIAL\b/' => 'RADL',
            '/\bRAMP\b/' => 'RAMP',
            '/\bRANCH\b/' => 'RNCH',
            '/\bRAPID\b/' => 'RPD',
            '/\bRAPIDS\b/' => 'RPDS',
            '/\bREST\b/' => 'RST',
            '/\bRIDGE\b/' => 'RDG',
            '/\bRIDGES\b/' => 'RDGS',
            '/\bRIVER\b/' => 'RIV',
            '/\bROAD\b/' => 'RD',
            '/\bROADS\b/' => 'RDS',
            '/\bROUTE\b/' => 'RTE',
            '/\bROW\b/' => 'ROW',
            '/\bRUE\b/' => 'RUE',
            '/\bRUN\b/' => 'RUN',
            '/\bSHOAL\b/' => 'SHL',
            '/\bSHOALS\b/' => 'SHLS',
            '/\bSHORE\b/' => 'SHR',
            '/\bSHORES\b/' => 'SHRS',
            '/\bSKYWAY\b/' => 'SKWY',
            '/\bSPRING\b/' => 'SPG',
            '/\bSPRINGS\b/' => 'SPGS',
            '/\bSPUR\b/' => 'SPUR',
            '/\bSPURS\b/' => 'SPUR',
            '/\bSQUARE\b/' => 'SQ',
            '/\bSQUARES\b/' => 'SQS',
            '/\bSTATION\b/' => 'STA',
            '/\bSTREAM\b/' => 'STRM',
            '/\bSTREET\b/' => 'ST',
            '/\bSTREETS\b/' => 'STS',
            '/\bSUMMIT\b/' => 'SMT',
            '/\bTERRACE\b/' => 'TER',
            '/\bTHROUGHWAY\b/' => 'TRWY',
            '/\bTRACE\b/' => 'TRCE',
            '/\bTRACK\b/' => 'TRAK',
            '/\bTRAIL\b/' => 'TRL',
            '/\bTUNNEL\b/' => 'TUNL',
            '/\bTURNPIKE\b/' => 'TPKE',
            '/\bUNDERPASS\b/' => 'UPAS',
            '/\bUNION\b/' => 'UN',
            '/\bUNIONS\b/' => 'UNS',
            '/\bVALLEY\b/' => 'VLY',
            '/\bVALLEYS\b/' => 'VLYS',
            '/\bVIADUCT\b/' => 'VIA',
            '/\bVIEW\b/' => 'VW',
            '/\bVIEWS\b/' => 'VWS',
            '/\bVILLAGE\b/' => 'VLG',
            '/\bVILLAGES\b/' => 'VLGS',
            '/\bVILLE\b/' => 'VL',
            '/\bVISTA\b/' => 'VIS',
            '/\bWALK\b/' => 'WALK',
            '/\bWALKS\b/' => 'WALK',
            '/\bWALL\b/' => 'WALL',
            '/\bWAY\b/' => 'WAY',
            '/\bWAYS\b/' => 'WAYS',
            '/\bWELL\b/' => 'WL',
            '/\bWELLS\b/' => 'WLS',
        ];
    }
}
if (!function_exists('custom_echo')){
    function custom_echo($x, $length)
    {
    if(strlen($x)<=$length)
    {
        echo $x;
    }
    else
    {
        $y=substr($x,0,$length) . '...';
        echo $y;
    }
    }
}
if (!function_exists('time_elapsed_string')){
    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}
if (!function_exists('checkedCurrentTimeBetweenTwoTimes')){
    function checkedCurrentTimeBetweenTwoTimes($current_time, $start , $end) {

        $date1 = DateTime::createFromFormat('h:i a', $current_time);
        $date2 = DateTime::createFromFormat('h:i a', $start);
        $date3 = DateTime::createFromFormat('h:i a', $end);
        if ($date1 >= $date2 && $date1 < $date3)
        {
            return true;
        }
        return false;
    }
}

if (!function_exists('productImages')){
    function productImages($product_id, $metal_id , $shape_id) {

        $images = \App\Models\ProductImage::where([['product_id', $product_id],['metal_id', $metal_id],['shape_id', $shape_id]])->orderBy("sort_order","ASC")->get()->toArray();
        $image_paths = array();
        $video_paths = array();
        $is_360video = array();
        $product_first_image = '';
        $product_list_first_image = '';
        $product_first_image_paths = array();
        if(count($images) > 0){
            $count = 1;
            foreach ($images as  $productimg) {
                if($productimg['shape_id'] == $shape_id && $productimg['metal_id'] == $metal_id){
                    if($count == 1)
                    $product_first_image = $productimg['image_path'];
                    $image_paths[] = $productimg['image_path'];
                    $video_paths[] = $productimg['video_path'];
                    $is_360video[] = $productimg['video_type'];

                    if($product_list_first_image == '' && $productimg['type'] == 0){
                        $product_list_first_image = $productimg['image_path'];
                    }
                    if($productimg['type'] == 0){
                        $product_first_image_paths[] = $productimg['image_path'];
                    }
                    $count++;
                }
            }
            /*if not match shape and metal */
            $count = 1;
            if(count($image_paths) == 0){
                foreach ($images as  $productimg) {
                    if($count == 1)
                    $product_first_image = $productimg['image_path'];
                    $image_paths[] = $productimg['image_path'];
                    $video_paths[] = $productimg['video_path'];
                    $is_360video[] = $productimg['video_type'];
                    if($product_list_first_image == '' && $productimg['type'] == 0){
                        $product_list_first_image = $productimg['image_path'];
                    }
                    if($productimg['type'] == 0){
                        $product_first_image_paths[] = $productimg['image_path'];
                    }
                    $count++;
                }
            }
        }
        return array('product_first_image' => $product_first_image,'image_paths' => $image_paths,'product_list_first_image' => $product_list_first_image,'product_first_image_paths' => $product_first_image_paths,'video_paths' => $video_paths,'is_360video' => $is_360video);
    }
}
if (!function_exists('proirityProductImages')){
    function proirityProductImages($product_id,$metal_id, $shape_id) {
        $images = \App\Models\ProductImage::where('product_id', $product_id)->where('metal_display_priority_id', 1)->orderBy("sort_order","ASC")->get()->toArray();
        $image_paths = array();
        $video_paths = array();
        $is_360video = array();
        $product_first_image = '';
        $product_list_first_image = '';
        $product_first_image_paths = array();


        if(count($images) > 0){
            $count = 1;
            foreach ($images as  $productimg) {
                //if($productimg['shape_id'] == $shape_id && $productimg['metal_id'] == $metal_id){
                if($count == 1)
                $product_first_image = $productimg['image_path'];
                $image_paths[] = $productimg['image_path'];
                $video_paths[] = $productimg['video_path'];
                $is_360video[] = $productimg['video_type'];

                if($product_list_first_image == '' && $productimg['type'] == 0){
                    $product_list_first_image = $productimg['image_path'];
                }
                if($productimg['type'] == 0){
                    $product_first_image_paths[] = $productimg['image_path'];
                }
                $count++;
                //}
            }
            /*if not match shape and metal */
            $count = 1;
            if(count($image_paths) == 0){
                foreach ($images as  $productimg) {
                    if($count == 1)
                    $product_first_image = $productimg['image_path'];
                    $image_paths[] = $productimg['image_path'];
                    $video_paths[] = $productimg['video_path'];
                    $is_360video[] = $productimg['video_type'];
                    if($product_list_first_image == '' && $productimg['type'] == 0){
                        $product_list_first_image = $productimg['image_path'];
                    }
                    if($productimg['type'] == 0){
                        $product_first_image_paths[] = $productimg['image_path'];
                    }
                    $count++;
                }
            }
        }else{
            $images = \App\Models\ProductImage::where([['product_id', $product_id],['metal_id', $metal_id],['shape_id', $shape_id]])->orderBy("sort_order","ASC")->get()->toArray();
            $count = 1;
            foreach ($images as  $productimg) {
                if($productimg['shape_id'] == $shape_id && $productimg['metal_id'] == $metal_id){
                    if($count == 1)
                    $product_first_image = $productimg['image_path'];
                    $image_paths[] = $productimg['image_path'];
                    $video_paths[] = $productimg['video_path'];
                    $is_360video[] = $productimg['video_type'];

                    if($product_list_first_image == '' && $productimg['type'] == 0){
                        $product_list_first_image = $productimg['image_path'];
                    }
                    if($productimg['type'] == 0){
                        $product_first_image_paths[] = $productimg['image_path'];
                    }
                    $count++;
                }
            }
            /*if not match shape and metal */
            $count = 1;
            if(count($image_paths) == 0){
                foreach ($images as  $productimg) {
                    if($count == 1)
                    $product_first_image = $productimg['image_path'];
                    $image_paths[] = $productimg['image_path'];
                    $video_paths[] = $productimg['video_path'];
                    $is_360video[] = $productimg['video_type'];
                    if($product_list_first_image == '' && $productimg['type'] == 0){
                        $product_list_first_image = $productimg['image_path'];
                    }
                    if($productimg['type'] == 0){
                        $product_first_image_paths[] = $productimg['image_path'];
                    }
                    $count++;
                }
            }
        }
       
        return array('product_first_image' => $product_first_image,'image_paths' => $image_paths,'product_list_first_image' => $product_list_first_image,'product_first_image_paths' => $product_first_image_paths,'video_paths' => $video_paths,'is_360video' => $is_360video);
    }
}
if (!function_exists('getSingleProductImage')){
    function getSingleProductImage($product_id, $metal_id , $shape_id) {

        $images = \App\Models\ProductImage::where([['product_id', $product_id],['metal_id', $metal_id],['shape_id', $shape_id]])->value('image_path');
        return $images;
    }
}
if (!function_exists('getSingleProductShapePrice')){
    function getSingleProductShapePrice($product_id, $shape_id) {

        $shape = \App\Models\ProductShape::select('price','shapes.name as shape')
        ->leftJoin('shapes', 'product_shapes.shape_id', '=', 'shapes.id')
        ->where([['product_id', $product_id],['shape_id', $shape_id]])->first();
        return $shape;
    }
}
if (!function_exists('getSingleProductMetalMaterial')){
    function getSingleProductMetalMaterial($product_id, $metal_id, $material_id) {

        $metalMaterial = \App\Models\ProductMetalMaterial::select('price','metals.name as metal','materials.name as material')
        ->leftJoin('metals', 'product_metal_materials.metal_id', '=', 'metals.id')
        ->leftJoin('materials', 'product_metal_materials.material_id', '=', 'materials.id')
        ->where([['product_id', $product_id],['metal_id', $metal_id],['material_id', $material_id]])->first();
        return $metalMaterial;
    }
}

if (!function_exists('productPriceCalculation')){
    function productPriceCalculation($productData) {

        $product_id = $productData['product_id'];
        $center_diamond_color = $productData['center_diamond_color'];
        $center_diamond_clarity = $productData['center_diamond_clarity'];
        $side_diamond_color = $productData['side_diamond_color'];
        $side_diamond_clarity = $productData['side_diamond_clarity'];
        $ringSize = $productData['ringSize'];
        $shape_id = ($productData['shape_id']) ? $productData['shape_id']: 0;;
        $metal_id = ($productData['metal_id']) ? $productData['metal_id'] : 0;;
        $material_id = ($productData['material_id']) ? $productData['material_id'] : 0;

        $product = Product::where('id',$product_id)->first();
        $countryMultiplyby = json_decode($product->multiplyby,true) ; ///array_merge(array('1' => "1"), );
        $countryMultiplyby[1] = "1";

        //$product_id = $product->id;
        $net_weight = $product->net_weight;
        $grosswt = $product->grosswt;
        $other_expenses = $product->other_expenses;

        $labour_price = 0;
        if($product->labour_type){
            $labour_price = Labour::where('id',$product->labour_type)->value('price');
            $labour_price = $labour_price * $net_weight;
        }

        $price_percentage = ProductSize::where([['product_id',$product_id],['size_id',$ringSize]])->value('price_percentage');

        $center_diamond_price = ProductCenterDiamondPacket::where([['product_id',$product_id],['shape_id',$shape_id],['color_id',$center_diamond_color],['clarity_id',$center_diamond_clarity]])->value('price');

        $side_diamond_price_data = ProductSideDiamondPacket::where([['product_id',$product_id],['color_id',$side_diamond_color],['clarity_id',$side_diamond_clarity]])->with('packet')->get()->toArray();
        $side_diamond_price = 0;
        if(count($side_diamond_price_data) > 0){
            foreach($side_diamond_price_data as $side_diamond){
                $side_diamond_price +=  $side_diamond['packet']['price'] * $side_diamond['weight'];
            }
        }
        //dd($side_diamond_price);
        $diamond_price = $center_diamond_price + $side_diamond_price;

        $materialmetal_price = 0;
        if($net_weight > 0){
            $material_id = ($material_id > 0) ? $material_id : null;
            $materialmetal_price = MaterialMetal::where([['metal_id',$metal_id],['material_id',$material_id]])->value('price');
            $materialmetal_price = $materialmetal_price * $net_weight;
        }

        $total_price =  $materialmetal_price + $labour_price + $diamond_price + $other_expenses;

        if($price_percentage != ''){
            $total_price = $total_price + (($price_percentage / 100) * $total_price);
        }
        //dd($total_price);
        return ['total_price' => $total_price,'countryMultiplyby' => $countryMultiplyby];

    }
}
