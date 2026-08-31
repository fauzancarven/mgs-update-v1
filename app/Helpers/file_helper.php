<?php
// app/Helpers/my_helper.php

if (!function_exists('simpan_file_base64')) {
          function simpan_file_base64($base64, $lokasi,$nama) {
                    $parts = explode(',', $base64);
                    $header = $parts[0];
                    $extension = '';
                    
                    switch ($header) {
                              case 'data:image/jpeg;base64':
                                        $extension = '.jpg';
                                        break;
                              case 'data:image/png;base64':
                                        $extension = '.png';
                                        break;
                              case 'data:image/gif;base64':
                                        $extension = '.gif';
                                        break;
                              case 'data:image/bmp;base64':
                                        $extension = '.bmp';
                                        break;
                              case 'data:video/mp4;base64':
                                        $extension = '.mp4';
                                        break;
                              case 'data:video/webm;base64':
                                        $extension = '.webm';
                                        break;
                              case 'data:video/ogg;base64':
                                        $extension = '.ogg';
                                        break;
                              default:
                                        return 'Jenis file tidak didukung';
                    }
                    
                    $nama_file = $nama . $extension;
                    $biner = base64_decode($parts[1]);
                    file_put_contents($lokasi ."/". $nama_file, $biner); 
                    return $lokasi ."/". $nama_file;
          }
}