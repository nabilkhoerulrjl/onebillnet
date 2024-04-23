<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FileController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('File_Model');
    }

    public function getFile($fileId) {
        // Mengambil data file berdasarkan ID
        $fileData = $this->File_Model->getFileById($fileId);

        if ($fileData) {
            // Mendapatkan tipe konten file
            $contentType = $fileData['ContentType'];

            // Menentukan header dan tindakan berdasarkan tipe konten
            switch ($contentType) {
                case 'image/jpeg':
                case 'image/png':
                case 'image/gif':
                case 'PNG File':
                case 'JPEG File':
                case 'JPG File':
                    header("Content-type: " . $contentType);
                    echo $fileData['Content']; // Menampilkan gambar
                    break;
                case 'video/mp4':
                case 'video/quicktime':
                    header("Content-type: " . $contentType);
                    echo $fileData['Content']; // Menampilkan video
                    break;
                case 'audio/mpeg':
                case 'audio/wav':
                    header("Content-type: " . $contentType);
                    echo $fileData['Content']; // Menampilkan audio
                    break;
                default:
                    echo "Unsupported content type.";
            }
        } else {
            echo "File not found.";
        }
    }

}
?>