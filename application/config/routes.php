<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*
|-------------------------------------------------------------------------
| Sample REST API Routes
|
|$route['api/example/users/(:num)'] = 'api/example/users/id/$1'; // Example 4
|$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8
|
| -------------------------------------------------------------------------
| -------------------------------------------------------------------------
| Route Api Server BDI Padang
| JSON metode yang dipakai adalah ini:
|   ['GET']     = Mendapatkan Data
|   ['POST']    = Menambahkan Data
|   ['PUT']     = Mengupdate Data
|   ['DELETE']  = Menghapus Data
|
|--------------------------------------------------------------------------

*/

/* User API Routes */

$route['login']                                    = 'Auth/index';

/* ROUTES RESTSERVER SI - BDIP - Pelatihan */

//All User Pegawai dan AdminPd (oke)
$route['user_all_list']                            = 'Users/UserListAll/index';
$route['user_by_id/(:any)']                        = 'Users/UserGetId/UsersGetById/$1';
$route['user_add']                                 = 'Users/UserAdd/AddUsers';
$route['user_deleted/(:any)']                      = 'Users/UserDeleted/UsersDeleted/$1';
$route['user_updated/(:any)']                      = 'Users/UserUpdated/UsersUpdated/$1';
$route['change_password/(:any)']				   = 'Users/Password/index/$1';
$route['user_authorization/(:any)']				   = 'Users/Authorization/index/$1';
$route['change_profile/(:any)']				  	   = 'Users/Profile/index/$1';

//Instructor(Narasumber) - (oke)
$route['instructor_all_list']                      = 'Instructor/InstructorListAll/index';
$route['instructor_by_id/(:any)']                  = 'Instructor/InstructorGetId/InstructorGetById/$1';
$route['instructor_add']                           = 'Instructor/InstructorAdd/AddInstructor';
$route['instructor_deleted/(:any)']                = 'Instructor/InstructorDeleted/InstructorDeleted/$1';
$route['instructor_updated/(:any)']                = 'Instructor/InstructorUpdated/InstructorUpdated/$1';

//Panitia eksternal - (oke)
$route['external_all_list']                        = 'Panitia/ExternalListAll/index';
$route['external_by_id/(:any)']                    = 'Panitia/ExternalGetId/ExternalGetById/$1';
$route['external_add']                             = 'Panitia/ExternalAdd/AddExternal';
$route['external_deleted/(:any)']                  = 'Panitia/ExternalDeleted/ExternalDeleted/$1';
$route['external_updated/(:any)']                  = 'Panitia/ExternalUpdated/ExternalUpdated/$1';

//Asisten - (oke)
$route['asisten_all_list']                         = 'Asisten/AsistenListAll/index';
$route['asisten_list/(:any)']                      = 'Asisten/AsistenList/AsistenGetData/$1';
$route['asisten_by_id/(:any)']                     = 'Asisten/AsistenGetId/AsistenGetById/$1';
$route['asisten_add']                              = 'Asisten/AsistenAdd/AssistantAdd';
$route['asisten_deleted/(:any)']                   = 'Asisten/AsistenDeleted/AssistantDeleted/$1';
$route['asisten_updated/(:any)']                   = 'Asisten/AsistenUpdated/AssistantUpdated/$1';

//Peserta - (belum oke)
$route['peserta_all_list/(:any)/(:any)']           	= 'Peserta/PesertaListAll/index/$1/$2';
$route['peserta_by_id/(:any)']                     	= 'Peserta/PesertaGetId/PesertaGetById/$1';
$route['peserta_add']                              	= 'Peserta/PesertaAdd/AddPeserta';
$route['peserta_deleted/(:any)']                   	= 'Peserta/PesertaDeleted/PesertaDeleted/$1';
$route['peserta_updated/(:any)']                   	= 'Peserta/PesertaUpdated/PesertaUpdated/$1';
$route['peserta_change_password/(:any)']			= 'Peserta/Password/index/$1';
$route['peserta_change_profile/(:any)']				= 'Peserta/Profile/index/$1';
$route['user_peserta_updated/(:any)']               = 'Users/UserPesertaUpdated/UserPesertaUpdated/$1';

//Diklat - (update and by id)
$route['diklat_all_list']                          = 'Diklat/DiklatListAll/index';
$route['diklat_by_id/(:any)']                      = 'Diklat/DiklatGetId/DiklatGetById/$1';
$route['GetNowDiklat/(:any)']                      = 'Diklat/GetNowDiklat/GetNowDiklat/$1';
$route['diklat_add']                               = 'Diklat/DiklatAdd/AddDiklat';
$route['diklat_deleted/(:any)']                    = 'Diklat/DiklatDeleted/DiklatDeleted/$1';
$route['diklat_updated/(:any)']                    = 'Diklat/DiklatUpdated/DiklatUpdated/$1'; 

//Jadwal - (oke)
$route['jadwal_all_list/(:any)']     				= 'Jadwal/JadwalListAll/index/$1';
$route['jadwal_by_id/(:any)/(:any)'] 				= 'Jadwal/JadwalGetId/JadwalGetById/$1/$2';
$route['jadwal_add']          						= 'Jadwal/JadwalAdd/AddJadwal';
$route['jadwal_deleted/(:any)']						= 'Jadwal/JadwalDeleted/JadwalDeleted/$1';
$route['jadwal_updated/(:any)']						= 'Jadwal/JadwalUpdated/JadwalUpdated/$1';

//Absen Peserta - (oke)
$route['absen_all_list/(:any)']             = 'Absen/PresenceListAll/index/$1';
$route['absen_by_id/(:any)/(:any)/(:any)']         = 'Absen/PresenceGetId/PresenceGetById/$1/$2/$3';
$route['absen_add']                                = 'Absen/PresenceAdd/AddPresence';
$route['absen_deleted/(:any)']                     = 'Absen/PresenceDeleted/PresenceDeleted/$1';
$route['absen_updated/(:any)']                     = 'Absen/PresenceUpdated/PresenceUpdated/$1'; 
$route['absen_report/(:any)']                      = 'Absen/PresenceReport/getPresenceReport/$1';

//Nilai Peserta - (oke)
$route['nilai_all_list/(:any)']                    = 'Nilai/NilaiListAll/index/$1';
//$route['nilai_by_id/(:any)/(:any)/(:any)']         = 'Nilai/NilaiGetId/NilaiGetById/$1/$2/$3';
$route['nilai_by_id/(:any)/(:any)']                = 'Nilai/NilaiGetId/NilaiGetById/$1/$2';
$route['nilai_add']                                = 'Nilai/NilaiAdd/AddNilai';
$route['nilai_deleted/(:any)']                     = 'Nilai/NilaiDeleted/NilaiDeleted/$1';
$route['nilai_updated/(:any)']                     = 'Nilai/NilaiUpdated/NilaiUpdated/$1'; 
$route['nilai_report/pretest/(:any)']             = 'Nilai/NilaiReport/getPretestReport/$1';
$route['nilai_report/posttest/(:any)']             = 'Nilai/NilaiReport/getPostTestReport/$1';


//Alamat
$route['alamat_all_list']                           = 'Alamat/ListAll/index';
$route['alamat_list_provinsi']                      = 'Alamat/ListProvinsi/index';
$route['alamat_list_kabupaten/(:any)']              = 'Alamat/ListKabupaten/ListKabupaten/$1';
$route['alamat_list_kecamatan/(:any)']              = 'Alamat/ListKecamatan/ListKecamatan/$1';
$route['alamat_list_kelurahan/(:any)']              = 'Alamat/ListKelurahan/ListKelurahan/$1';

//Company
$route['list_company']                           = 'Company/ListCompany/index';

//Scheme
$route['list_scheme']                           = 'Scheme/ListAll/index';
