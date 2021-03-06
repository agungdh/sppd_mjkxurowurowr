<?php namespace App\FormRequests;

use Illuminate\Foundation\Http\FormRequest;

class UnitKerjaCreateRequest extends FormRequest{

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 * coba |exists:skpd,id 
	 * @return array
	 */
	public function rules()
	{
		return [
            'skpd_id' => 'required|numeric',
            'nama_unit_kerja' => 'required|min:4|alpha_spacex|max:254',
            'nama_singkat_unit_kerja' => 'required|min:4|alpha_spacex|max:20'
		];
	}
	public function response(array $errors)
	   {
	
		   	$data['msg']='Gagal';
		   	$data['errors']=$errors;
		   	$data['code']=403;
		   	// echo json_encode($data);
		   	return \Response::make(json_encode($data), 403);
	   }
	 public function forbiddenResponse()
	 {
	     return \Response::make('Permission denied foo!', 200);
	 }

}
