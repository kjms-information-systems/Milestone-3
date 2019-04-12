<?php
namespace Model;
class Vbp extends \Model {
	public static function get_data($filename) {
        $provider_number = '060034';
		//change $filename parameter to the provider_number
		$safety = \DB::select('*')->from('test_safety')->where('provider_number', '=', $provider_number)->execute();
		$tps = \DB::select('*')->from('test_TPS')->where('provider_number', '=', $provider_number)->execute();
		$clinical_care = \DB::select('*')->from('test_clinical_care')->where('provider_number', '=', $provider_number)->execute();
		$reimbursement = \DB::select('*')->from('test_medical_provider_charge')->where('provider_number', '=', $provider_number)->execute();
		
		
		$safety_array = array();
		$safety_array = $safety->as_array();
		
		$tps_array = array();
		$tps_array = $tps->as_array();
		
		$clinical_care_array = array();
		$clinical_care_array = $clinical_care->as_array();
		
		$reimbursement_array = array();
		$reimbursement_array = $reimbursement->as_array();
		
		$csv = array();
		$file = fopen($filename, "r");
		
		//SAFETY
		$csv['psi90'] = [$safety_array[0]['psi_90_achievement_threshold'], $safety_array[0]['psi_90_benchmark'],$safety_array[0]['psi_90_baseline_rate'],$safety_array[0]['psi_90_performance_rate'],$safety_array[0]['psi_90_achievement_points'],$safety_array[0]['psi_90_improvement_points'],$safety_array[0]['psi_90_measure_score']] ;
		
		
		$csv['ha1'] = [$safety_array[0]['hai_1_achievement_threshold'], $safety_array[0]['hai_1_benchmark'],$safety_array[0]['hai_1_baseline_rate'],$safety_array[0]['hai_1_performance_rate'],$safety_array[0]['hai_1_achievement_points'],$safety_array[0]['hai_1_improvement_points'],$safety_array[0]['hai_1_measure_score']] ;

		$csv['ha2'] = [$safety_array[0]['hai_2_achievement_threshold'], $safety_array[0]['hai_2_benchmark'],$safety_array[0]['hai_2_baseline_rate'],$safety_array[0]['hai_2_performance_rate'],$safety_array[0]['hai_2_achievement_points'],$safety_array[0]['hai_2_improvement_points'],$safety_array[0]['hai_2_measure_score']] ;
		
		$csv['ha3'] = [$safety_array[0]['hai_3_achievement_threshold'], $safety_array[0]['hai_3_benchmark'],$safety_array[0]['hai_3_baseline_rate'],$safety_array[0]['hai_3_performance_rate'],$safety_array[0]['hai_3_achievement_points'],$safety_array[0]['hai_3_improvement_points'],$safety_array[0]['hai_3_measure_score']] ;
		
		$csv['ha4'] = [$safety_array[0]['hai_4_achievement_threshold'], $safety_array[0]['hai_4_benchmark'],$safety_array[0]['hai_4_baseline_rate'],$safety_array[0]['hai_4_performance_rate'],$safety_array[0]['hai_4_achievement_points'],$safety_array[0]['hai_4_improvement_points'],$safety_array[0]['hai_4_measure_score']] ;
		
		$csv['ha5'] = [$safety_array[0]['hai_5_achievement_threshold'], $safety_array[0]['hai_5_benchmark'],$safety_array[0]['hai_5_baseline_rate'],$safety_array[0]['hai_5_performance_rate'],$safety_array[0]['hai_5_achievement_points'],$safety_array[0]['hai_5_improvement_points'],$safety_array[0]['hai_5_measure_score']] ;
		
		$csv['ha6'] = [$safety_array[0]['hai_6_achievement_threshold'], $safety_array[0]['hai_6_benchmark'],$safety_array[0]['hai_6_baseline_rate'],$safety_array[0]['hai_6_performance_rate'],$safety_array[0]['hai_6_achievement_points'],$safety_array[0]['hai_6_improvement_points'],$safety_array[0]['hai_6_measure_score']] ;
		
		$csv['pc01'] = [$safety_array[0]['pc_01_achievement_threshold'], $safety_array[0]['pc_01_benchmark'],$safety_array[0]['pc_01_baseline_rate'],$safety_array[0]['pc_01_performance_rate'],$safety_array[0]['pc_01_achievement_points'],$safety_array[0]['pc_01_improvement_points'],$safety_array[0]['pc_01_measure_score']] ;
		
		$csv['combined_ssi'] = [$safety_array[0]['combined_ssi_measure_score']];
		
		$csv['safety_tps'] = [$tps_array[0]['unweighted_safety'], $tps_array[0]['unweighted_safety'], $tps_array[0]['weighted_safety']];
		
		//CLINICAL CARE
		$csv['mortAMI'] = [$clinical_care_array[0]['mort_30_ami_achievement_threshold'], $clinical_care_array[0]['mort_30_ami_benchmark'],$clinical_care_array[0]['mort_30_ami_baseline_rate'],$clinical_care_array[0]['mort_30_ami_performance_rate'],$clinical_care_array[0]['mort_30_ami_achievement_points'],$clinical_care_array[0]['mort_30_ami_improvement_points'],$clinical_care_array[0]['mort_30_ami_measure_score']] ;
		
		$csv['mortHF'] = [$clinical_care_array[0]['mort_30_hf_achievement_threshold'], $clinical_care_array[0]['mort_30_hf_benchmark'],$clinical_care_array[0]['mort_30_hf_baseline_rate'],$clinical_care_array[0]['mort_30_hf_performance_rate'],$clinical_care_array[0]['mort_30_hf_achievement_points'],$clinical_care_array[0]['mort_30_hf_improvement_points'],$clinical_care_array[0]['mort_30_hf_measure_score']] ;
		
		$csv['mortPN'] = [$clinical_care_array[0]['mort_30_pn_achievement_threshold'], $clinical_care_array[0]['mort_30_pn_benchmark'],$clinical_care_array[0]['mort_30_pn_baseline_rate'],$clinical_care_array[0]['mort_30_pn_performance_rate'],$clinical_care_array[0]['mort_30_pn_achievement_points'],$clinical_care_array[0]['mort_30_pn_improvement_points'],$clinical_care_array[0]['mort_30_pn_measure_score']] ;
		
		$csv['cc_tps'] = [$tps_array[0]['unweighted_clinical_care'], $tps_array[0]['unweighted_clinical_care'], $tps_array[0]['weighted_clinical_care']];
		
		$csv['hospital_name'] = [$tps_array[0]['hospital_name']];
		$csv['test'] = fgetcsv($file, 1000, ",");
		$csv['test'] = fgetcsv($file, 1000, ",");
		$csv['test'] = fgetcsv($file, 1000, ",");
		$csv['test'] = fgetcsv($file, 1000, ",");
		$csv['test'] = fgetcsv($file, 1000, ",");
		$csv['test'] = fgetcsv($file, 1000, ",");
		$csv['test'] = fgetcsv($file, 1000, ",");
		$csv['test'] = fgetcsv($file, 1000, ",");
		$csv['test'] = fgetcsv($file, 1000, ",");
		$csv['test'] = fgetcsv($file, 1000, ",");
		$csv['test'] = fgetcsv($file, 1000, ",");
		$csv['test'] = fgetcsv($file, 1000, ",");
		$csv['test'] = fgetcsv($file, 1000, ",");
		
		
		
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
		
		//Calculate reimbursement
		$reim = 0;
		for ($i = 0; $i < sizeof($reimbursement_array); $i++){
			$temp = $reimbursement_array[$i]['average_medicare_payments'];
			$temp = str_replace("$", "", $temp);
			$temp = str_replace(",", "", $temp);
			$temp = doubleval($temp);
			$temp2 = $reimbursement_array[$i]['total_discharges'] * $temp;
			$reim = $reim + $temp2;
		}
		$penalty = $reim * 0.02;
		$money_back = ($tps['total_performance_score'] / 100) * $penalty;
		$total_reimbursement = $reim - $penalty + $money_back;
		
		$csv['reimbursement'] = [$reim, $penalty, $total_reimbursement];
		
		$csv['test'] = fgetcsv($file, 1000, ",");
		$csv['comments'] = fgetcsv($file, 1000, ",");

		return $csv;
	}
	
	public static function put_data($filename, $data) {
                  
                
		\DB::insert('test_user_save_data')->set(array(
            'filename' => $filename,
            'reimbursement' => $data['reimbursement'][0],
            ))->execute();
            
	}
	
	
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
