<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FormRequests\DokumensCreateRequest;
use App\FormRequests\DokumensUpdateRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Dokumens;
use App\File;

class DokumensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
// jenis_sppd_id_ck keperluam_ck
// no_sppd_ck  
// penerima_id_ck  
// skpd_ck 
// thn_ck  
    // public $cari;
    // const tokenx=['token'=>csrf_token()];
    // public $token = array('token'=>csrf_token());
    
  

    function __construct()
    {
        $this->caris=['jenis_sppd_id', 'keperluan', 'no_sppd', 'penerima_id', 'skpd_id', 'tahun'];

    }
    // public function index()
    // {
    //     return __function__;
    //     //
    // }
    
    
    public function anyData(Request $req)
    {
 
        // $data = Dokumens::all();
        // $count = App\Flight::where('active', 1)->count();

        // $data = \DB::table('dokumen');
        // $data = Dokumens::with('jenissppd');
        $data = Dokumens::with('penerima','skpd','unitkerja' ,'jenissppd','file','user');
        // $data = Dokumens::with('penerima','skpd');
        // dd($data->get());
        /*pencarian data ===============================*/

        if ($req->get('cari')) {
            $i=0;
            foreach ($this->caris as $key =>$cari) {
                        $get=$cari.'_ck'; //echo $get;
                        // var_dump($req->get($get));

                        // var_dump($req->get($cari.'_ck'));
                    if ($req->get($get)=='on') {
                       $mystring = $req->get($cari);
                       $findme   = '*';
                       $query=(strpos($mystring, $findme)===false)?($req->get($cari).'%'):str_replace('*', '%', $req->get($cari));
                   
                            if ($i==0 or $cari== 'skpd_id' or $cari== 'jenis_sppd_id' or $cari== 'penerima_id' ) {
                                    $query= $req->get($cari);         
                                $data->where($cari,'=',$query);
                                $i++;
                            }
                            elseif ($i==0 ) {
                            
                                $data->where($cari,'like',$query);
                                $i++;
                            }
                            elseif($i !== 0){
                                // $data->orWhere($cari,'like',$req->get($cari).'%');
                                $data->orWhere($cari,'like',$query);
                            }

                    }
            
                }
         
           return $this->show_relasi_kolom($data->get());
        }
        /* paging biasa ======================================   select * from `dokumen` limit 0,10  */
        if ($req->get('page')) {
            // dd($req->get('page')-1);
            if ($req->get('page')==1) {
                $offset=$req->get('page')-1;
            }
            else{
                 $offset=($req->get('page')-1)*$req->get('rows');
            }

            $data->skip($offset);
        }
        if ($req->get('rows')) {
            $data->take($req->get('rows'));
            
        }
        if ($req->get('sort') && $req->get('order')) {
            $data->orderBy($req->get('sort'), $req->get('order'));
            
        }
        // dd($data->get());
        $datax['rows']=$this->show_relasi_kolom($data->get());
        $total['total'] = \DB::table('dokumen')->count();
      
        // dd($data->get());
        return $total+$datax+['token'=>csrf_token()];
        //
    }

     public function show_relasi_kolom($collection='')
    {
        return $collection->each(function ($item, $key) {
            // var_dump($item['nama_unit_kerja']);
            // $item['nama_unit_kerja']='xxxxx--'.$item['skpd']->nama_skpd;
            // var_dump($item['skpd']->nama_skpd);
            // return $item['skpd']=$item['skpd']['nama_skpd'];
             // $item['skpd']=$item['skpd']->nama_skpd;
            // var_dump($item->penerima);
               

             $item['nama_penerima']= !empty($item['penerima']->nama_penerima)?$item['penerima']->nama_penerima:'';
             $item['nama_skpd']=!empty($item['skpd']->nama_skpd)?$item['skpd']->nama_skpd:'';
             $item['nama_unit_kerja']=!empty($item['unitkerja']->nama_unit_kerja)?$item['unitkerja']->nama_unit_kerja:'';
             $item['nama_jenis_sppd']=!empty($item['jenissppd']->nama_jenis_sppd)?$item['jenissppd']->nama_jenis_sppd:'';
             // $item['file_url']=!empty($item['file']->filename)?route('file.get',['filename'=>$item['file']->filename]):'';
             $item['file_status']=!empty($item['file']->original_filename)?$item['file']->original_filename:'';
             $item['email']=!empty($item['user']->email)?$item['user']->email:'--';

             if ($item['file'] && !empty($item['file']['nama_baru']) && !empty($item['file']['dir'])  ) {
                //   if ($item['id']==398) {
                //  $url=route('file.get',['dir'=>$item['file']['dir'],'filename'=>$item['file']['nama_baru']]);
                //     echo ' nama baru : '.$item['file']['nama_baru'];
                //     echo'atas';
                //     dd($url);
                // }
                // echo $item['id'].'identitas file '.$item['file']['nama_baru'].'/' .$item['file']['dir'];
                // dd('ada');
                 // $url=route('file.get',['dir'=>$item['file']['dir'],'filename'=>$item['file']['nama_baru']]);
                 $url=route('file.get',['id'=>base64_encode($item['file']['id']),'filename'=>$item['file']['nama_baru']]);
             }
             elseif($item['file'] !== null){

                // if ($item['id']==398) {

                //       echo'bawah';
                //     $url=route('file.get',['dir'=>'default','filename'=>$item['file']['filename']])  ;

                //     dd($url);
                // }
                    // $url= url('file/get/default/'.$item['file']['filename']);;
                    // $url=route('file.get',['dir'=>'default','filename'=>$item['file']['filename']]);
                    $url=route('file.get',['id'=>base64_encode($item['file']['id'])]);
                    
             }
             else{
                 $url='';
             }

             $item['file_url']=$url;
            // if (/* some condition */) {
            //     return false;
            // }
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    // public function create()
    // {
    //     return __function__;
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(DokumensCreateRequest $req)
    {
        // dd($request->all());
        // $this->filehandle($req);
       $data_dokumen=new Dokumens();
       foreach ($data_dokumen->getColoumn() as  $kolom) {

               if($kolom=='users_id'){

                $data_dokumen->$kolom = \Sentry::getUser()->id;
               }
               elseif($kolom!=='users_id'){
                $data_dokumen->$kolom = $req->get($kolom) ;
               }
       }
        // $data_dokumen->skpd_id= $request->skpd_id;
        // $data_dokumen->nama_unit_kerja= $request->nama_unit_kerja;
        // $data_dokumen->nama_singkat_unit_kerja= $request->nama_singkat_unit_kerja;
        // if ($req->file('gambar')->getClientMimeType()=='application/pdf') {
            $data_dokumen->save();
            if ($data_dokumen->id) {
                 // $this->filehandle($req,$data_dokumen->id);
                 $pesan_pdf='Dokumen tidak di update';
                 // PDF tidak di update / melalui form 
                 // Gagal mengupload file PDF
                 // Sukses Mengupload DOkumen

                 if ($this->filehandle($req,$data_dokumen->id)) {
                     $pesan_pdf='Dokumen PDF Terupload ';
                 }

            // $data['code']=200;
            // $data['msg']='Tambah data SUkses';
                    $data['msg']='Sukses !';
                    $data['succes']= 'Tambah Dokumen SP2D '.$data_dokumen->no_sppd.' dengan keperluan '.$data_dokumen->keperluan.' Sukses<br>'.$pesan_pdf ;
                 return $data;

             // return 'Tambah Dokumen SP2D '.$data_dokumen->no_sppd.' dengan keperluan '.$data_dokumen->keperluan.' Sukses<br>'.$pesan_pdf ;
                
            }
            else{
             return 'Gagal Menambahkan data' ;

            }
        // }
        // else {
            // return 'Gagal !, File yang anda upload bukan berformat PDF';
        // }

        // return __function__;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    // public function show($id)
    // {
    //     return __function__;
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Request $req, $id)
    {
        // dd(url('file/get').'/xx.jpg');
        $data = Dokumens::find($id);
        $v_data=$data->toArray();
        // dd($data);
            if (count($data->file()->get()->toArray()) && $data->file) {
                // dd($data->file()->get());
                  // $image['image'] = '<img src="'.route('file.get',['filename'=>$data->file()->get()[0]->filename]).'" alt="'.$data->file()->get()[0]->filename.'">';
                  // $dir=$data->file->dir;
                  // $link_pdf['link_pdf'] =route('file.get',['dir'=>$dir,'filename'=>$data->file()->get()[0]->filename]);
                $id=$data->file->id;
                  $link_pdf['link_pdf'] =route('file.get',['id'=>base64_encode($id)]);
            }
            else{
                  // $image['image'] = '<img src="xx.jpg" alt="xx.jpg">';
                  $link_pdf['link_pdf'] ='';
                  // $image['link_pdf'] =route('file.get',['filename'=>$data->file()->get()[0]->filename]);
                  
            }
        // $image = $data->file()->get()[0]->filename;
        // dd($image[0]->filename);
        return $v_data+$link_pdf;
        return __function__;
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function filehandle($req,$id)
    {   
        // PDF tidak di update / melalui form 
        // Gagal mengupload file PDF
        // Sukses Mengupload DOkumen
            $pesan=['error'=>['Peringatan : File PDF tidak di atur dengan benar !', 'Terjadi kesalahan upload File PDf '], 'succes'=>'Sukses mengupload Dokumen PDF '];
        // dd($req->all());

         $file = $req->file('gambar');
        // $lokasi_tujuan=str_slug( str_replace('-', ' ', $req->get('no_boks')));
        $lokasi_tujuan= $req->get('no_boks');

         if ($file and $file->getClientMimeType()=='application/pdf') {
            // dd($file);
             $extension = $file->getClientOriginalExtension();

                 $entry = File::where('dokumen_id','=',$id)->first();
// format nama file = ==============================================================================================
                $nama_file= str_slug( str_replace('/', '-', $req->get('no_sppd'))).'-'.str_slug( str_replace('/', '-', $req->get('nama_dokumen'))).'-'.$file->getFilename().'.'.$extension;
                // echo $nama_file;
                // dd($entry);

                 if(count($entry)){
                 // dd(count($entry->get()->toArray()));
                     // $entry=File::find($entry->id);
                     // dd($entry->with('dokumen')->get());
                     // dd($entry->get()->toArray()[0]['filename']);
                     // if (\Storage::exists($entry->get()->toArray()[0]['dir'].'/'.$entry->get()->toArray()[0]['filename'])) {
                     //     \Storage::delete($entry->get()->toArray()[0]['dir'].'/'.$entry->get()->toArray()[0]['filename']);
                     //     }

                         // if($entry){
                                 $lokasi_baru=$entry->dir.'/'.$entry->nama_baru;
                                 $lokasi_lama=$entry->filename;
                             if ($entry->dir && $entry->nama_baru && \Storage::exists($lokasi_baru)) {
                                 // echo $lokasi_baru;
                                \Storage::move($lokasi_baru, 'RecycleBin/'.$entry->nama_baru);
                                 // \Storage::delete($lokasi_baru);
                             }
                             if ($entry->filename && \Storage::exists($lokasi_lama)) {
                                 // echo $lokasi_lama;
                                 \Storage::move($lokasi_lama, 'RecycleBin/'.$entry->nama_baru);
                                 // \Storage::delete($lokasi_lama);
                             }
                                 // dd($lokasi_baru);

                             // $entry->delete();
                         // }
                         

                    $update= ['mime' => $file->getClientMimeType(),
                                     'original_filename' => $file->getClientOriginalName(),
                                     'filename' =>$nama_file,
                                     'nama_baru' =>$nama_file,
                                     'dir' =>$lokasi_tujuan,
                                     ];

                     if ($entry->update($update) ) {

                            $dirs= \Storage::allDirectories();
                            // $dir=str_slug( str_replace('-', ' ', $req->get('no_boks')));
                            $dir=$lokasi_tujuan;
                                if (!in_array($dir, $dirs)){
                                        \Storage::makeDirectory($lokasi_tujuan);
                                }
                                echo $nama_file;
                                    \Storage::put($dir.'/'.$nama_file,  \File::get($file));

                        return true;
                     }
                     return false;
                 }
                 else{

                     $entry=new File();
                     $entry->dokumen_id = $id;
                     $entry->mime = $file->getClientMimeType();
                     $entry->original_filename = $file->getClientOriginalName();
                     $entry->filename = $nama_file;
                     $entry->nama_baru = $nama_file;
                     // $entry->dir = str_slug( $req->get('no_boks'), "-");
                     $entry->dir = $lokasi_tujuan;
                     if ($entry->save()) {
                            $dirs= \Storage::allDirectories();

                            // $dir=str_slug( str_replace('-', ' ', $req->get('no_boks')));
                            $dir= $lokasi_tujuan;
                                if (!in_array($dir, $dirs)){
                                        \Storage::makeDirectory($lokasi_tujuan);
                                }
                                echo $nama_file;
                            \Storage::put($dir.'/'.$nama_file,  \File::get($file));
                         return true;
                     }
                     return false;
                     
                 }
             
            // }
            
         }
         else{
            // Handle file pdf 
            //pINDAH DIREKTORI KARENA UPDATE NO BOX
             $entry = File::where('dokumen_id','=',$id)->first();
                    //JIKA NAMA dir dari file $entry !==  str_slug($req->boks)
                    // $lokasi_tujuan=str_slug( str_replace('-', ' ', $req->get('no_boks')));
                  if($entry &&  ($entry->dir !== $lokasi_tujuan)){
                         $nama_file= str_slug( str_replace('/', '-', $req->get('no_sppd'))).'-'.str_slug( str_replace('/', '-', $req->get('nama_dokumen'))).'-'.$entry->filename;

                        // $nama_file_baru= str_slug( str_replace('-', ' ', $req->get('no_sppd'))).'-'.str_slug( str_replace('-', ' ', $req->get('nama_dokumen'))).'-'.$entry->filename;

                        // $entry->nama_baru=!empty($entry->nama_baru) ? $entry->nama_baru:str_replace('/', '-', $entry->dokumen->no_sppd).'-'.$entry->filename;
                        $entry->nama_baru=!empty($entry->nama_baru) ? $entry->nama_baru: $nama_file;
                        // $entry->nama_baru=str_replace('/', '-', $entry->dokumen->no_sppd).'-'.$entry->filename;
                    // dd('lama masuk ');
                          $lokasi_lama_file=$entry->dir.'/'.$entry->nama_baru;
                          $lokasi_lama_lama_migrasi=$entry->filename;
                          // echo "baru".$lokasi_baru;
                          // echo "baru".$lokasi_lama;
                        $lokasi_tujuan_and_file=$lokasi_tujuan.'/'.$entry->nama_baru;
                        // handle file yang telah dimigrasi 
                      if (\Storage::exists($lokasi_lama_file)) {

                            //cek apakah lokasi baru sudah atau belum 
                            $dirs = \Storage::allDirectories();
                            if (in_array($lokasi_tujuan, $dirs)) {
                                // dd('dir ada ');
                                \Storage::move($lokasi_lama_file, $lokasi_tujuan_and_file);
                                // return true;
                                
                                }
                            elseif(!in_array($lokasi_tujuan, $dirs)){
                                // print_r($lokasi_tujuan);
                                // print_r($dirs);
                                // dd('dir tidak ada ');
                                    \Storage::makeDirectory($lokasi_tujuan);
                                    \Storage::move($lokasi_lama_file, $lokasi_tujuan_and_file);
                                    // return true;
                                } 
                                else{
                                    // return 'Adalah masalah permissi penulisan file Anda ';
                                }      
                                //pindahkan file ke lokasi baru 
                                //simpan nama lokasi baru 
                      }
                      // handle file lamam sebelum migrasi 
                      elseif (\Storage::exists($lokasi_lama_lama_migrasi)) {
                            //cek apakah lokasi baru sudah atau belum 
                            $dirs = \Storage::allDirectories();
                                // Lokasi telah siap 
                            if (in_array($lokasi_tujuan, $dirs)) {
                                \Storage::move($lokasi_lama_lama_migrasi, $lokasi_tujuan_and_file);
                                // return true;
                                
                                }
                            if(!in_array($lokasi_tujuan, $dirs)){
                                    \Storage::makeDirectory($lokasi_tujuan);
                                    \Storage::move($lokasi_lama_lama_migrasi, $lokasi_tujuan_and_file);
                                    // return true;
                                } 
                                else{
                                    // return 'Adalah masalah permissi penulisan file Anda ';
                                }      
                                //pindahkan file ke lokasi baru 
                                //simpan nama lokasi baru 
                      }
                      else{
                        echo 'File lama tidak ada!!!!';
                        return false;
                      }
                        $entry->dir= $lokasi_tujuan;
                                // dd($lokasi_tujuan);
                      if ($entry->save() ) {

                           
                            echo 'Telah diupdate Ke Lokasi baru';
                         return true;
                      }
                  }
                  
                  // Handle db file
             // $update= $entry;
             // ['mime' => $file->getClientMimeType(),
             //                  'original_filename' => $file->getClientOriginalName(),
             //                  'filename' =>$nama_file,
             //                  'nama_baru' =>$nama_file,
             //                  'dir' =>str_slug( $req->get('no_boks'), "-"),
             //                  ];

            // $data['msg']='Gagal';
            // // $data['errors']=$errors;
            // $data['errors']='File yang anda Upload bukan PDF';
            // $data['code']=403;
            // // echo json_encode($data);
            // return \Response::make(json_encode($data), 403);
            return false;
            // return 'File yang anda Upload bukan PDF';
         }
    }
    // public function filehandle($req,$id)
    // {   
    //     // PDF tidak di update / melalui form 
    //     // Gagal mengupload file PDF
    //     // Sukses Mengupload DOkumen
    //         $pesan=['error'=>['Peringatan : File PDF tidak di atur dengan benar !', 'Terjadi kesalahan upload File PDf '], 'succes'=>'Sukses mengupload Dokumen PDF '];
    //     // dd($req->all());
    //      $file = $req->file('gambar');
    //      if ($file and $file->getClientMimeType()=='application/pdf') {
    //         // dd($file);
    //          $extension = $file->getClientOriginalExtension();

    //              $entry = File::where('dokumen_id',$id);
    //             $nama_file=$req->get('nama_dokumen').$file->getFilename().'.'.$extension;
    //             echo $nama_file;
    //              if(count($entry->get()->toArray())){
    //              // dd(count($entry->get()->toArray()));
    //                  // $entry=File::find($entry->id);
    //                  // dd($entry->with('dokumen')->get());
    //                  // dd($entry->get()->toArray()[0]['filename']);
    //                  if (\Storage::exists($entry->get()->toArray()[0]['dir'].'/'.$entry->get()->toArray()[0]['filename'])) {
    //                      \Storage::delete($entry->get()->toArray()[0]['dir'].'/'.$entry->get()->toArray()[0]['filename']);
    //                      }
                         

    //                 $update= ['mime' => $file->getClientMimeType(),
    //                                  'original_filename' => $file->getClientOriginalName(),
    //                                  'filename' =>$nama_file,
    //                                  'nama_baru' =>$nama_file,
    //                                  'dir' =>str_slug( $req->get('no_boks'), "-"),
    //                                  ];

    //                  if ($entry->update($update) ) {

    //                         $dirs= \Storage::allDirectories();
    //                         $dir=str_slug( str_replace('-', ' ', $req->get('no_boks')));
    //                             if (!in_array($dir, $dirs)){
    //                                     \Storage::makeDirectory(str_slug( $req->get('no_boks'), "-"));
    //                             }
    //                             echo $nama_file;
    //                                 \Storage::put($dir.'/'.$nama_file,  \File::get($file));

    //                     return true;
    //                  }
    //                  return false;
    //              }
    //              else{

    //                  $entry=new File();
    //                  $entry->dokumen_id = $id;
    //                  $entry->mime = $file->getClientMimeType();
    //                  $entry->original_filename = $file->getClientOriginalName();
    //                  $entry->filename = $nama_file;
    //                  $entry->nama_baru = $nama_file;
    //                  $entry->dir = str_slug( $req->get('no_boks'), "-");
    //                  if ($entry->save()) {
    //                         $dirs= \Storage::allDirectories();

    //                         $dir=str_slug( str_replace('-', ' ', $req->get('no_boks')));
    //                             if (!in_array($dir, $dirs)){
    //                                     \Storage::makeDirectory(str_slug( $req->get('no_boks'), "-"));
    //                             }
    //                             echo $nama_file;
    //                         \Storage::put($dir.'/'.$nama_file,  \File::get($file));
    //                      return true;
    //                  }
    //                  return false;
                     
    //              }
             
    //         // }
            
    //      }
    //      else{
    //         // $data['msg']='Gagal';
    //         // // $data['errors']=$errors;
    //         // $data['errors']='File yang anda Upload bukan PDF';
    //         // $data['code']=403;
    //         // // echo json_encode($data);
    //         // return \Response::make(json_encode($data), 403);
    //         return false;
    //         // return 'File yang anda Upload bukan PDF';
    //      }
    // }
    public function dbHandle()
    {
        # code...
    }
    public function update(DokumensUpdateRequest $req, $id)
    {

        $pesan_pdf='Dokumen Pdf tidak di update';

        $data_dokumen = Dokumens::find($id);
        if ($this->filehandle($req,$id)) {
            $pesan_pdf='Gambar Telah di update';
        }
        // dd($data_dokumen);

        // if ($data_dokumen && $req->file('gambar')->getClientMimeType()=='application/pdf') {
            $data_dokumen_pesan_to_view=$data_dokumen->nama_dokument;
            foreach ($data_dokumen->getColoumn() as  $kolom) {
                     // $data_dokumen->$kolom = $req->get($kolom) ;
                if($kolom=='users_id'){

                  $data_dokumen->$kolom = \Sentry::getUser()->id;
                 }
                 elseif($kolom!=='users_id'){
                  $data_dokumen->$kolom = $req->get($kolom) ;
                 }
            }
            // dd( $data_dokumen);
            // $data_dokumen->nama_unit_kerja = $req->get('nama_unit_kerja') ;
            // $data_dokumen->nama_singkat_unit_kerja = $req->get('nama_singkat_unit_kerja') ;
            $data_dokumen->save();

                $cek=Dokumens::find($id);
            
            // if ( $data_dokumen_pesan_to_view !==  $cek->nama_unit_kerja) {
                   $data['msg']='Sukses !';
            if ( $data_dokumen  !==  $cek) {
                   $data['succes']= 'Update Dokumen SP2D dengan Nomor '.$data_dokumen->no_sppd.' ke '.$data_dokumen_pesan_to_view.' sukses NOTE " '.$pesan_pdf .' "';
                return $data;
                    // return 'Update nama skpd '.$data_dokumen->penerima.' ke '.$data_dokumen_pesan_to_view.' sukses<br>'.$pesan_pdf;
                }
            else{
                   $data['succes']= 'Update Dokumen SP2D dengan Nomor  '.$data_dokumen->nama_unit_kerja.' ke '.$req->nama_unit_kerja.' Gagal / nilainya sama <br>'.$pesan_pdf;
                return $data;
                    // return 'Update nama skpd '.$data_dokumen->nama_unit_kerja.' ke '.$req->nama_unit_kerja.' Gagal / nilainya sama <br>'.$pesan_pdf;
            } 
         // }
         // else{
                    // return 'Gatal data tidak ditemukan';

            // }      
        // return __function__;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
   
          $data_dokumen=Dokumens::find($id);
          $data_dokumen_pesan=$data_dokumen;
          // dd($data_dokumen_pesan->nama_skpd);
        if ($data_dokumen) {
           $data_dokumen->delete();
            $file=$data_dokumen->file;
            // dd($file);
                // $file->get()['filename'];
            if($file){
                    $lokasi_baru=$file->dir.'/'.$file->nama_baru;
                    $lokasi_lama=$file->filename;
                if ($file->nama_baru && $file->dir && \Storage::exists($lokasi_baru)) {
                    # code...
                    // echo $lokasi_baru;
                    \Storage::move( $lokasi_baru, 'RecycleBin/'.$file->nama_baru);
                }
                if (\Storage::exists($lokasi_lama)) {
                    // echo $lokasi_lama;
                    \Storage::move( $lokasi_lama, 'RecycleBin/'.$file->filename);
                    # code...

                }
                // $file->delete();
            }

        }
          $data_dokumenx=Dokumens::find($id);

        if (!$data_dokumenx) {
           return 'Sukses data SPPD  '.$data_dokumen_pesan->no_sppd;
        }
        else{
           return 'gagal data SPPD  '.$data_dokumen_pesan->no_sppd;
            
        }
 
        // return __function__;
        //
    }

}
