<?php
namespace Model;
class Vbp extends \Model {
	public static function get_data($filename) {
		//change $filename parameter to the provider_number
		$query = \DB::select('*')->from('test_TPS')->where('provider_number', '=', '060034')->execute();
		
		$result_array = array();
		$result_array = $query->as_array();
		
		$temp = $result_array[0]['provider_number'];
		
		$csv = array();
		$file = fopen($filename, "r");
		
		//have these fgetcsvs to [$result_array[0]['provider_num'], $result_array[0]['...'],...]
		//use same format for arr data
		
		$csv['psi90'] = [$result_array[0]['provider_num'], $result_array[0]['...'],...]
		$csv['ha1'] = fgetcsv($file, 1000, ",");
		$csv['ha2'] = fgetcsv($file, 1000, ",");
		$csv['ha3'] = fgetcsv($file, 1000, ",");
		$csv['ha4'] = fgetcsv($file, 1000, ",");
		$csv['ha5'] = fgetcsv($file, 1000, ",");
		$csv['ha6'] = fgetcsv($file, 1000, ",");
		$csv['pc01'] = fgetcsv($file, 1000, ",");
		$csv['safety_tps'] = fgetcsv($file, 1000, ",");
		$csv['mortAMI'] = fgetcsv($file, 1000, ",");
		$csv['mortHF'] = fgetcsv($file, 1000, ",");
		$csv['mortPN'] = fgetcsv($file, 1000, ",");
		$csv['cc_tps'] = fgetcsv($file, 1000, ",");
		$csv['MSPB'] = fgetcsv($file, 1000, ",");
		$csv['efficiency_tps'] = fgetcsv($file, 1000, ",");
		$csv['nurses'] = fgetcsv($file, 1000, ",");
		$csv['doctors'] = fgetcsv($file, 1000, ",");
		$csv['staff'] = fgetcsv($file, 1000, ",");
		$csv['care'] = fgetcsv($file, 1000, ",");
		$csv['medicine'] = fgetcsv($file, 1000, ",");
		$csv['cleanliness'] = fgetcsv($file, 1000, ",");
		$csv['discharge'] = fgetcsv($file, 1000, ",");
		$csv['overall'] = fgetcsv($file, 1000, ",");
		$csv['hcahps_tps'] = fgetcsv($file, 1000, ",");
		$csv['tps'] = fgetcsv($file, 1000, ",");
		$csv['reimbursement'] = fgetcsv($file, 1000, ",");
		$csv['comments'] = fgetcsv($file, 1000, ",");
		$csv['test'] = $result_array;
		return $csv;
	}
	/*
	public static function put_data($filename, $arr) {
		$myfile = fopen($filename, "w");
		foreach ($arr as $row){
			fputcsv($myfile, $row);
		}
		fclose($myfile);
	}
	*/
	
	public static function calculate($achievement, $benchmark, $baseline, $performance){
        $achievement_points = round(9 * (($performance - $achievement)/($benchmark - $achievement)) + 0.5);
        
        if ($achievement_points >= 10){
            $achievement_points = 10;
        }
        
        if ($achievement_points <= 0){
            $achievement_points = 0;
        }
        
        $improvement_points = round(10 * (($performance - $baseline)/($benchmark - $baseline)) - 0.5);
        
        if ($improvement_points >= 9){
            $improvement_points = 9;
        }
        
        if ($improvement_points <= 0){
            $improvement_points = 0;
        }
        
        if ($achievement_points >= $improvement_points){
            $measure_score = $achievement_points;
        }else{
            $measure_score = $improvement_points;
        }
	
		return [$achievement, $benchmark, $baseline, $performance, $achievement_points, $improvement_points, $measure_score];
	}
	public static function tps_domain($measure_scores){
		$total_measure = 0;
		for ($i = 0; $i < sizeof($measure_scores); $i++){
			$total_measure = $total_measure + $measure_scores[$i];
		}
		
		$unweighted_domain = ($total_measure / (10 * sizeof($measure_scores))) * 100;
		$weighted_domain = $unweighted_domain * 0.25;
	
		return [$total_measure, $unweighted_domain, $weighted_domain];
	
	}	
	
	public static function tps_HCAHPS($measure_scores){
		$total_measure = 0;
		for ($i = 0; $i < sizeof($measure_scores); $i++){
			$total_measure = $total_measure + $measure_scores[$i];
		}
		
		$consistency_score = 15;
		
		$unweighted_domain = ($total_measure + $consistency_score);
		$weighted_domain = $unweighted_domain * 0.25;
	
		return [$total_measure, $unweighted_domain, $weighted_domain];
	
	}	
	
	public static function tps($domain_scores){
		$total = 0;
		for ($i = 0; $i < sizeof($domain_scores); $i++){
			$total = $total + $domain_scores[$i];
		}
	
		return [$total];
	
	}	
	
	public static function reimbursement($reimbursement_data){
		$reimbursement = $reimbursement_data[0];
		$tps = $reimbursement_data[1];
		
		$penalty = $reimbursement * 0.02;
		$money_back = ($tps / 100) * $penalty;
		
		$total_reimbursement = $reimbursement - $penalty + $money_back;
	
		return [$reimbursement, $penalty, $total_reimbursement];
	
	}	
}
