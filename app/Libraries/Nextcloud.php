<?php
namespace App\Libraries;

use Sabre\DAV\Client;

class Nextcloud
{
private $client;

public function __construct()
{
$this->client = new Client([
'baseUri' => 'https://file.mahieraglobalsolution.com/remote.php/dav/files/mahiera',
'auth' => [
'username' => 'mahiera',
'password' => 'MahieraGlobalSolution123!',
],
]);
}
public function getFileList($path = '/')
{
    try {
        $files = $this->client->propFind($path, [
            '{DAV:}getcontenttype',
            '{DAV:}getlastmodified',
        ]);
        return $files;
    } catch (\Exception $e) {
        log_message('error', 'WebDAV Error: ' . $e->getMessage());
        return [];
    }
}
 

public function uploadFile($file)
{
$this->client->post($file, file_get_contents($file));
}

public function downloadFile($file)
{
$content = $this->client->get($file);
return $content;
}

public function deleteFile($file)
{
$this->client->delete($file);
}
}